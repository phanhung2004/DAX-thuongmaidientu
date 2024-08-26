<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->where('soft_delete', 0)
            ->orderByDesc('id')
            ->paginate(10);

        return view(
            'admin.products.index',
            compact('products')
        );
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view(
            'admin.products.create',
            compact('categories', 'colors', 'sizes', 'brands')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'material' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'color_id.*' => 'required|exists:colors,id',
            'size_id.*' => 'required|exists:sizes,id',
            'quantity.*' => 'required|integer',
            'hinh.*' => 'nullable|image'
        ]);

        $data_product = [
            'code' => $request['code'],
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'price' => $request['price'],
            'sale_price' => $request['sale_price'],
            'description' => $request['description'],
            'material' => $request['material'],
            'category_id' => $request['category_id'],
            'brand_id' => $request['brand_id'],
        ];

        // Xử lý ảnh sản phẩm
        $data_product['image'] = "";
        if ($request->hasFile('image')) {
            $data_product['image'] = $request->file('image')->store('images');
        }

        $product = Product::create($data_product);

        // Xử lý biến thể
        $color_ids = $request->input('color_id', []);
        $size_ids = $request->input('size_id', []);
        $quantities = $request->input('quantity', []);
        $images = $request->file('hinh', []);

        foreach ($color_ids as $i => $color_id) {
            // Kiểm tra các chỉ số và mảng
            if (isset($size_ids[$i]) && isset($quantities[$i])) {
                $variant = [
                    'product_id' => $product->id,
                    'color_id' => $color_id,
                    'size_id' => $size_ids[$i],
                    'quantity' => $quantities[$i],
                    'image' => isset($images[$i]) ? $images[$i]->store('images') : "", // Hoặc xử lý theo yêu cầu của bạn
                ];

                ProductVariant::create($variant);
            }
        }

        return redirect()->route('products.index')->with('message', 'Thêm dữ liệu thành công');
    }

    //Hiển thị form sửa
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view(
            'admin.products.edit',
            compact('categories', 'brands', 'colors', 'sizes', 'product')
        );
    }

    //Cập nhật
    public function update(Request $request, Product $product)
    {
        $data_product = [
            'code' => $request['code'],
            'name' => $request['name'],
            'price' => $request['price'],
            'sale_price' => $request['sale_price'],
            'description' => $request['description'],
            'material' => $request['material'],
            'category_id' => $request['category_id'],
            'brand_id' => $request['brand_id'],
        ];

        //Ảnh sản phẩm cũ
        $data_product['image'] = $product->image;
        //Nhập ảnh mới nếu có
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images');
            $data_product['image'] = $path;
        }

        $product->update($data_product);

        // Lấy tất cả biến thể hiện tại của sản phẩm
        $existing_variants = ProductVariant::query()
            ->where('product_id', $product->id)
            ->get()
            ->keyBy(function ($item) {
                return $item->color_id . '-' . $item->size_id;
            });

        // Danh sách biến thể gửi từ form
        $new_variants = [];
        foreach ($request['color_id'] as $index => $color_id) {
            $new_variants[$color_id . '-' . $request['size_id'][$index]] = [
                'product_id' => $product->id,
                'color_id' => $color_id,
                'size_id' => $request['size_id'][$index],
                'quantity' => $request['quantity'][$index]
            ];
        }

        // Cập nhật hoặc tạo mới biến thể
        foreach ($new_variants as $key => $data_variant) {
            if (isset($existing_variants[$key])) {
                $existing_variants[$key]->update($data_variant); // Cập nhật
                unset($existing_variants[$key]); // Xóa khỏi danh sách tồn tại
            } else {
                ProductVariant::query()->create($data_variant); // Tạo mới
            }
        }

        // Xóa các biến thể không còn tồn tại
        foreach ($existing_variants as $variant) {
            $variant->delete();
        }

        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công');
    }
    //Xóa sản phẩm
    public function destroy(Product $product)
    {
        $product->update(['soft_delete' => 1]);
        return redirect()->route('products.index')->with('message', 'Xóa dữ liệu thành công');
    }
}
