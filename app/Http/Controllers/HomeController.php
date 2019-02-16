<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Laravolt\Indonesia\Indonesia;

use App\Address;
use App\Email;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function profile()
    {
        return view('profile');
    }

    public function profileEdit()
    {
        return view('editprofile');
    }

    public function first()
    {
        $email = Email::where('email', Auth::user()->email)->count();
        if($email == 0){
            $user = Auth::user();
            $user->emails()->create([
                'email' => Auth::user()->email
            ]);
        }
        return redirect()->route('dashboard');
    }

    public function profileEditProcess(Request $request)
    {
        $parameter = $request->parameter;
        if($parameter == "name"){
            $user = Auth::user();
            $user->update([
                "name" => $request->name
            ]);
            return redirect()->back();
        }
        return $request;
    }

    public function addressAddEdit(Request $request)
    {
        $act = $request->act;
        if($act == "add"){
            $detail['header'] = "Tambah alamat";
            $detail['id'] = 0;
        }
        else {
            $detail['header'] = "Ubah alamat";
            $id = $request->id;
            $detail['id'] = $id;
            $address = Address::find($id);
            if($address['user_id'] != Auth::user()->id){
                return;
            }
            $detail['address'] = $address['address'];
            $detail['province'] = $address['province'];
            $detail['city'] = $address['city'];
            $detail['district'] = $address['district'];

            $cities = \Indonesia::findProvince($address['province'], ['cities']);
            $detail['city-list'] = $cities['cities'];
            
            $district = \Indonesia::findCity($address['city'], ['districts']);
            $detail['district-list'] = $cities['districts'];
        }
        $province = \Indonesia::allProvinces();
        $detail['act'] = $act;
        return view('addeditaddress', compact('detail', 'province'));        
    }

    public function addressSave(Request $request)
    {
        $user = Auth::user();
        if($request->act == "add"){
            $user->addresses()->create([
                'address' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'district' => $request->district
            ]);
        }
        else if($request->act == "edit"){
            $address = Address::find($request->id);
            if($address['user_id'] != Auth::user()->id){
                return;
            }
            $address->update([
                'address' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'district' => $request->district
            ]);
        }
        return redirect()->route('profile.edit');
    }

    public function emailSave(Request $request)
    {
        $user = Auth::user();
        if($request->act == "add"){
            $user->emails()->create([
                'email' => $request->email
            ]);
        }
        return redirect()->route('profile.edit');
    }

    public function profilePrivacy($type, $id)
    {
        if($type == "address"){
            $address = Address::find($id);
            if($address['user_id'] != Auth::user()->id){
                return "Error";
            }

            if($address['privacy'] == "public"){
                $privacy = "private";
            }
            else if($address['privacy'] == "private"){
                $privacy = "public";
            }            

            $address->update([
                "privacy" => $privacy
            ]);
            return redirect()->route('profile.edit');
        }
        if($type == "email"){
            $email = Email::find($id);
            if($email['user_id'] != Auth::user()->id){
                return "Error";
            }

            if($email['privacy'] == "public"){
                $privacy = "private";
            }
            else if($email['privacy'] == "private"){
                $privacy = "public";
            }            

            $email->update([
                "privacy" => $privacy
            ]);
            return redirect()->route('profile.edit');
        }
    }

    public function profileDelete($type, $id)
    {
        if($type == "address"){
            $address = Address::find($id);
            if($address['user_id'] != Auth::user()->id){
                return "Error";
            }
            $address->delete();
            return redirect()->route('profile.edit');
        }
        if($type == "email"){
            $email = Email::find($id);
            if($email['user_id'] != Auth::user()->id){
                return "Error";
            }
            $email->delete();
            return redirect()->route('profile.edit');
        }
    }
}
