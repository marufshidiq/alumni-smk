<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Indonesia;
use App\SocialMediaList;
use App\ClassList;

class APIController extends Controller
{
    public function addressDetail(Request $request)
    {
        if($request->type == "city"){
            $cities = \Indonesia::findProvince($request->id, ['cities']);
            return $cities;
        }
        else if($request->type == "district"){
            $district = \Indonesia::findCity($request->id, ['districts']);
            return $district;
        }
        return "Oke";
    }

    public function mediaDetail(Request $request)
    {
        $sm = SocialMediaList::find($request->id);
        return $sm;
    }

    public function classMembersDetail(Request $request)
    {
        $class = ClassList::find($request->id);
        $return['details'] = [
            'name' => $class->majorInfo['short_name']." - ".$class['name'],
            "year" => $class->yearInfo['year']
        ];
        $members = array();
        foreach($class->members as $member){
            // $join = $member->userDetails->created_at->timestamp;
            $detail = [
                "name" => $member->userDetails['name'],
                "join" => $member->userDetails->created_at->format('d M Y')
            ];
            array_push($members, $detail);
        }
        $return['members'] = $members;
        // return $class->members;
        return $return;
    }
}
