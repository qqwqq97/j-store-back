<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct()
    {
        if(!Auth::guard('admin')->check()) {
            abort(403);
        }    
    }

    public function list()
    {
        $lists = Product::orderBy('created_at', 'desc')->get();

        return view('admin.shohin.list', compact('lists'));
    }

    public function detail($id) 
    {
        $detail = Product::with('category')->findOrFail($id);

        return view('admin.shohin.detail', compact('detail'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('admin.shohin.edit', compact('product', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.shohin.create', compact('categories'));
    }
    
    public function createShohin(Request $request) 
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,avif|max:2048'
        ]);

        $imageUrl = null;
        // input type=file name='image'로 업로드된 파일있나 확인
        if($request->hasFile('image')) {
            // 업로드된 파일을 /storage/app/public/products 폴더에 저장
            // 저장된 파일명을 포함한 경로 리턴 products/abc.jpg
            // filesystems.php 의 'public' 설정을 사용.
            $imagePath = $request->file('image')->store('products', 'public');
            // 브라우저에서 접근가능한 url로 변환 ex)/storage/products/abc123.jpg
            // 서버에 파일 저장 /storage/app/public/products/...
            $imageUrl = '/storage/' . $imagePath;
        }

        Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? '',
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('admin.shohin.list')->with('success', '商品が登録されました！');
    }

    public function update(Request $request, $id) 
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image_url' => 'nullable|mimes:jpg,jpeg,png,webp,avif|max:2048'
        ]);
        
        $imageUrl = $product->image_url;

        if($request->hasFile('image')) {

            if($product->image_url) {
                $relativePath = str_replace('/storage/', '', $product->image_url);
                Storage::disk('public')->delete($relativePath);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $imageUrl = '/storage/' . $imagePath;
        }
            
        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? '',
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('admin.shohin.detail', $id)->with('success', '商品が修正されました！');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // 이미지파일 삭제
        if($product->image_url) {
            // /storage/products/abc.jpg -> products/abc.jpg
            $relativePath = str_replace('/storage/', '', $product->image_url);
            Storage::disk('public')->delete($relativePath);
        }

        $product->delete();

        return redirect()->route('admin.shohin.list')->with('success', '商品が削除されました！');

    }
}
