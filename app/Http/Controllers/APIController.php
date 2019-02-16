<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Indonesia;

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
}
