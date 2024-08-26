<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('admin/brand/index', compact('brands'));
    }

    public function create(){
        $brands = Brand::all();

        return view('admin/brand/createBrand', compact('brands'));
    }
    public function store(Request $request){
        $request->validate([
            'name' =>'required|string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('logo');
        $data['logo'] = '';

        if($request->hasFile('logo')){
            $path_logo = $request->file('logo')->store('logo');
            $data['logo'] = $path_logo;
        }
        Brand::query()->create($data);

        return redirect()->route('brand.index')->with('success', 'Thêm thương hiệu thành công');
    }
    public function edit($id){

        $brands = Brand::findOrFail($id);

        return view('admin/brand/editBrand', compact('brands'));
    }
    public function update(Request $request, $id){
        $brands = Brand::findOrFail($id);

        $data = $request->except('logo');

        if($request->hasFile('logo')){
            //xoa anh cu neu co
            if($brands->logo && Storage::exists($brands->logo)){
                Storage::delete($brands->logo);
            }
            $path_logo = $request->file('logo')->store('logo');
            $data['logo'] = $path_logo;
        }else{
            $data['logo'] = $brands->logo;
        }
        //luu anh moi
        $brands->update($data);

        return redirect()->route('brand.index')->with('success', 'Cập nhật thương hiệu thành công');
    }

    public function delete($id){

        $brands = Brand::findOrFail($id);

        $brands->delete($id);

        return redirect()->route('brand.index')->with('success', 'Xóa thương hiệu thành công');
    }
}
