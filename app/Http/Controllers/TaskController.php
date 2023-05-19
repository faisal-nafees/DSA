<?php

namespace App\Http\Controllers;

use App\Mail\TaskMail;
use App\Mail\UserTaskMail;
use App\Models\Common_model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{

    public function manage(Request $request)
    {
        $model = new Common_model();
        $users = $model->fetch_data('tbl_users', 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
        if (request()->isMethod('post')) {
            $tasks = $model->search_data('tbl_task', 'user_id', $request->start_date, $request->end_date, 'assigned_date', $request->user_id, 'tbl_users', 'tbl_task.user_id', 'tbl_users.user_id', 'tbl_report_status', 'tbl_task.report_status_id', 'tbl_report_status.status_id');
            return view('admin.manage-tasks', compact(['tasks', 'users']));
        }
        $tasks = $model->fetch_data('tbl_task', 'tbl_users', 'tbl_task.user_id', 'tbl_users.user_id', 'tbl_report_status', 'tbl_task.report_status_id', 'tbl_report_status.status_id');
        return view('admin.manage-tasks', compact(['tasks', 'users']));
    }

    public function add(Request $request)
    {
        $model = new Common_model();
        if (request()->isMethod('post')) {
            $dataArray = $request->except('_token');
            if ($request->hasFile('attachment_1')) {
                $attachment = $request->file('attachment_1');
                $attachmentPath = $this->fileSave($attachment, 'task', 'attachment_1');
                $dataArray['attachment_1'] = $attachmentPath;
            } else {
                $dataArray['attachment_1'] = null;
            }
            if ($request->hasFile('attachment_2')) {
                $attachment = $request->file('attachment_2');
                $attachmentPath = $this->fileSave($attachment, 'task', 'attachment_2');
                $dataArray['attachment_2'] = $attachmentPath;
            } else {
                $dataArray['attachment_2'] = null;
            }
            $user = $model->fetch_where('tbl_users', 'user_id', $dataArray['user_id']);

            if ($model->insert_data('tbl_task', $dataArray)) {
                Mail::to(env('MAIL_TO_ADDRESS'))->send(new TaskMail($dataArray));
                Mail::to($user->personal_email)->send(new UserTaskMail($dataArray));

                return redirect('/manage-tasks')->with('success', 'Task added successfully');
            } else {
                return redirect('/manage-tasks')->with('error', 'Error while adding task');
            }
        } else {
            $users = $model->fetch_data('tbl_users', 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
            return view('admin.add-task', compact('users'));
        }
    }

    public function edit(Request $request, $id)
    {
        $model = new Common_model();

        if (request()->isMethod('post')) {
            $dataArray = $request->except('_token');
            $task = $model->fetch_where('tbl_task', 'task_id', $id);

            if ($request->hasFile('attachment_1')) {
                $attachment = $request->file('attachment_1');
                $oldImage = $task->attachment_1;
                if ($oldImage) {
                    // Delete the previous image
                    Storage::disk('public')->delete('/' . $oldImage);
                }
                $attachmentPath = $this->fileSave($attachment, 'task', 'attachment_1');
                $dataArray['attachment_1'] = $attachmentPath;
            }
            if ($request->hasFile('attachment_2')) {
                $attachment = $request->file('attachment_2');
                $oldImage = $task->attachment_2;
                if ($oldImage) {
                    // Delete the previous image
                    Storage::disk('public')->delete('/' . $oldImage);
                }
                $attachmentPath = $this->fileSave($attachment, 'task', 'attachment_2');
                $dataArray['attachment_2'] = $attachmentPath;
            }

            if ($model->edit_data('tbl_task', 'task_id', $id, $dataArray)) {
                $authUser = auth()->user()->firstname . ' ' . auth()->user()->lastname;
                $data = [
                    'type' => 'Edit',
                    'module' => 'Task',
                    'username' => $authUser
                ];
                Mail::send('emails.CrudNotification', $data, function ($message) use ($authUser) {
                    $message->to(env('MAIL_TO_ADDRESS'))->subject($authUser . "Edit a Task");
                });
                return redirect('/manage-tasks')->with('success', 'Task updated successfully');
            } else {
                return redirect('/manage-tasks')->with('error', 'Error while updating task');
            }
        } else {
            $users = $model->fetch_data('tbl_users', 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
            $task = $model->fetch_where('tbl_task', 'task_id', $id);
            $report_status = $model->fetch_data('tbl_report_status');
            return view('admin.edit-task', compact(['users', 'task', 'report_status']));
        }
    }

    public function delete($id)
    {
        $model = new Common_model();

        if ($model->delete_data('tbl_task', 'task_id', $id)) {
            $authUser = auth()->user()->firstname . ' ' . auth()->user()->lastname;
            $data = [
                'type' => 'Delete',
                'module' => 'Task',
                'username' => $authUser
            ];
            Mail::send('emails.CrudNotification', $data, function ($message) use ($authUser) {
                $message->to(env('MAIL_TO_ADDRESS'))->subject($authUser . "Delete a Task");
            });
            return redirect('/manage-tasks')->with('message', 'Task deleted successfully');
        }
    }

    public function todayTask()
    {
        $model = new Common_model();
        $currentDate = Carbon::now()->toDateString();
        $users = $model->fetch_data('tbl_users', 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
        $tasks = $model->search_today('tbl_task', $currentDate, 'assigned_date', null, null,  'tbl_users', 'tbl_task.user_id', 'tbl_users.user_id', 'tbl_report_status', 'tbl_task.report_status_id', 'tbl_report_status.status_id');
        return view('admin.manage-tasks', compact(['users', 'tasks']));
    }

    public function fileSave($file, $type, $filename)
    {
        $extension          = $file->getClientOriginalExtension();
        $attachmentPath = $file->storeAs('attachments/' . $type, $filename . '_' . time() . '.' . $extension, 'public');
        return $attachmentPath;
    }
}