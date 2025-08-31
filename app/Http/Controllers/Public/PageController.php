<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;

class PageController extends Controller
{
    /**
     * Show About Us page
     */
    public function about()
    {
        return view('public.about.index');
    }

    /**
     * Show Contact Us page
     */
    public function contact()
    {
        return view('public.contact.index');
    }

    /**
     * Handle contact form submission
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Save to database
        $message = ContactMessage::create($validated);

        // Send email notification
        Mail::to('info@yourdomain.com')->send(new ContactFormSubmitted($message));

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}