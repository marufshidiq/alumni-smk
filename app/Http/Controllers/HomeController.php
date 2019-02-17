<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Laravolt\Indonesia\Indonesia;

use App\Address;
use App\Email;
use App\ContactNumber;
use App\SocialMedia;
use App\User;

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
        return redirect()->route('show.profile', ['slug' => Auth::user()->slug]);
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
                'email' => Auth::user()->email,
                'privacy' => "private"
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

    public function contactSave(Request $request)
    {
        $user = Auth::user();
        if($request->act == "add"){
            $user->contactNumbers()->create([
                'number' => $request->number
            ]);
        }
        return redirect()->route('profile.edit');
    }

    public function socialMediaSave(Request $request)
    {
        $user = Auth::user();
        if($request->act == "add"){
            $user->socialMedia()->create([
                'media' => $request->media,
                'username' => $request->username
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
        if($type == "contact"){
            $contact = ContactNumber::find($id);
            if($contact['user_id'] != Auth::user()->id){
                return "Error";
            }

            if($contact['privacy'] == "public"){
                $privacy = "private";
            }
            else if($contact['privacy'] == "private"){
                $privacy = "public";
            }            

            $contact->update([
                "privacy" => $privacy
            ]);
            return redirect()->route('profile.edit');
        }
        if($type == "whatsapp"){
            $contact = ContactNumber::find($id);
            if($contact['user_id'] != Auth::user()->id){
                return "Error";
            }

            if($contact['whatsapp'] == 1){
                $whatsapp = 0;
            }
            else if($contact['whatsapp'] == 0){
                $whatsapp = 1;
            }            

            $contact->update([
                "whatsapp" => $whatsapp
            ]);
            return redirect()->route('profile.edit');
        }
        if($type == "socialmedia"){
            $sm = SocialMedia::find($id);
            if($sm['user_id'] != Auth::user()->id){
                return "Error";
            }

            if($sm['privacy'] == "public"){
                $privacy = "private";
            }
            else if($sm['privacy'] == "private"){
                $privacy = "public";
            }            

            $sm->update([
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
        if($type == "contact"){
            $contact = ContactNumber::find($id);
            if($contact['user_id'] != Auth::user()->id){
                return "Error";
            }
            $contact->delete();
            return redirect()->route('profile.edit');
        }
        if($type == "socialmedia"){
            $sm = SocialMedia::find($id);
            if($sm['user_id'] != Auth::user()->id){
                return "Error";
            }
            $sm->delete();
            return redirect()->route('profile.edit');
        }
    }

    public function showProfile($slug)
    {
        $user = User::where('slug', $slug);
        if($user->count() != 1){
            return redirect()->route('dashboard');
        }

        $user = $user->first();

        $profile["name"] = $user['name'];

        $emailArray = array();
        foreach($user->emails as $obj){
            if($obj['privacy'] == "private"){
                $email = array(
                    'privacy' => "private",
                    'email' => $this->hideProfile("email", $obj['email'])
                );
            }
            else {
                $email = array(
                    'privacy' => "public",
                    'email' => $obj['email']
                );
            }
            array_push($emailArray, $email);
        }
        $profile["email"] = $emailArray;

        $phoneArray = array();
        foreach($user->contactNumbers as $obj){
            if($obj['privacy'] == "private"){
                $phone = array(
                    'privacy' => "private",
                    'whatsapp' => $obj['whatsapp'],
                    'phone' => $this->hideProfile("phone", $obj['number'])
                );
            }
            else {
                $phone = array(
                    'privacy' => "public",
                    'whatsapp' => $obj['whatsapp'],
                    'phone' => $obj['number']
                );
            }
            array_push($phoneArray, $phone);
        }
        $profile["phone"] = $phoneArray;

        $addressArray = array();
        foreach($user->addresses as $obj){
            if($obj['privacy'] == "private"){
                $address = array(
                    'privacy' => "private",
                    'address1' => $this->convertToAsterisk($obj['address'], 5),
                    'address2' => ""
                );
            }
            else {
                $address = array(
                    'privacy' => "public",
                    'address1' => $obj['address'],
                    'address2' => $obj->districtDetails['name'].", ".$obj->cityDetails['name'].", ".$obj->provinceDetails['name']
                );
            }
            array_push($addressArray, $address);
        }
        $profile["address"] = $addressArray;

        $socialMediaArray = array();
        foreach($user->socialMedia as $obj){
            if($obj['privacy'] == "private"){
                $socialmedia = array(
                    'privacy' => "private",
                    'username' => "***",
                    'link' => "#"
                );
            }
            else {
                $socialmedia = array(
                    'privacy' => "public",
                    'username' => $obj['username'],
                    'link' => $obj->link()
                );
            }
            $socialmedia['icon'] = $obj->details['icon'];

            array_push($socialMediaArray, $socialmedia);
        }
        $profile["socialmedia"] = $socialMediaArray;

        return view('profile', compact('profile'));
    }

    public function hideProfile($type, $content)
    {
        if($type == "email"){
            $part = explode("@", $content);
            $email = $this->convertToAsterisk($part[0], 3);
            $email .= "@";            
            $email .= $this->convertToAsterisk($part[1], 1, 3);
            return $email;
        }
        if($type == "phone"){
            return $this->convertToAsterisk($content, 3);
        }

        return $content;
    }

    public function convertToAsterisk($content, $prefix = 0, $suffix = 0)
    {
        $length = strlen($content);
        $asterisk = "";
        for($i=0;$i<=$length-$prefix-$suffix;$i++){
            $asterisk .= "*";
        }
        $return = "";        
        $return .= substr($content, 0, $prefix);
        $return .= $asterisk;
        $return .= substr($content, -1*$suffix, $suffix);

        return $return;
    }
}
