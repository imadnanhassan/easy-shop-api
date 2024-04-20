<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Repositories\Interface\BrandInterface;
use Exception;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brand;
    public function __construct(BrandInterface $brand)
    {
        $this->brand = $brand;
    }
    public function index()
    {
        try {
            $brands = $this->brand->all();
            return response()->json([
                'brands' =>$brands,
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ],404);
        }
    }
    public function store(BrandRequest $request)
    {
        try {
            $this->brand->store($request->all());
            return response()->json([
                'message' => 'Brand Created Successfully',
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Brand Not Created',
                'error' => $e,
            ],404);
        }

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:65|unique:brands,name,' . $id,
        ]);
        try {
            $this->brand->update($request->all(), $id);
            return response()->json([
                'message' => 'Brand Updated Successfully',

            ]);
        }
       catch (Exception $e){
           return response()->json([
               'message' => 'Brand not Updated',
               'error' => $e,
           ],404);
       }
    }
    public function delete($id)
    {
        try {
            $this->brand->delete($id);
            return response()->json([
                'message' => 'Brand Deleted Successfully',

            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something want to wrong',
                'error' => $e,
            ],404);
        }
    }
}
