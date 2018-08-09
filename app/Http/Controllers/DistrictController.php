<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\District;

class DistrictController extends Controller
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

    public function getDistrictByProvince($prov_id) {
        $district = District::query()->where("prov_id",$prov_id)->pluck("district_name_lo","id");
        return json_encode($district);
    }
}
