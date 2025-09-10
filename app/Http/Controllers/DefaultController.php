<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMsgRequest;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function contactMessageStore(ContactMsgRequest $request)
    {
        ContactMessage::create($request->validated());

        return back()->with('success', 'Thank you for contacting us!');
    }
}
