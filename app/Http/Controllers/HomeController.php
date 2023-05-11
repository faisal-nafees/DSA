<?php

namespace App\Http\Controllers;

use App\Models\Common_model;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $model = new Common_model();
        $enquiries = $model->fetch_data('tbl_enquiry');
        $contacts = $model->fetch_data('tbl_contacts');
        return view('admin.dashboard', compact(['enquiries', 'contacts']));
    }

    public function reporting()
    {
        return view('admin.reporting');
    }

    public function leaves()
    {
        return view('admin.leaves');
    }

    public function attendance()
    {
        return view('admin.attendance');
    }


    public function addLeave()
    {
        return view('admin.add-leave');
    }
}
