<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeValueRequest;
use App\Repositories\Interface\AttributeValueInterface;
use Exception;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    protected $attributevalue;

    public function __construct(AttributeValueInterface $attributevalue)
    {
        $this->attributevalue = $attributevalue;
    }

    public function index()
    {
        try {
            $attributevalues = $this->attributevalue->all();
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

    public function store(AttributeValueRequest $request)
    {
        try {
            $this->attributevalue->store($request->all());
            return response()->json([
                'message' => 'Attribute Value Created Successfully',
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Attribute Value Not Created',
                'error' => $e,
            ],404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->attributevalue->update($request->all(), $id);
            return response()->json([
                'message' => 'Attribute Value Updated Successfully',

            ]);
        }
       catch (Exception $e){
           return response()->json([
               'message' => 'Attribute Value not Updated',
               'error' => $e,
           ],404);
       }
    }

    public function delete($id)
    {
        try {
            $this->attributevalue->delete($id);
            return response()->json([
                'message' => 'Attribute Value Deleted Successfully',

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
            $this->attributevalue->restore($id);
            return response()->json([
                'message' => 'Attribute Value Restore Successfully',

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
            $this->attributevalue->forceDelete($id);
            return response()->json([
                'message' => 'Attribute Value ForceDelete Successfully',

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
            $attributevalues = $this->attributevalue->onlyTrashed();
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
}
