<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Repositories\Interface\AttributeInterface;

class AttributeController extends Controller
{
    protected $attribute;

    public function __construct(AttributeInterface $attribute)
    {
        $this->attribute = $attribute;
    }

    public function index()
    {
        try {
            $attributes = $this->attribute->all();
            return response()->json([
                'attributes' =>$attributes,
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ],404);
        }
    }

    public function store(AttributeRequest $request)
    {
        try {
            $this->attribute->store($request->all());
            return response()->json([
                'message' => 'Attribute Created Successfully',
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Attribute Not Created',
                'error' => $e,
            ],404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->attribute->update($request->all(), $id);
            return response()->json([
                'message' => 'Attribute Updated Successfully',

            ]);
        }
       catch (Exception $e){
           return response()->json([
               'message' => 'Attribute not Updated',
               'error' => $e,
           ],404);
       }
    }

    public function delete($id)
    {
        try {
            $this->attribute->delete($id);
            return response()->json([
                'message' => 'Attribute Deleted Successfully',

            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something want to wrong',
                'error' => $e,
            ],404);
        }
    }

}
