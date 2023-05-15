<?php

namespace App\Http\Controllers;

use App\Models\Common_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Exception;

class ContactsController extends Controller
{
    public function manage(Request $request)
    {
        $model = new Common_model();
        $contacts = $model->fetch_data('tbl_contacts');
        return view('admin.manage-contacts', compact('contacts'));
    }

    public function sendMail(Request $request)
    {
        // dd($request);
        $recipientEmail = 'mofaisal739@gmail.com';
        $dataArray = $request->all();

        try {
            Mail::to($recipientEmail)->send(new ContactMail);
        } catch (Exception $e) {
            return response($e);
            // Log the error or display a custom error message
            // For debugging purposes, you can also dump the exception using `dd($e)` to see the full error details
        }
        $model = new Common_model();

        if ($model->insert_data('tbl_contact_reply', $dataArray)) {
            return response('Message send successfully');
        } else {
            return response('Error while sending message');
        }
        // Mail::to('mofaisal739@gmail.com')->send(new ContactMail());
    }
}
