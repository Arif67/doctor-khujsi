<?php

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    Role::findOrCreate('admin', 'web');
    Role::findOrCreate('hospital_owner', 'web');
});

test('hospital owner can send a support message to super admin', function () {
    $owner = User::factory()->create([
        'first_name' => 'Hospital',
        'email' => 'hospital@example.com',
        'hospital_name' => 'City Hospital',
        'password' => 'password',
        'plan_password' => 'password',
    ]);
    $owner->assignRole('hospital_owner');

    Mail::fake();

    $response = $this->actingAs($owner)->post(route('admin.support.store'), [
        'subject' => 'Doctor approval issue',
        'priority' => 'high',
        'message' => 'Please review the pending approval for our new doctor.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Your message has been sent to the super admin.');

    $this->assertDatabaseHas('contact_messages', [
        'user_id' => $owner->id,
        'type' => 'support',
        'subject' => 'Doctor approval issue',
        'status' => 'open',
    ]);
});

test('hospital owner support request still succeeds when admin email delivery fails', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
    ]);
    $admin->assignRole('admin');

    $owner = User::factory()->create([
        'first_name' => 'Hospital',
        'email' => 'hospital@example.com',
        'hospital_name' => 'City Hospital',
        'password' => 'password',
        'plan_password' => 'password',
    ]);
    $owner->assignRole('hospital_owner');

    Log::spy();
    Mail::partialMock()
        ->shouldReceive('raw')
        ->once()
        ->andThrow(new RuntimeException('SMTP is unavailable'));

    $response = $this->actingAs($owner)->post(route('admin.support.store'), [
        'subject' => 'Doctor approval issue',
        'priority' => 'high',
        'message' => 'Please review the pending approval for our new doctor.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Your message has been sent to the super admin.');

    $this->assertDatabaseHas('contact_messages', [
        'user_id' => $owner->id,
        'type' => 'support',
        'subject' => 'Doctor approval issue',
        'status' => 'open',
    ]);

    Log::shouldHaveReceived('warning')->once();
});

test('admin can reply to a support message', function () {
    $admin = User::factory()->create([
        'first_name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => 'password',
        'plan_password' => 'password',
    ]);
    $admin->assignRole('admin');

    $owner = User::factory()->create([
        'first_name' => 'Hospital',
        'email' => 'hospital@example.com',
        'hospital_name' => 'City Hospital',
        'password' => 'password',
        'plan_password' => 'password',
    ]);
    $owner->assignRole('hospital_owner');

    $ticket = ContactMessage::create([
        'user_id' => $owner->id,
        'name' => $owner->name,
        'email' => $owner->email,
        'subject' => 'Need help',
        'type' => 'support',
        'priority' => 'normal',
        'status' => 'open',
        'message' => 'Please help us with the dashboard.',
    ]);

    Mail::fake();

    $response = $this->actingAs($admin)->patch(route('admin.support.reply', $ticket), [
        'status' => 'replied',
        'admin_reply' => 'Please try again after clearing the cache and reloading the dashboard.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Reply sent successfully.');

    $this->assertDatabaseHas('contact_messages', [
        'id' => $ticket->id,
        'status' => 'replied',
        'handled_by_id' => $admin->id,
    ]);
});
