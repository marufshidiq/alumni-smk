<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use Laravolt\Indonesia\Indonesia;
use Illuminate\Support\Carbon;

use App\Address;
use App\Email;
use App\ContactNumber;
use App\SocialMedia;
use App\User;
use App\ProfileRequest;
use App\ClassMember;
use App\MajorList;
use App\ClassList;

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
        $user = Auth::user();

        $checklist['avatar'] = false;
        $checklist['email'] = false;
        $checklist['phone'] = false;
        $checklist['class'] = false;
        $checklist['social'] = false;

        if($user['photo']!="user.png"){
            $checklist['avatar'] = true;
        }
        if($user->emails->count() > 0){
            $checklist['email'] = true;
        }
        if($user->contactNumbers->count() > 0){
            $checklist['phone'] = true;
        }
        if($user->class()->exists() > 0){
            $checklist['class'] = true;
        }
        if($user->socialMedia->count() > 0){
            $checklist['social'] = true;
        }

        if(!file_exists(public_path("main/js/morrisjs/smkn1klaten.js"))){
            $this->generateMorrisJS();
        }
        $ts = filemtime(public_path("main/js/morrisjs/smkn1klaten.js"));
        $last = Carbon::createFromTimestamp($ts);        
        $diff = Carbon::now()->diffInMinutes($last);
        if($diff > 59){
            $this->generateMorrisJS();
        }

        return view('dashboard', compact('checklist'));
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

    public function schoolSave(Request $request)
    {
        $user = Auth::user();
        if($request->act == "add"){
            $user->schools()->create([
                'school_id' => $request->school,
                'grade' => $request->grade,
                'major' => $request->major,
                'start' => $request->start,
                'end' => $request->end,
            ]);
        }
        return redirect()->route('profile');
    }

    public function industrySave(Request $request)
    {
        $user = Auth::user();
        if($request->act == "add"){
            $user->industries()->create([
                'industry_id' => $request->industry,
                'position' => $request->position,
                'division' => $request->division,
                'start' => $request->start,
                'end' => $request->end,
            ]);
        }
        return redirect()->route('profile');
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
        if($type == "class"){
            $user = Auth::user();
            $exist = ClassMember::where('user_id', $user->id)->count();
            if($exist > 0){
                return redirect()->route('profile.edit');
            }
            $user->class()->create([
                'class_id' => $id
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

    public function profileRequest($user, $type, $id)
    {
        if($user == Auth::user()->id){
            return redirect()->route('profile');
        }

        $typeAllow = false;
        
        switch($type){
            case 'email':
            case 'phone':
            case 'address':
            case 'social':
                $typeAllow = true;
                break;
        }
        
        if(!$typeAllow){
            return redirect()->route('profile');
        }
        
        if(User::where('id', $user)->count()!=1){
            return redirect()->route('profile');
        }

        $pr = ProfileRequest::firstOrCreate([
            'type' => $type,
            'media_id' => $id,
            'user_id' => $user,
            'foreign_id' => Auth::user()->id
        ], ['allow' => 0]);
        return redirect()->back();
    }

    public function showProfile($slug)
    {
        $user = User::where('slug', $slug);
        if($user->count() != 1){
            return redirect()->route('dashboard');
        }

        $user = $user->first();

        $schoolList = $user->schools->sortBy('start');
        $industryList = $user->industries->sortBy('start');

        $profile["name"] = $user['name'];
        $profile["photo"] = $user['photo'];
        $profile["id"] = $user['id'];
        if($user->class()->count() == 1){
            $profile["class"] = $user->class->classDetails->majorInfo['short_name'] ."-". $user->class->classDetails['name'];
            $profile["year"] = $user->class->classDetails->yearInfo['year'];
        }
        else {
            $profile["class"] = "";
            $profile["year"] = "";
        }

        $ownProfile = false;
        if($user['id'] == Auth::user()->id){
            $ownProfile = true;
        }

        $prRaw = ProfileRequest::where('user_id', $user['id'])->where('foreign_id', Auth::user()->id)->get();
        $prArray = array();
        $prArray['email'] = array();
        $prArray['phone'] = array();
        $prArray['address'] = array();
        $prArray['social'] = array();
        foreach($prRaw as $pr){
            array_push($prArray[$pr['type']], $pr);
        }        

        $emailArray = array();
        foreach($user->emails as $obj){
            $prStatus = "private";
            $allowProfile = false;
            if($ownProfile){
                $allowProfile = true;
            }
            else {
                foreach($prArray['email'] as $pr){
                    if($obj['id'] == $pr['media_id']){
                        if($pr['allow'] == 0){
                            $allowProfile = false;
                            $prStatus = "request";
                        }
                        else{
                            $allowProfile = true;
                        }
                    }
                }
            }
            if(($obj['privacy'] == "private") && ($allowProfile!=true)){
                $email = array(
                    'privacy' => $prStatus,
                    'email' => $this->hideProfile("email", $obj['email'])
                );
            }
            else {
                $email = array(
                    'privacy' => "public",
                    'email' => $obj['email']
                );
            }
            $email['id'] = $obj['id'];
            array_push($emailArray, $email);
        }
        $profile["email"] = $emailArray;

        $phoneArray = array();
        foreach($user->contactNumbers as $obj){
            $prStatus = "private";
            $allowProfile = false;
            if($ownProfile){
                $allowProfile = true;
            }
            else {
                foreach($prArray['phone'] as $pr){
                    if($obj['id'] == $pr['media_id']){
                        if($pr['allow'] == 0){
                            $allowProfile = false;
                            $prStatus = "request";
                        }
                        else{
                            $allowProfile = true;
                        }
                    }
                }
            }
            if(($obj['privacy'] == "private") && ($allowProfile!=true)){
                $phone = array(
                    'privacy' => $prStatus,
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
            $phone['id'] = $obj['id'];
            array_push($phoneArray, $phone);
        }
        $profile["phone"] = $phoneArray;

        $addressArray = array();
        foreach($user->addresses as $obj){
            $prStatus = "private";
            $allowProfile = false;
            if($ownProfile){
                $allowProfile = true;
            }
            else {
                foreach($prArray['address'] as $pr){
                    if($obj['id'] == $pr['media_id']){
                        if($pr['allow'] == 0){
                            $allowProfile = false;
                            $prStatus = "request";
                        }
                        else{
                            $allowProfile = true;
                        }
                    }
                }
            }
            if(($obj['privacy'] == "private") && ($allowProfile!=true)){
                $address = array(
                    'privacy' => $prStatus,
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
            $address['id'] = $obj['id'];
            array_push($addressArray, $address);
        }
        $profile["address"] = $addressArray;

        $socialMediaArray = array();
        foreach($user->socialMedia as $obj){
            $prStatus = "private";
            $allowProfile = false;
            if($ownProfile){
                $allowProfile = true;
            }
            else {
                foreach($prArray['social'] as $pr){
                    if($obj['id'] == $pr['media_id']){
                        if($pr['allow'] == 0){
                            $allowProfile = false;
                            $prStatus = "request";
                        }
                        else{
                            $allowProfile = true;
                        }
                    }
                }
            }
            if(($obj['privacy'] == "private") && ($allowProfile!=true)){
                $socialmedia = array(
                    'privacy' => $prStatus,
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
            $socialmedia['id'] = $obj['id'];
            array_push($socialMediaArray, $socialmedia);
        }
        $profile["socialmedia"] = $socialMediaArray;

        return view('profile', compact('profile', 'schoolList', 'industryList', 'ownProfile'));
    }

    public function hideProfile($type, $content)
    {
        if($type == "email"){
            $part = explode("@", $content);
            $pre = 3;
            if(strlen($part[0]) <= 4){
                $pre = 1;
            }
            $email = $this->convertToAsterisk($part[0], 1);
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
        for($i=0;$i<$length-$prefix-$suffix;$i++){
            $asterisk .= "*";
        }
        $return = "";        
        $return .= substr($content, 0, $prefix);
        $return .= $asterisk;
        $return .= substr($content, -1*$suffix, $suffix);

        return $return;
    }

    public function generateMorrisJS()
    {                
        $template = file_get_contents(public_path("main/js/morrisjs/morris-template.js"));
        $colorList = config('morris.color');
        $data = array();
        $major = array();
        $color = array();
        $i = 0;
        foreach(MajorList::all() as $m){
            array_push($major, $m['short_name']);
            array_push($color, $colorList[$i++]);
        }

        foreach(ClassList::select('year_id')->groupBy('year_id')->get() as $class){            
            $a = array('period' => $class->yearInfo['year']);
            foreach(MajorList::all() as $m){
                $classAtMajor = ClassList::where('year_id', $class['year_id'])->where('major_id', $m['id'])->get();
                $alumni = 0;
                foreach($classAtMajor as $c){
                    $alumni += $c->countMember();                    
                }
                $a = array_merge($a, array($m['short_name'] => $alumni));
            }
            array_push($data, $a);
        }
        
        $template = str_replace("%major", json_encode($major, true), $template);
        $template = str_replace("%color", json_encode($color, true), $template);
        $template = str_replace("%data", json_encode($data, true), $template);
        file_put_contents(public_path("main/js/morrisjs/smkn1klaten.js"), $template);
        return "Oke";
    }

    public function avatarEdit()
    {
        return view('uploadavatar');
    }

    function avatarUpload(Request $request)
    {
        $this->validate($request, [
            'avatar'  => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $image = $request->file('avatar');
        $user = Auth::user();
        $id = $user->id;
        $image_name = $id."-profile.".$image->getClientOriginalExtension();
        $image->move(public_path('avatar/temp'), $image_name);
        $temp_location = public_path('avatar/temp')."/".$image_name;        
        $image = Image::make($temp_location);
        $width = $image->width();
        $height = $image->height();
        $max = 500;
        if($width>=$height){
            $max = $height;
        }
        else {
            $max = $width;
        }
        $image->fit($max);
        $image->save(public_path('avatar')."/".$image_name);
        unlink($temp_location);
        $user->update([
            'photo' => $image_name
        ]);

        return redirect()->back();        
    }
}
