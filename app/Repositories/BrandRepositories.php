<?php
namespace App\Repositories;
use App\Models\Brand;
use App\Repositories\Interface\BrandInterface;
use Illuminate\Support\Str;

class BrandRepositories implements BrandInterface
{
    public function all(){
        return Brand::latest()->get();
    }
    public function store(array $data){

        $brand = new Brand();
        $brand->name = $data['name'];
        $brand->slug = Str::slug($data['name']);
        $brand->priority = $data['priority'];
        $brand->status = $data['status'];
        $brand->created_by = auth()->id();
        $brand->save();
    }
    public function update(array $data,$id){
        $brand = Brand::find($id);
        $brand->name = $data['name'];
        $brand->slug = Str::slug($data['name']);
        $brand->priority = $data['priority'];
        $brand->status = $data['status'];
        $brand->save();
    }
    public function delete($id){
        Brand::find($id)->delete();
    }
    public function statusChange($id){

    }
}
