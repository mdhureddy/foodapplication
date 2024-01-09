<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\card;
use Auth;
use DB;

use Session;
use App\Models\order;
class WishlistController extends Controller
{
    
    public function wishlist_data()
    {
        return view('wishlist');
    }

    public function display_data()
    {
         $user = Auth::user();
         $items_data = card::where('user_id', $user->id)->get();
        return view('wishlist',compact('user', 'items_data'));
    }

    public function delete_data($id)
    {
        \Stripe\Stripe::setApiKey(config('strip.sk'));
        
        $userDataExists = DB::table('cards')->where('user_id', $id)->get();
    
        if ($userDataExists->isNotEmpty()) {
            $lineItems = [];
    
            foreach ($userDataExists as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'inr',
                        'product_data' => [
                            'name' => $item->food_name,
                            // Add more product data as needed
                        ],
                        'unit_amount' => $item->price * 100, // Amount in cents
                    ],
                    'quantity' => $item->quantity,
                ];
            }
    
            // Create a Checkout Session
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('success', ['id' => $id]), // Pass the user ID or relevant data in the success URL
                'cancel_url' => route('wishlist'),
            ]);
    
            // Delete the particular user's items from the cards table
            // DB::table('cards')->where('user_id', $id)->delete();
    
            // Return the Checkout session URL
            return response()->json(['url' => $session->url]);
        } else {
            return back()->with('danger', "No data found for checkout");
        }
    }



    public function delete_particular_item($user_id, $item_id)
    {
        
        DB::table('cards')->where('user_id', $user_id)->where('id', $item_id)->delete();
        // return back()->with('danger',"Removed successfully");
        return back();
    }


    public function success($id)
    {
        $userDataExists = DB::table('cards')->where('user_id', $id)->get();

        if ($userDataExists->isNotEmpty()) {
            foreach ($userDataExists as $item) {
                DB::table('orders')->insert([
                    'user_id' => $item->user_id,
                    'owner_id' => $item->owner_id,
                    'restaurant_name' => $item->restaurant_name,
                    'food_name' => $item->food_name,
                    'quantity' => $item->quantity,
                    'description' => $item->description,
                    'price' => $item->price,
                    'image' => $item->image,
                    // Add more columns and values as needed
                ]);
            }
        }
        DB::table('cards')->where('user_id', $id)->delete();
        return redirect('userorder');

    }
    public function checkout()
    {
        return "Checkout Success";
    }
 


   
}
