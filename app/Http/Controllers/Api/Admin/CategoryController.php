<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Interface\CategoryInterface;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = $this->category->all();
            return response()->json([
                'categories' =>$categories,
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $this->category->store($request->all());
            return response()->json([
                'message' => 'Category Created Successfully',
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Category Not Created',
                'error' => $e,
            ],404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|unique:languages,name,' . $slug,
        ]);
        try {
            $this->category->update($request->all(), $slug);
            return response()->json([
                'message' => 'Language Updated Successfully',
            ]);
        }
        catch (Exception $e){
            return response()->json([
                'message' => 'Language not Updated',
                'error' => $e,
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($slug)
    {
        try {
            $this->category->delete($slug);
            return response()->json([
                'message' => 'Category Deleted Successfully',

            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ], 404);
        }
    }

    public function restore($slug)
    {
        try {
            $this->category->restore($slug);
            return response()->json([
                'message' => 'Category Restore Successfully',

            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ],404);
        }
    }
    public function forceDelete($slug)
    {
        try {
            $this->category->forceDelete($slug);
            return response()->json([
                'message' => 'Category Deleted Permanently',

            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ],404);
        }
    }
    public function onlyTrashed()
    {
        try {
            $categories = $this->category->onlyTrashed();
            return response()->json([
                'categories' =>$categories,
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ],404);
        }
    }
}
