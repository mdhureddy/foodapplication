<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\owner;
use Hash;

class OwnerregisterController extends Controller
{
    public function owners_register(Request $request)
    {
        
        try {
           
            $validate=Validator::make($request->all(),[
                'name' => 'required|alpha|max:50',
                'email'=>'required|email|unique:owners|max:100',//table name
                'restaurant_name'=>'required',
                'password'=>'required|min:6|max:50',
                'number' => 'required|digits:10|regex:/^[6-9]\d{9}$/',
                'cpassword'=>'required|min:6|same:password',
            ],
            [
                'cpassword.same'=>'password did not match',
                'cpassword.required'=>'conform password is required',
            ]);
           
            if($validate->fails())
            {

                
                return response()->json([
                    'status'=>400,
                    'messages'=>$validate->getMessageBag()
                ]);
            }
            else{
            
                $owners=new owner();
                $owners->name=$request->name;
                $owners->email=$request->email;
                $owners->restaurant_name=$request->restaurant_name;
                $owners->number=$request->number;
                $owners->password=Hash::make($request->password);
                $owners->save();
              

                // return redirect('ownerlogin');
                return response()->json([
                    'status'=>200,
                    'messages'=>'Register successfully',
                    // 'redirect' => route('ownerlogin'), // Add the URL you want to redirect to
                ]);
    
            }
    
           
        } catch (\Exception $e) {
            \Log::error('Error in owners_register: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
            ], 500);
        }
    
    }
   
}
