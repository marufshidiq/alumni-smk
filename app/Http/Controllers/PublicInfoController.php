<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SchoolList;
use App\IndustryList;

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
}
