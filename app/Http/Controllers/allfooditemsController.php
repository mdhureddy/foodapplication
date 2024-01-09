<?php

namespace App\Http\Controllers;
use App\Models\additems;
use Illuminate\Http\Request;
use DB;
use GuzzleHttp\Client;

class allfooditemsController extends Controller
{
    public function veg_food()
    {
       
        $veg='veg';
        // $items = additems::where('items_name',$veg)->get();
        // return view('vegsection', compact('items'));
       
        $client = new Client();
        $response = $client->get('https://geolocation.poweradspy.com/');
        $data = json_decode($response->getBody(), true);
        $lat = $data['latitude'];
        $log = $data['longitude'];
        // $lat = '12.928075';
        // $log = '77.619922';
        
        $data = DB::table('additems')
            ->select(
                'additems.*',
                DB::raw("ROUND(6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(additems.lat))
                    * cos(radians(additems.log) - radians(" . $log . "))
                    + sin(radians(" . $lat . "))
                    * sin(radians(additems.lat))), 2) AS distance")
            )
            ->where('items_name', $veg)
            ->orderBy('distance', 'asc')
            ->get();
        
        return view("Allvegnonvegetcsection", ['items' => $data]);
    }
    public function nonveg_food()
    {
        // dd(123);
        $veg='nonveg';
        // $lat = '12.928075';
        // $log = '77.619922';
        $client = new Client();
        $response = $client->get('https://geolocation.poweradspy.com/');
        $data = json_decode($response->getBody(), true);
        $lat = $data['latitude'];
        $log = $data['longitude'];
        $data = DB::table('additems')
            ->select(
                'additems.*',
                DB::raw("ROUND(6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(additems.lat))
                    * cos(radians(additems.log) - radians(" . $log . "))
                    + sin(radians(" . $lat . "))
                    * sin(radians(additems.lat))), 2) AS distance")
            )
            ->where('items_name', $veg)
            ->orderBy('distance', 'asc')
            ->get();
        
        return view("Allvegnonvegetcsection", ['items' => $data]);
    }
    public function softdrink_food()
    {
        // dd(123);
        $veg='dessert';
        // $lat = '12.928075';
        // $log = '77.619922';
        $client = new Client();
        $response = $client->get('https://geolocation.poweradspy.com/');
        $data = json_decode($response->getBody(), true);
        $lat = $data['latitude'];
        $log = $data['longitude'];
        
        $data = DB::table('additems')
            ->select(
                'additems.*',
                DB::raw("ROUND(6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(additems.lat))
                    * cos(radians(additems.log) - radians(" . $log . "))
                    + sin(radians(" . $lat . "))
                    * sin(radians(additems.lat))), 2) AS distance")
            )
            ->where('items_name', $veg)
            ->orderBy('distance', 'asc')
            ->get();
        
        return view("Allvegnonvegetcsection", ['items' => $data]);
    }
    public function fast_food()
    {
        // dd(123);
        $veg='fastfood';
        // $lat = '12.928075';
        // $log = '77.619922';
        $client = new Client();
        $response = $client->get('https://geolocation.poweradspy.com/');
        $data = json_decode($response->getBody(), true);
        $lat = $data['latitude'];
        $log = $data['longitude'];
        
        $data = DB::table('additems')
            ->select(
                'additems.*',
                DB::raw("ROUND(6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(additems.lat))
                    * cos(radians(additems.log) - radians(" . $log . "))
                    + sin(radians(" . $lat . "))
                    * sin(radians(additems.lat))), 2) AS distance")
            )
            ->where('items_name', $veg)
            ->orderBy('distance', 'asc')
            ->get();
        
        return view("Allvegnonvegetcsection", ['items' => $data]);
    }
}
