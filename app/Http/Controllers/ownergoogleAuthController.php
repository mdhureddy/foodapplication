<?php

namespace App\Http\Controllers;

use App\Models\owner;
use Illuminate\Http\Request;
use Session;
use Hash;
use Exception;
use App\Models\order;
use App\Models\additems;

class ownergoogleAuthController extends Controller
{
    
    function ownerlogin_validation(Request $req)
    {
        
           $req->validate([
               'email'=>'required',
               'password'=>'required'
           ]);
     $owner=owner::where('email','=',$req->email)->first();
     if($owner)
        {
             if(Hash::check($req->password,$owner->password))
             {
                session()->put('loginId',$owner->id);
               
                // session()->put('Username',$emplopyeeDetail->emp_name);
                session()->save();
                // dd(session()->all());
                 return redirect('ownerdashboard');
             }
            else{
             return back()->with('failed',"password are not matched");
            }
         }

         else{
          return back()->with('failed',"Email  is not Registered");
         
         }
   }

   public function owner_profile()
    {
        $data=array();
        if(Session::has('loginId'))
        {
            $data=owner::where('id','=',Session::get('loginId'))->first();
        }
        return view('profile',compact('data'));
    }

    public function owners_added_items()
    {
        $data = array();
    
        if (Session::has('loginId')) {
            $ownerData = owner::where('id', '=', Session::get('loginId'))->first();
    
            if ($ownerData) {
                $ownerId = $ownerData->id;
                $data = additems::where('owner_id', '=', $ownerId)->get();
                // dd($data);
            }
        }
    
        return view('ownerdashboard', compact('data'));
    }
        
    public function update_profile(Request $req,$id)
    {
        
        $req->validate([
            'name'=>'required',
            'email'=>'required|email',
            'restaurant_name'=>'required',
            // 'password'=>'required',
           
        ]);
        $data= owner::find($id);
        $data->name=$req->name;
        $data->email=$req->email;
        $data->restaurant_name=$req->restaurant_name;
        // $data->password=$req->password;
        $data->update();
        return redirect()->back()->with('success',"data updated successfully");

    }

    public function owner_orderd_data()
    {
        $ownerId = Session::get('loginId');

        $owner = Owner::find($ownerId);
        
        if ($owner) {
            // Retrieve orders for the owner using owner_id
            $order_data = Order::where('owner_id', $ownerId)->get();
        
            if ($order_data->isNotEmpty()) {
                // Do something with the orders, or simply dump them
                // dd($order_data);
                return view('ownerorderdata', compact('order_data'));
            } else {
                // No orders for this owner
                // dd('No orders for this owner.');
                $order_data = collect(); // Create an empty collection
                return view('ownerorderdata')->with('info', 'No orders found for this user.')->with('order_data', $order_data);
            }
        } else {
            // Owner not found
            dd('Owner not found.');
        }
        
  
    }
    
    
}