<?php

namespace App\Http\Controllers;

use App\Models\Common_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnquiryController extends Controller
{

    public function manage(Request $request)
    {
        $model = new Common_model();
        $enq_type = $model->fetch_data('tbl_type');
        if (request()->isMethod('post')) {
            $enquiries = $model->search_data('tbl_enquiry', 'enq_type', $request->start_date, $request->end_date, $request->enqtype_id, 'tbl_lead_status', 'tbl_enquiry.status_id', 'tbl_lead_status.status_id', 'tbl_type', 'tbl_enquiry.enq_type', 'tbl_type.enqtype_id');
            return view('admin.manage-enquiry', compact(['enquiries', 'enq_type']));
        }
        $enquiries = $model->fetch_data('tbl_enquiry', 'tbl_lead_status', 'tbl_enquiry.status_id', 'tbl_lead_status.status_id', 'tbl_type', 'tbl_enquiry.enq_type', 'tbl_type.enqtype_id');
        return view('admin.manage-enquiry', compact(['enquiries', 'enq_type']));
    }

    public function add(Request $request)
    {
        $model = new Common_model();
        if (request()->isMethod('post')) {
            $dataArray = $request->all();
            if ($model->insert_data('tbl_enquiry', $dataArray)) {
                return redirect('/manage-enquiries')->with('success', 'Enquiry added successfully');
            } else {
                return redirect('/manage-enquiries')->with('error', 'Error while adding enquiry');
            }
        } else {
            $enq_type = $model->fetch_data('tbl_type');
            $sources = $model->fetch_data('tbl_source');
            return view('admin.add-enquiry', compact(['enq_type', 'sources']));
        }
    }

    public function edit(Request $request, $id)
    {
        $model = new Common_model();

        if (request()->isMethod('post')) {
            // return $request;
            $dataArray = $request->all();

            if ($model->edit_data('tbl_enquiry', 'enq_id', $id, $dataArray)) {
                return redirect('/manage-enquiries')->with('success', 'Enquiry updated successfully');
            } else {
                return redirect('/manage-enquiries')->with('error', 'Error while updating enquiry');
            }
        } else {
            $enquiry = $model->fetch_where('tbl_enquiry', 'enq_id', $id, 'tbl_lead_status', 'tbl_enquiry.status_id', 'tbl_lead_status.status_id');
            $enq_type = $model->fetch_data('tbl_type');
            $sources = $model->fetch_data('tbl_source');
            $status = $model->fetch_data('tbl_lead_status');
            return view('admin.edit-enquiry', compact(['enquiry', 'enq_type', 'sources', 'status']));
        }
    }

    public function delete($id)
    {
        $model = new Common_model();
        if ($model->delete_data('tbl_enquiry', 'enq_id', $id)) {
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
