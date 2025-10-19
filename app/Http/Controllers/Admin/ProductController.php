<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ], [
            'title.required' => 'Tên sản phẩm là bắt buộc.',
            'description.required' => 'Mô tả sản phẩm là bắt buộc.',
            'cover_image.required' => 'Ảnh sản phẩm là bắt buộc.',
            'cover_image.image' => 'Ảnh bìa phải là một hình ảnh.',
            'cover_image.mimes' => 'Ảnh bìa phải có định dạng jpeg, png, jpg hoặc gif.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'stock.required' => 'Số lượng tồn kho là bắt buộc.',
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm.',
        ]);

        // Lưu ảnh vào storage/app/public/products
        $filename = time() . '_' . $request->file('cover_image')->getClientOriginalName();
        $path = $request->file('cover_image')->storeAs('products', $filename, 'public');

        // Tạo slug duy nhất
        $slug = Str::slug($request->title);
        $slugExists = Product::where('slug', $slug)->exists();
        if($slugExists){
            $slug .= '-' . Str::random(5);
        }

        Product::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'cover_image' => $path, // lưu đường dẫn relative: products/xxx.jpg
            'price' => $request->price,
            'stock' => $request->stock,
            'is_bestseller' => $request->has('is_bestseller'),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm thành công');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.pages.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_bestseller' => $request->has('is_bestseller'),
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('cover_image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($product->cover_image && Storage::disk('public')->exists($product->cover_image)) {
                Storage::disk('public')->delete($product->cover_image);
            }

            $filename = time() . '_' . $request->file('cover_image')->getClientOriginalName();
            $path = $request->file('cover_image')->storeAs('products', $filename, 'public');

            $data['cover_image'] = $path;

            // ✅ Nếu muốn resize ảnh, uncomment đoạn sau (cần cài intervention/image)
            /*
            $image = \Image::make(storage_path('app/public/' . $path));
            $image->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save();
            */
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function destroy(Product $product)
    {
        if ($product->cover_image && Storage::disk('public')->exists($product->cover_image)) {
            Storage::disk('public')->delete($product->cover_image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công');
    }
}
