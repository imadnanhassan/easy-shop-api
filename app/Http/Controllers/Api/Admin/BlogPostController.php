<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Repositories\Interface\BlogPostInterface;
use Exception;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    protected $blogpost;

    public function __construct(BlogPostInterface $blogpost)
    {
        $this->blogpost = $blogpost;
    }
    public function index()
    {
        try {
            $blogposts = $this->blogpost->all();
            return response()->json([
                'blogposts' => $blogposts,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ], 404);
        }
    }
    public function store(BlogPostRequest $request)
    {
        try {
            $this->blogpost->store($request->all());
            return response()->json([
                'message' => 'Blog Post Created Successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Blog Post Not Created',
                'error' => $e,
            ], 404);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->blogpost->update($request->all(), $id);
            return response()->json([
                'message' => 'Blog Post Updated Successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Blog Post not Updated',
                'error' => $e,
            ], 404);
        }
    }
    public function delete($id)
    {
        try {
            $this->blogpost->delete($id);
            return response()->json([
                'message' => 'Blog Post Deleted Successfully',

            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Sorry Something want to wrong',
                'error' => $e,
            ], 404);
        }
    }

    public function restore($id)
    {
        try {
            $this->blogpost->restore($id);
            return response()->json([
                'message' => 'Blog Post Restore Successfully',

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
            $this->blogpost->forceDelete($id);
            return response()->json([
                'message' => 'Blog Post ForceDelete Successfully',

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
            $blogposts = $this->blogpost->onlyTrashed();
            return response()->json([
                'blogposts' =>$blogposts,
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
            $this->blogpost->statusChange($id);
            return response()->json([
                'message' => 'Blog Post Status Update Successfully',

            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ], 404);
        } 
    }
}
