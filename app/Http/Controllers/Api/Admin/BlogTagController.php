<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogTagRequest;
use App\Repositories\Interface\BlogTagInterface;
use Exception;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{
    protected $blogtag;

    public function __construct(BlogTagInterface $blogtag)
    {
        $this->blogtag = $blogtag;
    }
    public function index()
    {
        try {
            $blogtags = $this->blogtag->all();
            return response()->json([
                'blogtags' => $blogtags,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ], 404);
        }
    }
    public function store(BlogTagRequest $request)
    {
        try {
            $this->blogtag->store($request->all());
            return response()->json([
                'message' => 'Blog Tag Created Successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Blog Tag Not Created',
                'error' => $e,
            ], 404);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->blogtag->update($request->all(), $id);
            return response()->json([
                'message' => 'Blog Tag Updated Successfully',

            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Blog Tag not Updated',
                'error' => $e,
            ], 404);
        }
    }
    public function delete($id)
    {
        try {
            $this->blogtag->delete($id);
            return response()->json([
                'message' => 'Blog Tag Deleted Successfully',

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
            $this->blogtag->restore($id);
            return response()->json([
                'message' => 'Blog Tag Restore Successfully',

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
            $this->blogtag->forceDelete($id);
            return response()->json([
                'message' => 'Blog Tag ForceDelete Successfully',

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
            $blogtags = $this->blogtag->onlyTrashed();
            return response()->json([
                'blogtags' =>$blogtags,
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
            $this->blogtag->statusChange($id);
            return response()->json([
                'message' => 'Blog Tag Status Update Successfully',

            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ], 404);
        } 
    }
}
