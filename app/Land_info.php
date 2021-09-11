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
}
