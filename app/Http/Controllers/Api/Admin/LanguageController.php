<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Repositories\Interface\LanguageInterface;
use App\Traits\Uploadable;
use Exception;
use Illuminate\Http\Request;
class LanguageController extends Controller
{
//    use processImage;
    use Uploadable;
    protected $language;
    public function __construct(LanguageInterface $language)
    {
        $this->language = $language;
    }
    public function index()
    {
        try {
            $languages = $this->language->all();
            return response()->json([
                'languages' =>$languages,
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageRequest $request)
    {
        try {
            $this->language->store($request->all());
            return response()->json([
                'message' => 'Language Created Successfully',
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Language Not Created',
                'error' => $e,
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:65|unique:languages,name,' . $id,
            'code' => 'required|string|unique:languages,code,' . $id,
        ]);
        try {
            $this->language->update($request->all(), $id);
            return response()->json([
                'message' => 'Language Updated Successfully',
            ]);
        }
        catch (Exception $e){
            return response()->json([
                'message' => 'Language not Updated',
                'error' => $e,
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $this->language->delete($id);
            return response()->json([
                'message' => 'Language Deleted Successfully',

            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Sorry Something went wrong',
                'error' => $e,
            ], 404);
        }
    }
}
