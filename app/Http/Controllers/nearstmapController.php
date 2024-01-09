<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Redis;


class nearstmapController extends Controller
{
    public function findNearst(Request $req)
    {
        
        $lat = '12.928075';
        $lon = '77.619922';
        
        $data = DB::table('additems')
            ->select(
                'additems.*', // Select all columns from the additems table
                DB::raw("ROUND(6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(additems.lat))
                    * cos(radians(additems.log) - radians(" . $lon . "))
                    + sin(radians(" . $lat . "))
                    * sin(radians(additems.lat))), 2) AS distance")
            )
            ->orderBy('distance', 'asc') 
            ->get();
        
        return view('map', compact('data'));
        
       
    }

   
    

}
