<?php

namespace App\Http\Controllers;

use App\Models\Common_model;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function manage(Request $request)
    {
        $model = new Common_model();

        if (request()->isMethod('post')) {
            $users = $model->search_data('tbl_users', null, $request->start_date, $request->end_date, null,  'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
            return view('admin.manage-user', compact(['users']));
        }
        $tasks = $model->fetch_data('tbl_task', 'tbl_users', 'tbl_task.user_id', 'tbl_users.user_id', 'tbl_report_status', 'tbl_task.report_status_id', 'tbl_report_status.status_id');
        // return $tasks;
        return view('admin.manage-tasks', compact('tasks'));

        // return view('admin.manage-tasks');
    }

    public function add(Request $request)
    {
        $model = new Common_model();
        if (request()->isMethod('post')) {

            $dataArray = $request->except('_token');
            if ($model->insert_data('tbl_task', $dataArray)) {
                return redirect('/manage-tasks')->with('success', 'Task added successfully');
            } else {
                return redirect('/manage-tasks')->with('error', 'Error while adding task');
            }
        } else {
            $users = $model->fetch_data('tbl_users', 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
            return view('admin.add-task', compact('users'));
        }
    }
}
