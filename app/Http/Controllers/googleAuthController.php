<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\order;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            
            if (!$user) {
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    // 'lat' => $latitude,
                    // 'log' => $longitude,
                ]);

                Auth::guard('web')->login($newUser);

                return redirect('userdashboard');
            } else {
                Auth::guard('web')->login($user);

                

                return redirect('userdashboard');
            }
        }
        catch (Exception $e) {
            // Log the exception for debugging
            \Log::error('Google authentication error: ' . $e->getMessage());

            // Provide a more informative error message
            return redirect('userlogin')->with('error', 'Something went wrong with Google authentication. Please try again.');
        }
    }

    public function users_orderd_data()
{
    $userId = Auth::id(); // Retrieve the currently authenticated user's ID

    $user = User::find($userId);

    if ($user) {
        // Retrieve orders for the user using user_id
        $order_data = Order::where('user_id', $userId)->get();

        if ($order_data->isNotEmpty()) {
            // Do something with the orders, or simply dump them
            // dd($order_data);
            return view('usersordersdata', compact('order_data'));
        } else {
            // No orders for this user
            // dd("123");
            $order_data = collect(); // Create an empty collection
            return view('usersordersdata')->with('info', 'No orders found for this user.')->with('order_data', $order_data);
        }
    } else {
        // User not found
        return view('usersorsdersdata')->with('error', 'User not found.');
    }
}

}
