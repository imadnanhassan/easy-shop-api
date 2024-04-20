<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Repositories\Interface\ColorInterface;
use Exception;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    protected $color;

    public function __construct(ColorInterface $color)
    {
        $this->color = $color;
    }

    public function index()
    {
        try {
            $colors = $this->color->all();
            return response()->json([
                'colors' =>$colors,
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ],404);
        }
    }

    public function store(ColorRequest $request)
    {
        try {
            $this->color->store($request->all());
            return response()->json([
                'message' => 'Color Created Successfully',
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Color Not Created',
                'error' => $e,
            ],404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->color->update($request->all(), $id);
            return response()->json([
                'message' => 'Color Updated Successfully',

            ]);
        }
       catch (Exception $e){
           return response()->json([
               'message' => 'Color not Updated',
               'error' => $e,
           ],404);
       }
    }

    public function delete($id)
    {
        try {
            $this->color->delete($id);
            return response()->json([
                'message' => 'Color Deleted Successfully',

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
            $this->color->restore($id);
            return response()->json([
                'message' => 'Color Restore Successfully',

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
            $this->color->forceDelete($id);
            return response()->json([
                'message' => 'Color ForceDelete Successfully',

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
            $colors = $this->color->onlyTrashed();
            return response()->json([
                'colors' =>$colors,
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
            $this->color->statusChange($id);
            return response()->json([
                'message' => 'Color Status Update Successfully',

            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ], 404);
        } 
    }
}
