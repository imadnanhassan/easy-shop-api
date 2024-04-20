<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Repositories\Interface\SliderInterface;
use Exception;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $slider;
    public function __construct(SliderInterface $slider)
    {
        $this->slider = $slider;
    }
    public function index()
    {
        try {
            $sliders = $this->slider->all();
            return response()->json([
                'sliders' =>$sliders,
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ],404);
        }
        
    }
    public function store(SliderRequest $request)
    {
        try {
            $this->slider->store($request->all());
            return response()->json([
                'message' => 'Slider Created Successfully',
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Slider Not Created',
                'error' => $e,
            ],404);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->slider->update($request->all(), $id);
            return response()->json([
                'message' => 'Slider Updated Successfully',

            ]);
        }
       catch (Exception $e){
           return response()->json([
               'message' => 'Slider not Updated',
               'error' => $e,
           ],404);
       }
    }
    public function delete($id)
    {
        try {
            $this->slider->delete($id);
            return response()->json([
                'message' => 'Slider Deleted Successfully',

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
            $this->slider->restore($id);
            return response()->json([
                'message' => 'Slider Restore Successfully',

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
            $this->slider->forceDelete($id);
            return response()->json([
                'message' => 'Slider ForceDelete Successfully',

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
            $sliders = $this->slider->onlyTrashed();
            return response()->json([
                'sliders' =>$sliders,
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
            $this->slider->statusChange($id);
            return response()->json([
                'message' => 'Slider Status Update Successfully',

            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ], 404);
        } 
    }
}
