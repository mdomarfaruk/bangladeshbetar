<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Branch_info;
use Datatables;
use Validator;
use PDF;
use Session;

class StateController extends Controller
{
    //Sirajul Islam
    public function immovable_property(){
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('asset.immovable_property.immovable_property_info',['station_info'=>$station_info]);
    }
    public function building_record(){
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('asset.building.building_record',['station_info'=>$station_info]);
    }
    public function maintance_building(){
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('asset.building.maintance_building',['station_info'=>$station_info]);
    }public function report_land_info(){
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('asset.report.report_land_info',['station_info'=>$station_info]);
    }
    public function report_building(){
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('asset.report.report_building',['station_info'=>$station_info]);
    }
    public function report_maintance_building(){
        $station_info = Branch_info::branch_info_select(['is_active'=>1]);
        return view('asset.report.report_maintance_building',['station_info'=>$station_info]);
    }










}
