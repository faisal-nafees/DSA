<?php

namespace App\Http\Controllers;

use App\Mail\ReportMail;
use App\Models\Common_model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReportingController extends Controller
{
    public function manage(Request $request)
    {
        $model = new Common_model();
        $currentDate = Carbon::now()->toDateString();
        $today_report = DB::table('tbl_reporting')
            ->where('user_id', auth()->user()->user_id)
            ->where('report_date', $currentDate)
            ->first();
        $report_status = $model->fetch_data('tbl_report_status');
        $users = $model->fetch_data('tbl_users', 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
        $tasks = $model->fetch_data('tbl_task', 'tbl_users', 'tbl_task.user_id', 'tbl_users.user_id');
        if (request()->isMethod('post')) {
            $reports = $model->search_data('tbl_reporting', 'user_id', $request->start_date, $request->end_date, 'report_date', $request->user_id, 'tbl_task', 'tbl_reporting.task_id', 'tbl_task.task_id', 'tbl_users', 'tbl_task.user_id', 'tbl_users.user_id', 'tbl_report_status', 'tbl_task.report_status_id', 'tbl_report_status.status_id');
            return view('admin.reporting', compact(['reports', 'tasks', 'report_status', 'users', 'today_report']));
        }
        $reports = $model->fetch_data('tbl_reporting', 'tbl_task', 'tbl_reporting.task_id', 'tbl_task.task_id', 'tbl_users', 'tbl_task.user_id', 'tbl_users.user_id', 'tbl_report_status', 'tbl_task.report_status_id', 'tbl_report_status.status_id');
        return view('admin.reporting', compact(['tasks', 'report_status', 'reports', 'users', 'today_report']));
    }

    public function add(Request $request)
    {
        $model = new Common_model();
        if (request()->isMethod('post')) {
            $current_date = Carbon::now('Asia/Kolkata')->toDateString();
            $attendance = $model->fetch_where('tbl_attendance', 'user_id', auth()->user()->user_id, null, 'date', $current_date);
            $data = [
                'task_id' => $request->task_id,
            ];
            $model->edit_data('tbl_attendance', 'attn_id', $attendance->attn_id, $data);


            $dataArray = $request->except('_token', 'report_status_id');
            $dataArray['user_id'] = auth()->user()->user_id;
            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $attachmentPath = $this->fileSave($attachment, 'report', 'attachment');
                $dataArray['attachment'] = $attachmentPath;
            } else {
                $dataArray['attachment'] = null;
            }
            $data = $model->fetch_where('tbl_task', 'task_id', $dataArray['task_id'], null, null, null, 'tbl_report_status', 'tbl_task.report_status_id', 'tbl_report_status.status_id');
            if ($model->insert_data('tbl_reporting', $dataArray)) {
                $taskData = [
                    'report_status_id' => $request->report_status_id
                ];
                $dataArray['title'] = $data->title;
                $dataArray['status_name'] = $data->status_name;
                Mail::to(env('MAIL_TO_ADDRESS'))->send(new ReportMail($dataArray));
                $model->edit_data('tbl_task', 'task_id', $dataArray['task_id'], $taskData);

                return redirect('/reporting')->with('success', 'Report added successfully');
            } else {
                return redirect('/reporting')->with('error', 'Error while reporting');
            }
        }
    }

    public function todayReport()
    {
        $model = new Common_model();
        $currentDate = Carbon::now()->toDateString();
        $today_report = DB::table('tbl_reporting')
            ->where('user_id', auth()->user()->user_id)
            ->where('report_date', $currentDate)
            ->first();
        $report_status = $model->fetch_data('tbl_report_status');
        $users = $model->fetch_data('tbl_users', 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
        $tasks = $model->fetch_data('tbl_task', 'tbl_users', 'tbl_task.user_id', 'tbl_users.user_id');
        $reports = $model->search_today('tbl_reporting', $currentDate, 'report_date', null, null,  'tbl_task', 'tbl_reporting.task_id', 'tbl_task.task_id', 'tbl_users', 'tbl_task.user_id', 'tbl_users.user_id', 'tbl_report_status', 'tbl_reporting.report_status_id', 'tbl_report_status.status_id');
        return view('admin.reporting', compact(['reports', 'tasks', 'report_status', 'users', 'today_report']));
    }

    public function fileSave($file, $type, $filename)
    {
        $extension          = $file->getClientOriginalExtension();
        $attachmentPath = $file->storeAs('attachments/' . $type, $filename . '_' . time() . '.' . $extension, 'public');
        return $attachmentPath;
    }
}