<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Credit;

class IndexController extends Controller
{
    public function get_data(Request $request){
        $order =  $request['order'];
        $limit = (int)$request['limit'];
        $ofset = (int)$request['ofset'];
        $suma = (double)$request['suma'];
        $sroc = (double)$request['sroc'];
        if ($sroc && $suma){
            if ($order && $order != 'pereplata' && $order !='title' && $order !='bank' && $order !='uah' && $order != 'min_time' && $order != 'max_time')
                return "Такого поля немає";
            return Credit::get_data_pereplate($suma, $sroc, $order,$limit,$ofset);
        }
        else{
            if ($order  && $order !='title' && $order !='bank' && $order !='uah' && $order != 'min_time' && $order != 'max_time')
                return "Такого поля немає";
            return Credit::get_data($order,$limit,$ofset);
        }

    }
}
