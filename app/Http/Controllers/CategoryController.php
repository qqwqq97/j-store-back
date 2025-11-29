<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function get()
    {
        $data = Category::all();
        
        return response()->json([
            'message' => 'success!',
            'data' => $data
        ], 200);
    }
}
