<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getNew(Request $request)
    {
        $limit = $request->query('limit');
        
        $query = Product::orderBy('created_at', 'desc');

        if($limit) {
            $query->take($limit);
        }

        $datas = $query->get();

        return response()->json([
            'message' => 'success!',
            'data' => $datas
        ], 200);
    }

    public function detail($id)
    {
        $data = Product::find($id);

        if (!$data) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json([
            'message' => 'success!',
            'data' => $data
        ], 200);

    }
}
