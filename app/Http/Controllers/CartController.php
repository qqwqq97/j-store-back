<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Address;
use App\Models\User;

class CartController extends Controller
{
  public function saveAddress(Request $request)
  {
    $user = Auth::user(); 
    
    if(!$user) {
        return response()->json([
            'message' => 'Unauthenticated',
        ], 401);
    }
    if($request['is_default'] == 1) {
      Address::where('user_id', $user->id)
        ->where('is_default', 1)
        ->update(['is_default' => 0]);
    }
  
    Address::create([
      'user_id' => $user->id,
      'postal_code' => $request['postal_code'],
      'prefecture' => $request['prefecture'],
      'city' => $request['city'],
      'street' => $request['street'],
      'building' => $request['building'],
      'phone_number' => $request['phone_number'],
      'is_default' => $request['is_default']
    ]);

    return response()->json([
      'message' => '住所を登録しました。',
    ]);
  }

  public function getAddress() 
  {
    $user = Auth::user(); 
    $user_id = $user->id;

    if(!$user_id) {
      return response()->json([
          'message' => 'Unauthenticated',
      ], 401);
    }

    $addressDetail = Address::where('user_id', $user_id)->where('is_default', 1)->first();
    
    if($addressDetail)
    {
      return response()->json([
        'postal_code' => $addressDetail->postal_code,
        'prefecture' => $addressDetail->prefecture,
        'city' => $addressDetail->city,
        'street' => $addressDetail->street,
        'building' => $addressDetail->building,
        'phone_number' => $addressDetail->phone_number,
        'is_default' => $addressDetail->is_default
      ]);
    }
  }
}



