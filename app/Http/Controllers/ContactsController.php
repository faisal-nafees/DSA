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
        if (request()->isMethod('post')) {
            $contacts = $model->search_data('tbl_contacts', null, $request->start_date, $request->end_date, 'created_at');
            return view('admin.manage-contacts', compact(['contacts']));
        }
        $contacts = $model->fetch_data('tbl_contacts');
        return view('admin.manage-contacts', compact('contacts'));
    }

    public function sendMail(Request $request)
    {
        $recipientEmail = $request->email;
        $dataArray = $request->except('email');
        $model = new Common_model();

        if ($model->insert_data('tbl_contact_reply', $dataArray)) {
            Mail::to($recipientEmail)->send(new ContactMail($dataArray));
            return response('Message send successfully');
        } else {
            return response('Error while sending message');
        }
    }
}
