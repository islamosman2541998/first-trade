<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        return view('admin.contact-messages.index');
    }

    public function show(ContactMessage $contactMessage): View
    {
        if ($contactMessage->isUnread()) {
            $contactMessage->update([
                'read_at' => now(),
                'status' => ContactMessage::STATUS_READ,
            ]);
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }
}