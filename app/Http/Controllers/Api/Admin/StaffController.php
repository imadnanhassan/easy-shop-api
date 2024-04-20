<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Repositories\Interface\StaffInterface;
use Illuminate\Http\Request;

class StaffController extends Controller
{
     protected $staff;
     public function __construct(StaffInterface $staff)
     {
        $this->staff = $staff;
     }
public function index()
{
    try {
        $staff = $this->staff->all();
        return response()->json([
            'staff' => $staff,
        ]);
    }catch (Exception $e){
        return response()->json([
            'message' => 'Sorry Something went to wrong',
            'error' => $e,
        ],404);
    }
}
public function store(StaffRequest $request)
{
    try {
        $this->staff->store($request->all());
        return response()->json([
            'message' => 'Staff Created Successfully',
        ]);
    }catch (Exception $e){
        return response()->json([
            'message' => 'Sorry Something went to wrong',
            'error' => $e,
        ],404);
    }
}
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:65',
            'email' => 'required|string|max:65|unique:admins,email,'.$id,
            'username' => 'required|string|max:65|unique:admins,username,'.$id,
            'phone_number' => 'required|string|max:65|unique:admins,phone_number,'.$id,
            'password' => 'required|min:8|max:15',
        ]);
        try {
            $this->staff->update($request->all(), $id);
            return response()->json([
                'message' => 'Staff Updated Successfully',

            ]);
        }
        catch (Exception $e){
            return response()->json([
                'message' => 'Staff not Updated',
                'error' => $e,
            ],404);
        }
    }
    public function delete($id)
    {
        try {
            $this->staff->delete($id);
            return response()->json([
                'message' => 'Staff Deleted Successfully',

            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ],404);
        }
    }
}
