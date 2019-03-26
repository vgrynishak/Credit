<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Credit extends Model
{
    public static function get_data($orders=Null, $limits=Null, $offsets=Null){
        $order = $orders?"Order By $orders":"";
        $limit = $limits?"Limit $limits":"";
        $offset = $offsets?"OFFSET $offsets":"";
        return DB::select("SELECT title, `type`, bank, uah, min_time, max_time FROM results $order $limit $offset");
    }

    public static function get_data_pereplate($suma, $sroc, $orders =Null, $limits=Null, $offsets=Null){
        $order = $orders?"Order By $orders":"";
        $limit = $limits?"Limit $limits":"";
        $offset = $offsets?"OFFSET $offsets":"";
        return DB::select("SELECT title, `type`, bank, uah, min_time, max_time, ($suma/100*uah*$sroc) as pereplata FROM results $order $limit $offset");
    }


}
