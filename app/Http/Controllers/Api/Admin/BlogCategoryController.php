<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryRequest;
use App\Repositories\Interface\BlogCategoryInterface;
use Exception;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    protected $blogcategory;
    public function __construct(BlogCategoryInterface $blogcategory)
    {
        $this->blogcategory = $blogcategory;
    }
    public function index()
    {
        try {
            $blogcategories = $this->blogcategory->all();
            return response()->json([
                'blogcategories' =>$blogcategories,
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ],404);
        }
    }
    public function store(BlogCategoryRequest $request)
    {
        try {
            $this->blogcategory->store($request->all());
            return response()->json([
                'message' => 'Blog Category Created Successfully',
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Blog Category Not Created',
                'error' => $e,
            ],404);
        }

    }
    public function update(Request $request, $id)
    {
        try {
            $this->blogcategory->update($request->all(), $id);
            return response()->json([
                'message' => 'Blog Category Updated Successfully',

            ]);
        }
       catch (Exception $e){
           return response()->json([
               'message' => 'Blog Category not Updated',
               'error' => $e,
           ],404);
       }
    }
    public function delete($id)
    {
        try {
            $this->blogcategory->delete($id);
            return response()->json([
                'message' => 'Blog Category Deleted Successfully',

            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something want to wrong',
                'error' => $e,
            ],404);
        }
    }

    public function restore($id)
    {
        try {
            $this->blogcategory->restore($id);
            return response()->json([
                'message' => 'Blog Category Restore Successfully',

            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something want to wrong',
                'error' => $e,
            ],404);
        }
    }
    public function forceDelete($id)
    {
        try {
            $this->blogcategory->forceDelete($id);
            return response()->json([
                'message' => 'Blog Category ForceDelete Successfully',

            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something want to wrong',
                'error' => $e,
            ],404);
        }
    }
    public function onlyTrashed()
    {
        try {
            $attributevalues = $this->blogcategory->onlyTrashed();
            return response()->json([
                'attributevalues' =>$attributevalues,
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ],404);
        }
    }
    public function statusChange($id){
        try{
            $this->blogcategory->statusChange($id);
            return response()->json([
                'message' => 'Blog Category Status Update Successfully',

            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ], 404);
        } 
    }
}
