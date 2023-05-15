<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Common_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    public function manage(Request $request)
    {
        $model = new Common_model();
        if (request()->isMethod('post')) {
            $users = $model->search_data('tbl_users', null, $request->start_date, $request->end_date, null, null,  'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
            return view('admin.manage-user', compact(['users']));
        }
        $users = $model->fetch_data('tbl_users', 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
        return view('admin.manage-user', compact('users'));
    }

    public function add(Request $request)
    {
        $model = new Common_model();
        if (request()->isMethod('post')) {
            $request->validate(
                [
                    'company_webmail'     => 'unique:tbl_users',
                    'contact'     => 'unique:tbl_users',
                    'pan_no'     => 'unique:tbl_users',
                    'adhar_no'     => 'unique:tbl_users',
                ],
            );
            $dataArray = $request->all();
            $username = $request->input('firstname') . '_' . $request->input('lastname');
            if ($request->hasFile('adhar_pic')) {
                $adhaarImage = $request->file('adhar_pic');
                $adhaarImagePath = $this->fileSave($adhaarImage, $username, 'adhar_pic');
                $dataArray['adhar_pic'] = $adhaarImagePath;
            }
            if ($request->hasFile('pan_pic')) {
                $pancardImage = $request->file('pan_pic');
                $pancardImagePath = $this->fileSave($pancardImage, $username, 'pan_pic');
                $dataArray['pan_pic'] = $pancardImagePath;
            }
            if ($request->hasFile('passbook_pic')) {
                $passbookImage = $request->file('passbook_pic');
                $passbookImagePath = $this->fileSave($passbookImage, $username, 'passbook_pic');
                $dataArray['passbook_pic'] = $passbookImagePath;
            }
            if ($request->hasFile('passport_pic')) {
                $passportImage = $request->file('passport_pic');
                $passportImagePath = $this->fileSave($passportImage, $username, 'passport_pic');
                $dataArray['passport_pic'] = $passportImagePath;
            }
            if ($request->hasFile('address_proof_pic')) {
                $addressProofImage = $request->file('address_proof_pic');
                $addressProofImagePath = $this->fileSave($addressProofImage, $username, 'address_proof_pic');
                $dataArray['address_proof_pic'] = $addressProofImagePath;
            }
            if ($request->hasFile('experience_letter_pic')) {
                $experienceLetterImage = $request->file('experience_letter_pic');
                $experienceLetterImagePath = $this->fileSave($experienceLetterImage, $username, 'experience_letter_pic');
                $dataArray['experience_letter_pic'] = $experienceLetterImagePath;
            }
            if ($request->hasFile('educational_certificate_pic')) {
                $educationalCertificateImage = $request->file('educational_certificate_pic');
                $educationalCertificateImagePath = $this->fileSave($educationalCertificateImage, $username, 'educational_certificate_pic');
                $dataArray['educational_certificate_pic'] = $educationalCertificateImagePath;
            }

            $dataArray['password'] = Hash::make($request->input('password'));
            if ($model->insert_data('tbl_users', $dataArray)) {
                return redirect('/manage-user')->with('success', 'User added successfully');
            } else {
                return redirect('/manage-user')->with('error', 'Error while adding user');
            }
        } else {
            $roles = $model->fetch_data('tbl_roles');
            return view('admin.add-user', compact('roles'));
        }
    }

    public function edit(Request $request, $id)
    {
        $model = new Common_model();
        if (request()->isMethod('post')) {
            $request->validate(
                [
                    'email'     => 'unique:tbl_users,email,' . $id . ',user_id',
                    'contact'   => 'unique:tbl_users,contact,' . $id . ',user_id',
                    'pan_no'    => 'unique:tbl_users,pan_no,' . $id . ',user_id',
                    'adhar_no'  => 'unique:tbl_users,adhar_no,' . $id . ',user_id',
                ],
            );
            $user = $model->fetch_where('tbl_users', 'user_id', $id);
            $username = $user->firstname . '_' . $user->lastname;
            $dataArray = $request->all();
            // return $dataArray;

            // Get the user ID and previous image path

            if ($request->hasFile('adhar_pic')) {
                $adharImage = $request->file('adhar_pic');
                $oldImage = $user->adhar_pic;
                if ($oldImage) {
                    // Delete the previous image
                    Storage::disk('public')->delete('/' . $oldImage);
                }
                $adharImagePath = $this->fileSave($adharImage, $username, 'adhar_pic');
                $dataArray['adhar_pic'] = $adharImagePath;
            }
            if ($request->hasFile('pan_pic')) {
                $pancardImage = $request->file('pan_pic');
                $oldImage = $user->pan_pic;
                if ($oldImage) {
                    // Delete the previous image
                    Storage::disk('public')->delete('/' . $oldImage);
                }
                $pancardImagePath = $this->fileSave($pancardImage, $username, 'pan_pic');
                $dataArray['pan_pic'] = $pancardImagePath;
            }
            if ($request->hasFile('passbook_pic')) {
                $passbookImage = $request->file('passbook_pic');
                $oldImage = $user->passbook_pic;
                if ($oldImage) {
                    // Delete the previous image
                    Storage::disk('public')->delete('/' . $oldImage);
                }
                $passbookImagePath = $this->fileSave($passbookImage, $username, 'passbook_pic');
                $dataArray['passbook_pic'] = $passbookImagePath;
            }
            if ($request->hasFile('passport_pic')) {
                $passportImage = $request->file('passport_pic');
                $oldImage = $user->passport_pic;
                if ($oldImage) {
                    // Delete the previous image
                    Storage::disk('public')->delete('/' . $oldImage);
                }
                $passportImagePath = $this->fileSave($passportImage, $username, 'passport_pic');
                $dataArray['passport_pic'] = $passportImagePath;
            }
            if ($request->hasFile('address_proof_pic')) {
                $addressProofImage = $request->file('address_proof_pic');
                $oldImage = $user->address_proof_pic;
                if ($oldImage) {
                    // Delete the previous image
                    Storage::disk('public')->delete('/' . $oldImage);
                }
                $addressProofImagePath = $this->fileSave($addressProofImage, $username, 'address_proof_pic');
                $dataArray['address_proof_pic'] = $addressProofImagePath;
            }
            if ($request->hasFile('experience_letter_pic')) {
                $experienceLetterImage = $request->file('experience_letter_pic');
                $oldImage = $user->experience_letter_pic;
                if ($oldImage) {
                    // Delete the previous image
                    Storage::disk('public')->delete('/' . $oldImage);
                }
                $experienceLetterImagePath = $this->fileSave($experienceLetterImage, $username, 'experience_letter_pic');
                $dataArray['experience_letter_pic'] = $experienceLetterImagePath;
            }
            if ($request->hasFile('educational_certificate_pic')) {
                $educationalCertificateImage = $request->file('educational_certificate_pic');
                $oldImage = $user->educational_certificate_pic;
                if ($oldImage) {
                    // Delete the previous image
                    Storage::disk('public')->delete('/' . $oldImage);
                }
                $educationalCertificateImagePath = $this->fileSave($educationalCertificateImage, $username, 'educational_certificate_pic');
                $dataArray['educational_certificate_pic'] = $educationalCertificateImagePath;
            }

            if ($model->edit_data('tbl_users', 'user_id', $id, $dataArray)) {
                return redirect('/manage-user')->with('success', 'User updated successfully');
            } else {
                return redirect('/manage-user')->with('error', 'Error while updating user');
            }
        } else {
            $user = $model->fetch_where('tbl_users', 'user_id', $id, 'tbl_roles', 'tbl_users.role_id', 'tbl_roles.role_id');
            return view('admin.edit-user', compact(['user', 'roles']));
        }
    }

    public function delete($id)
    {
        $model = new Common_model();
        if ($model->delete_data('tbl_users', 'user_id', $id)) {
            return redirect('/manage-user')->with('message', 'User deleted successfully');
        }
    }

    public function dashboard()
    {
        $model = new Common_model();
        $enquiryCount = $model->check_where('tbl_enquiry', 'created_at');
        $contactCount = $model->check_where('tbl_contacts', 'created_at');
        $userCount = $model->check_where('tbl_users');
        return view('admin.dashboard', compact(['enquiryCount', 'contactCount', 'userCount']));
    }

    public function editProfile(Request $request)
    {
        $user = Auth::user();
        $model = new Common_model();
        if (request()->isMethod('post')) {
            $dataArray = $request->all();
            if ($model->edit_data('tbl_users', 'user_id', $user->user_id, $dataArray)) {
                return back()->with('success', 'Profile updated successfully');
            } else {
                return back()->with('error', 'Error while updating profile');
            }
        } else {
            return view('admin.edit-profile', compact(['user']));
        }
    }

    public function fileSave($file, $username, $filename)
    {
        $image = $file;
        $extension          = $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('documents/' . $username, $filename . '.' . $extension, 'public');
        return $imagePath;
    }
}
