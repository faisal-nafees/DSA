<?php

namespace App\Http\Controllers;

use App\Models\Common_model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FollowupController extends Controller
{
    public function add(Request $request)
    {
        $model = new Common_model();
        if ($request->isMethod('post')) {
            // return $request;
            $followup = $model->fetch_latest_data('tbl_followup_master', 'lead_id', $request->lead_id, 'desc', 'created_date');
            if ($followup) {
                $model->edit_data('tbl_followup_master', 'followup_id', $followup->followup_id, ['followup_status' => '0']);
            }
            $dataArray = $request->all();
            $dataArray['followup_by'] = auth()->user()->user_id;
            $dataArray['created_by'] = auth()->user()->user_id;
            $dataArray['update_id'] = auth()->user()->user_id;

            if ($model->insert_data('tbl_followup_master', $dataArray)) {
                $authUser = auth()->user()->firstname . ' ' . auth()->user()->lastname;
                $data = [
                    'type' => 'Add',
                    'module' => 'Followup',
                    'username' => $authUser
                ];
                Mail::send('emails.CrudNotification', $data, function ($message) use ($authUser) {
                    $message->to(env('MAIL_TO_ADDRESS'))->subject($authUser . "Add a Followup");
                });
                return response('Followup added successfully');
            } else {
                return response('Error while adding followup');
            }
        } else {
            return response('Some thing went wrong');
        }
    }

    public function view($id)
    {
        $model = new Common_model();
        $followups = $model->fetch_where('tbl_followup_master', 'lead_id', $id, 'all', null, null, 'tbl_users', 'tbl_followup_master.followup_by', 'tbl_users.user_id', 'tbl_lead_action', 'tbl_followup_master.lead_action', 'tbl_lead_action.action_id', 'tbl_enquiry', 'tbl_followup_master.lead_id', 'tbl_enquiry.enq_id');
        return response($followups);
    }

    public function todayFollowup()
    {
        $model = new Common_model();
        $currentDate = Carbon::now()->toDateString();
        $enq_type = $model->fetch_data('tbl_type');
        $lead_actions = $model->fetch_data('tbl_lead_action');
        $followups = $model->fetch_data('tbl_followup_master');
        $enquiries = $model->search_today('tbl_followup_master', $currentDate, 'next_followup_date', 'followup_status', '1',  'tbl_enquiry', 'tbl_followup_master.lead_id', 'tbl_enquiry.enq_id', 'tbl_type', 'tbl_enquiry.enq_type', 'tbl_type.enqtype_id', 'tbl_users', 'tbl_enquiry.created_user', 'tbl_users.user_id', 'tbl_lead_status', 'tbl_enquiry.status_id', 'tbl_lead_status.status_id',);
        return view('admin.manage-enquiry', compact(['enquiries', 'enq_type', 'lead_actions', 'followups']));
    }
}
