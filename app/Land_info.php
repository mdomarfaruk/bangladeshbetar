<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Land_info extends Model
{
    public static function get_land_info($receive = null)
    {
        $query =  DB::table('land_infos');
        $query->where($receive);
        return $query->select('land_infos.*')->first();
    }

    public static function get_search_land_info($receive = null){

        $get_land_info =  DB::table('land_infos')
                        ->leftJoin('all_sttings', 'all_sttings.id', '=', 'land_infos.area')
                        ->leftJoin('branch_infos', 'branch_infos.id', '=', 'land_infos.station_id');  

                        if(!empty($receive['station_id'])) {
                            $get_land_info->where('station_id',$receive['station_id']);
                        }
                        if(!empty($receive['area'])) {
                            $get_land_info->where('area',$receive['area']);
                        }
                        
        $get_land_info->orderBy('land_infos.id','DESC');
        return $get_land_info->select("land_infos.*","land_infos.location as location_name", "all_sttings.title as area_name", "branch_infos.name as station_name")->get();

    }
}
