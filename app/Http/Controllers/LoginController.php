<?php

namespace App\Http\Controllers;

use App\Mail\LoginMail;
use App\Mail\UserLoginMail;
use App\Models\Common_model;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (request()->isMethod('post')) {
            $credentials = ['company_webmail' => $request->email, 'password' => $request->password];
            if (Auth::attempt($credentials)) {

                $this->attendance();
                return redirect('/dashboard');
            } else {
                // Authentication failed, redirect back with error message
                return redirect()->back()->with('error', 'Invalid credentials');
            }
        } else {
            return view('admin.login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }

    public function markout()
    {
        $model = new Common_model();
        $user =  auth()->user();
        $current_date = Carbon::now('Asia/Kolkata')->toDateString();
        $attendance = $model->fetch_where('tbl_attendance', 'user_id', $user->user_id, null, 'date', $current_date);
        // return $attendance;
        $ipInfo = file_get_contents('http://ip-api.com/json');
        $ipInfo = json_decode($ipInfo);
        $storedDateTime = Carbon::parse($attendance->time_login);
        $currentDateTime = Carbon::now()->addHours(5)->addMinutes(30);
        $timeDifference = $currentDateTime->diff($storedDateTime);
        $formatWorkedHours = $timeDifference->format('%h hours %i minutes');
        if ($attendance->task_id) {
            $dataArray = [
                'time_logout' => Carbon::now('Asia/Kolkata'),
                'worked_hours' => $formatWorkedHours,
                'remote_ip_out' => $ipInfo->query,
            ];
            $model->edit_data('tbl_attendance', 'attn_id', $attendance->attn_id, $dataArray);

            Auth::logout();
            return redirect('/admin/login');
        } else {
            return redirect()->back()->with('error', 'Please submit your report');
        }
    }

    public function attendance()
    {
        $model = new Common_model();
        $user =  auth()->user();
        $current_date = Carbon::now('Asia/Kolkata')->toDateString();
        $attendance = $model->fetch_where('tbl_attendance', 'user_id', $user->user_id, null, 'date', $current_date);
        $startTime = Carbon::createFromFormat('H:i', $user->duty_in_time);
        $endTime = Carbon::createFromFormat('H:i', $user->duty_out_time);
        $difference = $endTime->diff($startTime);
        $ipInfo = file_get_contents('http://ip-api.com/json');
        $ipInfo = json_decode($ipInfo);
        if (!$attendance) {
            Mail::to(env('MAIL_TO_ADDRESS'))->send(new LoginMail());
            Config::set('mail.from.name', 'DSA IT Backend');
            Mail::to(auth()->user()->personal_email)->send(new UserLoginMail());
            $dataArray = [
                'user_id' => auth()->user()->user_id,
                'date' => Carbon::now('Asia/Kolkata')->toDateString(),
                'reason' => 'Mark From System',
                'time_login' => Carbon::now('Asia/Kolkata'),
                'actual_hours' => $difference->h,
                'worked_hours' => '0 hours 0 minutes',

                'remote_ip_in' => $ipInfo->query,
            ];
            $model->insert_data('tbl_attendance', $dataArray);
        }
    }
}
