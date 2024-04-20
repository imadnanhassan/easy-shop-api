<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;
use App\Repositories\Interface\UnitInterface;
use Exception;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    protected $unit;

    public function __construct(UnitInterface $unit)
    {
        $this->unit = $unit;
    }
    public function index()
    {
        try {
            $units = $this->unit->all();
            return response()->json([
                'units' => $units,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ], 404);
        }
    }
    public function store(UnitRequest $request)
    {
        try {
            $this->unit->store($request->all());
            return response()->json([
                'message' => 'Unit Created Successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Unit Not Created',
                'error' => $e,
            ], 404);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $this->unit->update($request->all(), $id);
            return response()->json([
                'message' => 'Unit Updated Successfully',

            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Unit not Updated',
                'error' => $e,
            ], 404);
        }
    }
    public function delete($id)
    {
        try {
            $this->unit->delete($id);
            return response()->json([
                'message' => 'Unit Deleted Successfully',

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
            $this->unit->restore($id);
            return response()->json([
                'message' => 'Unit Restore Successfully',

            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Sorry Something want to wrong',
                'error' => $e,
            ], 404);
        }
    }
    public function forceDelete($id)
    {
        try {
            $this->unit->forceDelete($id);
            return response()->json([
                'message' => 'Unit ForceDelete Successfully',

            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Sorry Something want to wrong',
                'error' => $e,
            ], 404);
        }
    }
    public function onlyTrashed()
    {
        try {
            $units = $this->unit->onlyTrashed();
            return response()->json([
                'units' => $units,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ], 404);
        }
    }

    public function statusChange($id){
        try{
            $this->unit->statusChange($id);
            return response()->json([
                'message' => 'Unit Status Update Successfully',

            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ], 404);
        } 
    }
}
