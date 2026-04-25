<?php

use App\Models\Doctor;
use App\Models\DoctorBooking;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    $this->seed(RolePermissionSeeder::class);
});

it('allows an admin to reject a hospital owner account', function () {
    Mail::fake();

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $hospitalOwner = User::factory()->create([
        'hospital_name' => 'City Hospital',
        'approval_status' => 'pending',
        'approved_at' => now(),
    ]);
    $hospitalOwner->assignRole('hospital_owner');

    $response = $this->actingAs($admin)->patch(route('admin.users.reject-hospital', $hospitalOwner), [
        'rejection_reason' => 'Incomplete hospital documents',
    ]);

    $response->assertRedirect(route('admin.users.index'));

    expect($hospitalOwner->fresh()->approval_status)->toBe('rejected');
    expect($hospitalOwner->fresh()->approved_at)->toBeNull();
    expect($hospitalOwner->fresh()->rejection_reason)->toBe('Incomplete hospital documents');
});

it('prevents a rejected hospital owner from logging in', function () {
    $hospitalOwner = User::factory()->create([
        'email' => 'owner@example.com',
        'password' => bcrypt('password'),
        'approval_status' => 'rejected',
    ]);
    $hospitalOwner->assignRole('hospital_owner');

    $response = $this->post(route('login'), [
        'email' => 'owner@example.com',
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors([
        'email' => 'Your hospital account has been rejected. Please contact support.',
    ]);
    $this->assertGuest();
});

it('allows a hospital owner to update only their own booking status', function () {
    Mail::fake();

    $owner = User::factory()->create([
        'approval_status' => 'approved',
        'hospital_name' => 'Care Hospital',
    ]);
    $owner->assignRole('hospital_owner');

    $otherOwner = User::factory()->create([
        'approval_status' => 'approved',
        'hospital_name' => 'Other Hospital',
    ]);
    $otherOwner->assignRole('hospital_owner');

    $doctor = Doctor::create([
        'owner_id' => $owner->id,
        'name' => 'Dr Example',
        'status' => 'active',
    ]);

    $booking = DoctorBooking::create([
        'doctor_id' => $doctor->id,
        'hospital_owner_id' => $owner->id,
        'patient_name' => 'Patient One',
        'patient_phone' => '01700000000',
        'patient_email' => 'patient@example.com',
        'patient_age' => 30,
        'status' => 'pending',
    ]);

    $response = $this->actingAs($owner)->patch(route('admin.doctor-bookings.update-status', $booking), [
        'status' => 'confirmed',
    ]);

    $response->assertRedirect(route('admin.doctor-bookings.index'));
    expect($booking->fresh()->status)->toBe('confirmed');

    $forbidden = $this->actingAs($otherOwner)->patch(route('admin.doctor-bookings.update-status', $booking), [
        'status' => 'cancelled',
    ]);

    $forbidden->assertForbidden();
    expect($booking->fresh()->status)->toBe('confirmed');
});

it('exports filtered booking data as csv for admin', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $owner = User::factory()->create([
        'approval_status' => 'approved',
        'hospital_name' => 'Care Hospital',
    ]);
    $owner->assignRole('hospital_owner');

    $doctor = Doctor::create([
        'owner_id' => $owner->id,
        'name' => 'Dr Export',
        'status' => 'active',
    ]);

    DoctorBooking::create([
        'doctor_id' => $doctor->id,
        'hospital_owner_id' => $owner->id,
        'patient_name' => 'CSV Patient',
        'patient_phone' => '01800000000',
        'patient_email' => 'csv@example.com',
        'patient_age' => 35,
        'status' => 'confirmed',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.doctor-bookings.export', [
        'status' => 'confirmed',
    ]));

    $response->assertOk();
    $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
    expect($response->streamedContent())->toContain('CSV Patient');
    expect($response->streamedContent())->toContain('csv@example.com');
});

it('shows booking details page to the owning hospital owner only', function () {
    $owner = User::factory()->create([
        'approval_status' => 'approved',
        'hospital_name' => 'Care Hospital',
    ]);
    $owner->assignRole('hospital_owner');

    $otherOwner = User::factory()->create([
        'approval_status' => 'approved',
        'hospital_name' => 'Other Hospital',
    ]);
    $otherOwner->assignRole('hospital_owner');

    $doctor = Doctor::create([
        'owner_id' => $owner->id,
        'name' => 'Dr Details',
        'status' => 'active',
    ]);

    $booking = DoctorBooking::create([
        'doctor_id' => $doctor->id,
        'hospital_owner_id' => $owner->id,
        'patient_name' => 'Detail Patient',
        'patient_phone' => '01900000000',
        'patient_email' => 'detail@example.com',
        'patient_age' => 28,
        'status' => 'pending',
    ]);

    $allowed = $this->actingAs($owner)->get(route('admin.doctor-bookings.show', $booking));
    $allowed->assertOk();
    $allowed->assertSee('Detail Patient');

    $forbidden = $this->actingAs($otherOwner)->get(route('admin.doctor-bookings.show', $booking));
    $forbidden->assertForbidden();
});

