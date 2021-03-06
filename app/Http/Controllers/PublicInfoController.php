<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\SchoolList;
use App\IndustryList;
use App\MajorList;
use App\EducationYearList;
use App\ClassList;

class PublicInfoController extends Controller
{
    public function institutionAddView()
    {
        return view('addinstitution');
    }

    public function institutionAdd(Request $request)
    {
        $sl = new SchoolList;
        $sl->name = $request->name;
        $sl->url = $request->url;
        $sl->save();

        return redirect()->route('profile');
    }
    
    public function industryAddView()
    {
        return view('addindustry');
    }

    public function industryAdd(Request $request)
    {
        $sl = new IndustryList;
        $sl->name = $request->name;
        $sl->url = $request->url;
        $sl->save();

        return redirect()->route('profile');
    }

    public function classList(Request $request)
    {
        if(Auth::user()->class()->count() == 1){
            return redirect()->route('profile');
        }
        if($request->act == "first"){
            $info['year'] = EducationYearList::get()->sortBy('year')->first()['id'];
            $info['major'] = MajorList::get()->sortBy('name')->first()['id'];
            $info['status'] = "fisrt";
            return view('listclass', compact('info'));
        }
        $year = $request->year;
        $major = $request->major;
        $info['year'] = $year;
        $info['major'] = $major;
        $info['status'] = "not";
        $classList = ClassList::where('year_id', $year)->where('major_id', $major)->get();
        return view('listclass', compact('info', 'classList'));
    }

    public function majorAddView()
    {
        return view('addmajor');
    }

    public function majorAdd(Request $request)
    {
        $full_name = ucwords($request->full_name);
        $full_name = str_replace("Dan", "dan", $full_name);

        $major = new MajorList;
        $major->current_major_id = $request->current_major;
        $major->name = $full_name;
        $major->short_name = strtoupper($request->short_name);
        $major->save();
        return redirect()->route('profile.edit');
    }

    public function classAddView()
    {
        return view('addclass');
    }

    public function classAdd(Request $request)
    {
        $class = new ClassList;
        $class->year_id = $request->year;
        $class->major_id = $request->major;
        $class->name = $request->class;
        $class->alias = $request->alias;
        $class->creator_id = Auth::user()->id;
        $class->save();

        return redirect()->route('profile.edit');
    }

    public function testiAddView()
    {
        return view('addtestimonial');
    }

    public function testiAdd(Request $request)
    {
        $user = Auth::user();
        if($request->act == "add"){
            $user->testimonial()->create([
                'message' => $request->message
            ]);
        }
        elseif($request->act == "edit") {
            $user->testimonial()->update([
                'message' => $request->message
            ]);
        }
        elseif($request->act == "delete") {
            $user->testimonial()->delete();
        }
        return redirect()->route('add.testi.get');
    }
}
