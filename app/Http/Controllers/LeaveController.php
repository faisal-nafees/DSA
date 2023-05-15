<?php

namespace App\Http\Controllers;

use App\Mail\LeaveApprovedMail;
use App\Mail\LeaveMail;
use App\Models\Common_model;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class LeaveController extends Controller
{
    public function manage(Request $request)
    {
        $model = new Common_model();
        $users = $model->fetch_data('tbl_users', 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
        $leaves = $model->fetch_data('tbl_leaves', 'tbl_leave_status', 'tbl_leaves.leave_status', 'tbl_leave_status.leave_status_id', 'tbl_users', 'tbl_leaves.user_id', 'tbl_users.user_id');
        if (request()->isMethod('post')) {
            $leaves = $model->search_data('tbl_leaves', 'user_id', $request->start_date, $request->end_date, 'leave_start', $request->user_id, 'tbl_users', 'tbl_leaves.user_id', 'tbl_users.user_id', 'tbl_leave_status', 'tbl_leaves.leave_status', 'tbl_leave_status.leave_status_id');
            return view('admin.manage-leaves', compact(['leaves', 'users']));
        }
        return view('admin.manage-leaves', compact(['leaves', 'users']));
    }

    public function add(Request $request)
    {
        $model = new Common_model();
        if (request()->isMethod('post')) {

            $dataArray = $request->except('_token');
            $dataArray['user_id'] = auth()->user()->user_id;
            $dataArray['leave_status'] = 1;
            $username = auth()->user()->firstname . ' ' . auth()->user()->lastname;

            if ($model->insert_data('tbl_leaves', $dataArray)) {
                Config::set('mail.from.name', $username);
                Mail::to(env('MAIL_TO_ADDRESS'))->send(new LeaveMail($dataArray));

                return redirect('/manage-leaves')->with('success', 'Leave added successfully');
            } else {
                return redirect('/manage-leaves')->with('error', 'Error while adding Leave');
            }
        } else {
            return view('admin.add-leave');
        }
    }

    public function edit(Request $request, $id)
    {
        $model = new Common_model();
        $leave = $model->fetch_where('tbl_leaves', 'leave_id', $id);
        $user = $model->fetch_where('tbl_users', 'user_id', $leave->user_id);

        if (request()->isMethod('post')) {
            $dataArray = $request->except('_token');

            if ($model->edit_data('tbl_leaves', 'leave_id', $id, $dataArray)) {
                if ($dataArray['leave_status'] == 4) {
                    $username = $user->firstname . ' ' . $user->lastname;
                    $userEmail = $user->personal_email;
                    Config::set('mail.from.name', 'DSA IT Team');
                    Mail::to($userEmail)->send(new LeaveApprovedMail($username));
                }
                return redirect('/manage-leaves')->with('success', 'Leave updated successfully');
            } else {
                return redirect('/manage-leaves')->with('error', 'Error while updating leave');
            }
        } else {
            $leave_status = $model->fetch_data('tbl_leave_status');
            return view('admin.edit-leave', compact(['leave', 'leave_status']));
        }
    }
}