it('returns booking summary and applies patient search filters', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $owner = User::factory()->create([
        'approval_status' => 'approved',
        'hospital_name' => 'Search Hospital',
    ]);
    $owner->assignRole('hospital_owner');

    $doctor = Doctor::create([
        'owner_id' => $owner->id,
        'name' => 'Dr Search',
        'status' => 'active',
    ]);

    DoctorBooking::create([
        'doctor_id' => $doctor->id,
        'hospital_owner_id' => $owner->id,
        'patient_name' => 'Rahim Uddin',
        'patient_phone' => '01511111111',
        'patient_email' => 'rahim@example.com',
        'patient_age' => 40,
        'status' => 'pending',
    ]);

    DoctorBooking::create([
        'doctor_id' => $doctor->id,
        'hospital_owner_id' => $owner->id,
        'patient_name' => 'Karim Mia',
        'patient_phone' => '01622222222',
        'patient_email' => 'karim@example.com',
        'patient_age' => 29,
        'status' => 'confirmed',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.doctor-bookings.summary', [
        'q' => 'Rahim',
    ]));

    $response->assertOk();
    $response->assertJsonPath('totals.all', 1);
    $response->assertJsonPath('totals.pending', 1);
    $response->assertJsonPath('totals.confirmed', 0);
    $response->assertJsonFragment([
        'label' => 'Dr Search',
        'total' => 1,
    ]);
});

it('updates booking notes and renders print report for owner', function () {
    $owner = User::factory()->create([
        'approval_status' => 'approved',
        'hospital_name' => 'Print Hospital',
    ]);
    $owner->assignRole('hospital_owner');

    $doctor = Doctor::create([
        'owner_id' => $owner->id,
        'name' => 'Dr Print',
        'status' => 'active',
    ]);

    $booking = DoctorBooking::create([
        'doctor_id' => $doctor->id,
        'hospital_owner_id' => $owner->id,
        'patient_name' => 'Printable Patient',
        'patient_phone' => '01400000000',
        'patient_email' => 'print@example.com',
        'patient_age' => 31,
        'status' => 'pending',
    ]);

    $update = $this->actingAs($owner)->patch(route('admin.doctor-bookings.update-notes', $booking), [
        'notes' => 'Follow up after lab report.',
    ]);

    $update->assertRedirect(route('admin.doctor-bookings.show', $booking));
    expect($booking->fresh()->notes)->toBe('Follow up after lab report.');

    $print = $this->actingAs($owner)->get(route('admin.doctor-bookings.print', [
        'q' => 'Printable',
    ]));

    $print->assertOk();
    $print->assertSee('Doctor Bookings Report');
    $print->assertSee('Printable Patient');
});

it('stores booking status history and shows dashboard trend data', function () {
    $owner = User::factory()->create([
        'approval_status' => 'approved',
        'hospital_name' => 'Trend Hospital',
    ]);
    $owner->assignRole('hospital_owner');

    $doctor = Doctor::create([
        'owner_id' => $owner->id,
        'name' => 'Dr Trend',
        'status' => 'active',
    ]);

    $booking = DoctorBooking::create([
        'doctor_id' => $doctor->id,
        'hospital_owner_id' => $owner->id,
        'patient_name' => 'Trend Patient',
        'patient_phone' => '01300000000',
        'patient_age' => 33,
        'status' => 'pending',
        'created_at' => now()->subMonth(),
        'updated_at' => now()->subMonth(),
    ]);

    $response = $this->actingAs($owner)->patch(route('admin.doctor-bookings.update-status', $booking), [
        'status' => 'confirmed',
        'status_reason' => 'Doctor approved the visit slot.',
    ]);

    $response->assertRedirect(route('admin.doctor-bookings.index'));
    expect($booking->fresh()->statusHistory)->toHaveCount(1);
    expect($booking->fresh()->statusHistory->first()->from_status)->toBe('pending');
    expect($booking->fresh()->statusHistory->first()->to_status)->toBe('confirmed');
    expect($booking->fresh()->statusHistory->first()->reason)->toBe('Doctor approved the visit slot.');

    $details = $this->actingAs($owner)->get(route('admin.doctor-bookings.show', $booking));
    $details->assertOk();
    $details->assertSee('Status History');
    $details->assertSee('Confirmed');
    $details->assertSee('Doctor approved the visit slot.');

    $dashboard = $this->actingAs($owner)->get(route('admin.dashboard'));
    $dashboard->assertOk();
    $dashboard->assertSee('Monthly Booking Trend');
    $dashboard->assertSee('Booking Status Overview');
});

it('shows doctor analytics page', function () {
    $owner = User::factory()->create([
        'approval_status' => 'approved',
        'hospital_name' => 'Analytics Hospital',
    ]);
    $owner->assignRole('hospital_owner');

    $doctor = Doctor::create([
        'owner_id' => $owner->id,
        'name' => 'Dr Analytics',
        'status' => 'active',
    ]);

    DoctorBooking::create([
        'doctor_id' => $doctor->id,
        'hospital_owner_id' => $owner->id,
        'patient_name' => 'Analytics Patient',
        'patient_phone' => '01200000000',
        'patient_age' => 26,
        'status' => 'confirmed',
    ]);

    $response = $this->actingAs($owner)->get(route('admin.doctor-bookings.analytics'));

    $response->assertOk();
    $response->assertSee('Doctor Analytics');
    $response->assertSee('Dr Analytics');
    $response->assertSee('Analytics Hospital');
});
