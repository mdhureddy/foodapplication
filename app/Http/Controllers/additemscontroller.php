<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\additems;
use App\Models\card;
use Auth;
use App\Models\owner;
use Session;
use GuzzleHttp\Client;
class additemscontroller extends Controller
{
    public function add_items(Request $request)
    {
        // print_r($_POST);
       $data= Session::get('loginId');
    
       
        $validate=Validator::make($request->all(),[
            'restaurant_name'=>'required|max:50',
            'food_name'=>'required|max:100',//table name
            'description'=>'required|max:500',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'image_path' => 'required', // Assuming image_path is a URL
            'items_name'=>'required',
            'lat'=>'required',
            'log'=>'required',
        ]);
        if($validate->fails())
        {
            return response()->json([
                'status'=>400,
                'messages'=>$validate->getMessageBag()
            ]);
        }
        else{
            $fileName=time().$request->file('image_path')->getClientOriginalName();
            $path=$request->file('image_path')->storeAs('images',$fileName,'public');
            $additems=new additems();
            $additems->restaurant_name=$request->restaurant_name;
            $additems->food_name=$request->food_name;
            $additems->description=$request->description;
            $additems->price=$request->price;
            $additems->image_path=$path;
            $additems->owner_id=$data;
            $additems->lat=$request->lat;
            $additems->log=$request->log;
            $additems->items_name = $request->items_name;
            $additems->save();
            return response()->json([
                'status'=>200,
                'messages'=>'Added items successfully',
            ]);
        }
    }

    public function add_particular_item()
    {
        $data=array();
        // $client = new Client();
        // $response = $client->get('https://geolocation.poweradspy.com/');
        // $data_map = json_decode($response->getBody(), true);
        // dd($data_map);
        if(Session::has('loginId'))
        {
            $data=owner::where('id','=',Session::get('loginId'))->first();
        }
        return view('additems',compact('data'));
        
    }
    

    public function addcard(Request $req,$id)
    {
        $additems=additems::find($id);

        $validator = Validator::make($req->all(), [
            'quantity' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // $user=auth()->user();
        
        $card=new card;
        $user = Auth::user();

        // Fetch the user_id from the user instance
        $user_id = $user->id;
        $card->user_id=$user_id;
        $card->owner_id=$additems->owner_id;
        $card->product_id=$id;
        $card->food_name=$additems->food_name;
        $card->restaurant_name=$additems->restaurant_name;
        $card->price=$additems->price;
        $card->image=$additems->image_path;
        $card->quantity=$req->quantity;
        // dd($card);
        $card->save();
        return redirect()->back()->with('success',"Sucessfully added to cart");
    }
   

    
    
    
}
