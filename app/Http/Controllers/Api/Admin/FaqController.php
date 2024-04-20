<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Repositories\Interface\FaqInterface;
use Exception;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $faq;

    public function __construct(FaqInterface $faq)
    {
        $this->faq = $faq;
    }

    public function index()
    {
        try {
            $faqs = $this->faq->all();
            return response()->json([
                'faqs' =>$faqs,
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ],404);
        }
    }

    public function store(FaqRequest $request)
    {
        try {
            $this->faq->store($request->all());
            return response()->json([
                'message' => 'Faq Created Successfully',
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Faq Not Created',
                'error' => $e,
            ],404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->faq->update($request->all(), $id);
            return response()->json([
                'message' => 'Faq Updated Successfully',

            ]);
        }
       catch (Exception $e){
           return response()->json([
               'message' => 'Faq not Updated',
               'error' => $e,
           ],404);
       }
    }

    public function delete($id)
    {
        try {
            $this->faq->delete($id);
            return response()->json([
                'message' => 'Faq Deleted Successfully',

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
            $this->faq->restore($id);
            return response()->json([
                'message' => 'Faq Restore Successfully',

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
            $this->faq->forceDelete($id);
            return response()->json([
                'message' => 'Faq ForceDelete Successfully',

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
            $faqs = $this->faq->onlyTrashed();
            return response()->json([
                'faqs' =>$faqs,
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
            $this->faq->statusChange($id);
            return response()->json([
                'message' => 'Faq Status Update Successfully',

            ]);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Sorry Something went to wrong',
                'error' => $e,
            ], 404);
        } 
    }
}
