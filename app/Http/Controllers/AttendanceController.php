<?php

namespace App\Http\Controllers;

use App\Mail\UserAttendanceMail;
use App\Models\Common_model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AttendanceController extends Controller
{
    public function manage(Request $request)
    {

        $model = new Common_model();
        $current_date = Carbon::now('Asia/Kolkata')->toDateString();
        $users = $model->fetch_data('tbl_users', 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
        if (request()->isMethod('post')) {
            $attendances = $model->search_data('tbl_attendance', 'user_id', $request->start_date, $request->end_date, 'date', $request->user_id, 'tbl_users', 'tbl_attendance.user_id', 'tbl_users.user_id',);
            return view('admin.manage-attendance', compact(['attendances', 'users']));
        }
        $my_attendance = $model->fetch_where('tbl_attendance', 'user_id', auth()->user()->user_id, null, 'date', $current_date);
        $storedDateTime = Carbon::parse($my_attendance->time_login);
        $currentDateTime = Carbon::now()->addHours(5)->addMinutes(30);

        $timeDifference = $currentDateTime->diff($storedDateTime);
        $formatTime = $timeDifference->format('%h hours %i minutes');
        $dataArray = [
            'worked_hours' => $formatTime,
        ];
        $currentTime = $currentDateTime->format('H:i:s');
        $targetTime = '18:30:00';
        if ($currentTime < $targetTime && !$my_attendance->time_logout) {
            $model->edit_data('tbl_attendance', 'attn_id', $my_attendance->attn_id, $dataArray);
        }
        $this->updateAllAttendance();

        $attendances = $model->fetch_where('tbl_attendance', 'tbl_attendance.user_id', auth()->user()->user_id, 'all', null, null, 'tbl_users', 'tbl_attendance.user_id', 'tbl_users.user_id');
        return view('admin.manage-attendance', compact(['attendances', 'users']));
    }

    public function edit(Request $request, $id)
    {
        $model = new Common_model();
        if (request()->isMethod('post')) {
            $time = $request['time_logout'];
            $date = $request['date'];

            $time_logout = Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . $time);
            $attendance = $model->fetch_where('tbl_attendance', 'attn_id', $id);
            $user = $model->fetch_where('tbl_users', 'user_id', $attendance->user_id);
            $time_login = Carbon::createFromFormat('Y-m-d H:i:s', $attendance->time_login);
            $timeDifference = $time_logout->diff($time_login);
            $formatTime = $timeDifference->format('%h hours %i minutes');
            $dataArray = [
                'time_logout' => $time_logout,
                'worked_hours' => $formatTime,
            ];
            if ($timeDifference->i == 9) {
                $dataArray['worked_hours'] = $formatTime;
            }
            if ($model->edit_data('tbl_attendance', 'attn_id', $id, $dataArray)) {
                $dataArray['username'] = $user->firstname . ' ' . $user->lastname;
                // Mail::to(env('MAIL_TO_ADDRESS'))->send(new TaskMail($dataArray));
                Mail::to($user->personal_email)->send(new UserAttendanceMail($dataArray));
                return response('Attendance updated successfully');
            } else {
                return response('Error while updating attendance');
            }
        }
        $attendance = $model->fetch_where('tbl_attendance', 'attn_id', $id);
        return response(['data' => $attendance]);
    }

    public function todayAttendance()
    {
        $model = new Common_model();
        $currentDate = Carbon::now()->toDateString();
        $users = $model->fetch_data('tbl_users', 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
        $attendances = $model->search_today('tbl_attendance', $currentDate, 'date', null, null,  'tbl_users', 'tbl_attendance.user_id', 'tbl_users.user_id');
        return view('admin.manage-attendance', compact(['users', 'attendances']));
    }

    public function updateAllAttendance()
    {
        $model = new Common_model();
        $attendances = $model->fetch_data('tbl_attendance');
        foreach ($attendances as $attendance) {
            if ($attendance->time_logout) {
                $login_time = Carbon::parse($attendance->time_login);
                $logout_time = Carbon::parse($attendance->time_logout);
                $timeDifference = $logout_time->diff($login_time);
                $formatTime = $timeDifference->format('%h hours %i minutes');
                $dataArray = [
                    'worked_hours' => $formatTime,
                ];
                $model->edit_data('tbl_attendance', 'attn_id', $attendance->attn_id, $dataArray);
            }
        }
    }
}
