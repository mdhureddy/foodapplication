<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\additems;
use DB;
use GuzzleHttp\Client;

class userDataController extends Controller
{

   
    public function items_data(Request $req)
    {
        // $lat = $req->query('lat');
        // $log = $req->query('log');
        try
            {
                $client = new Client();
                $response = $client->get('https://geolocation.poweradspy.com/');
                $data = json_decode($response->getBody(), true);
                $lat = $data['latitude'];
                $log = $data['longitude'];
                // $ip=$data['ip'];
                // dd($lat,$log,$ip);
                
                
            
                $query = additems::query();
                
                if ($req->ajax()) 
                {
                //   dd($lat,$log);
                    // $lat = '12.928075';
                    // $log = '77.619922';
                    
                    $data = $query->select(
                        'additems.*',
                        DB::raw("ROUND(6371 * acos(cos(radians(" . $lat . "))
                            * cos(radians(additems.lat))
                            * cos(radians(additems.log) - radians(" . $log . "))
                            + sin(radians(" . $lat . "))
                            * sin(radians(additems.lat))), 2) AS distance")
                    )
                    ->where('food_name', 'LIKE', '%' . $req->search . '%')
                    ->orWhere('restaurant_name', 'LIKE', '%' . $req->search . '%')
                    ->orWhere('items_name', 'LIKE', '%' . $req->search . '%')
                    ->orderBy('distance', 'asc')
                    ->get();
                    return response()->json(['collection' => $data]);
                } 
                else {
                    // $data = $query->get();
                    // $lat = '12.928075';
                    // $log = '77.619922';
                    // dd($lat,$log);
                    $data = DB::table('additems')
                        ->select(
                            'additems.*', // Select all columns from the additems table
                            DB::raw("ROUND(6371 * acos(cos(radians(" . $lat . "))
                                * cos(radians(additems.lat))
                                * cos(radians(additems.log) - radians(" . $log . "))
                                + sin(radians(" . $lat . "))
                                * sin(radians(additems.lat))), 2) AS distance")
                        )
                        ->orderBy('distance', 'asc') 
                        ->get();
                    // dd($data);
                    return view("userdashboard", ['collection' => $data]);
                }
          }
      catch (\Exception $e) {
            // Log the exception
            \Log::error($e->getMessage());
    
            // Return a response with an error status
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    
        
    }
   
    public function map(Request $req)
    {
        $client = new Client();
        $response = $client->get('https://geolocation.poweradspy.com/');
        $data = json_decode($response->getBody(), true);
        $lat = $data['latitude'];
        $log = $data['longitude'];
        // dd($lat,$log);
        return view('test',compact('data'));
    }
    
    
    

}
