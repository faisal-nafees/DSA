<?php

namespace App\Http\Controllers;

use App\Mail\EnquiryMail;
use App\Models\Common_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{

    public function manage(Request $request)
    {
        $model = new Common_model();
        $enq_type = $model->fetch_data('tbl_type');
        $lead_actions = $model->fetch_data('tbl_lead_action');
        $followups = $model->fetch_data('tbl_followup_master');
        if (request()->isMethod('post')) {
            $enquiries = $model->search_data('tbl_enquiry', 'enq_type', $request->start_date, $request->end_date, 'enquiry_date', $request->enqtype_id, 'tbl_lead_status', 'tbl_enquiry.status_id', 'tbl_lead_status.status_id', 'tbl_type', 'tbl_enquiry.enq_type', 'tbl_type.enqtype_id', 'tbl_users', 'tbl_enquiry.created_user', 'tbl_users.user_id');
            return view('admin.manage-enquiry', compact(['enquiries', 'enq_type', 'lead_actions', 'followups']));
        }
        $enquiries = $model->fetch_data('tbl_enquiry', 'tbl_lead_status', 'tbl_enquiry.status_id', 'tbl_lead_status.status_id', 'tbl_type', 'tbl_enquiry.enq_type', 'tbl_type.enqtype_id', 'tbl_users', 'tbl_enquiry.created_user', 'tbl_users.user_id');
        // return $followups;
        return view('admin.manage-enquiry', compact(['enquiries', 'enq_type', 'lead_actions', 'followups']));
    }

    public function add(Request $request)
    {
        $model = new Common_model();
        if (request()->isMethod('post')) {
            $dataArray = $request->except('_token');
            $dataArray['created_user'] = auth()->user()->user_id;
            $dataArray['updated_user'] = auth()->user()->user_id;
            if ($model->insert_data('tbl_enquiry', $dataArray)) {
                Mail::to(env('MAIL_TO_ADDRESS'))->send(new EnquiryMail($dataArray));
                return redirect('/manage-enquiries')->with('success', 'Enquiry added successfully');
            } else {
                return redirect('/manage-enquiries')->with('error', 'Error while adding enquiry');
            }
        } else {
            $enq_type = $model->fetch_data('tbl_type');
            $sources = $model->fetch_data('tbl_lead_source');
            $lead_status = $model->fetch_data('tbl_lead_status');
            return view('admin.add-enquiry', compact(['enq_type', 'sources', 'lead_status']));
        }
    }

    public function edit(Request $request, $id)
    {
        $model = new Common_model();

        if (request()->isMethod('post')) {
            $dataArray = $request->except('_token');
            $dataArray['updated_user'] = auth()->user()->user_id;
            if ($model->edit_data('tbl_enquiry', 'enq_id', $id, $dataArray)) {
                $authUser = auth()->user()->firstname . ' ' . auth()->user()->lastname;
                $data = [
                    'type' => 'Edit',
                    'module' => 'Enquiry',
                    'username' => $authUser
                ];
                Mail::send('emails.CrudNotification', $data, function ($message) use ($authUser) {
                    $message->to(env('MAIL_TO_ADDRESS'))->subject($authUser . "Edit a Enquiry");
                });
                return redirect('/manage-enquiries')->with('success', 'Enquiry updated successfully');
            } else {
                return redirect('/manage-enquiries')->with('error', 'Error while updating enquiry');
            }
        } else {
            $enquiry = $model->fetch_where('tbl_enquiry', 'enq_id', $id, null, null, null, 'tbl_lead_status', 'tbl_enquiry.status_id', 'tbl_lead_status.status_id');
            $enq_type = $model->fetch_data('tbl_type');
            $sources = $model->fetch_data('tbl_lead_source');
            $status = $model->fetch_data('tbl_lead_status');
            return view('admin.edit-enquiry', compact(['enquiry', 'enq_type', 'sources', 'status']));
        }
    }

    public function delete($id)
    {
        $model = new Common_model();
        if ($model->delete_data('tbl_enquiry', 'enq_id', $id)) {
            $authUser = auth()->user()->firstname . ' ' . auth()->user()->lastname;
            $data = [
                'type' => 'Delete',
                'module' => 'Enquiry',
                'username' => $authUser
            ];
            Mail::send('emails.CrudNotification', $data, function ($message) use ($authUser) {
                $message->to(env('MAIL_TO_ADDRESS'))->subject($authUser . "Delete a Enquiry");
            });
            return redirect('/manage-enquiries')->with('message', 'Enquiry deleted successfully');
        }
    }

    public function search(Request $request)
    {
        // return $request;
        $model = new Common_model();
        $searchData = $model->search_data('tbl_enquiry', 'enq_type', $request->enqtype_id, $request->start_date, $request->end_date);
    }
}
