<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function sendBasicEmail()
    {
        $data = ['name' => "Test User"];

        Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('recipient@example.com', 'DebugMail User')
                ->subject('Basic Testing Email');
            $message->from('debug@example.com', 'Laravel App');
        });

        return response()->json(['message' => 'Basic Email Sent. Check DebugMail inbox.']);
    }

    public function basic_email()
    {
        $data = ['name' => "Debug User"];

        Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('recipient@example.com', 'Recipient Name')
                ->subject('Laravel Basic Testing Mail');
            $message->from('debug@example.com', 'Your App Name');
        });

        return "Basic Email Sent. Check your inbox.";
    }
    public function html_email()
    {
        $data = ['name' => "Debug User"];

        Mail::send('mail', $data, function ($message) {
            $message->to('recipient@example.com', 'Recipient Name')
                ->subject('Laravel HTML Testing Mail');
            $message->from('debug@example.com', 'Your App Name');
        });

        return "HTML Email Sent. Check your inbox.";
    }

    public function attachment_email()
    {
        $data = ['name' => "Debug User"];

        Mail::send('mail', $data, function ($message) {
            $message->to('recipient@example.com', 'Recipient Name')
                ->subject('Laravel Testing Mail with Attachment');
            $message->attach(public_path('uploads/sample.png'));
            $message->from('debug@example.com', 'Your App Name');
        });

        return "Email Sent with attachment. Check your inbox.";
    }
}
