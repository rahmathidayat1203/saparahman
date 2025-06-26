<?php

namespace App\Http\Controllers;

use App\Models\ortu_santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrtuSantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perpage = $request->get('per_page', 5);
            $ortu_santri = ortu_santri::paginate($perpage);

            return response()->json([
                'success' => true,
                'message' => 'data fetch successfully',
                'data' => $ortu_santri->items(),
                'pagination' => [
                    'current_page' => $ortu_santri->currentPage(),
                    'per_page' =>  $ortu_santri->perPage(),
                    'total_page' => $ortu_santri->lastPage()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'id_ortu'  => 'required',
                'id_santri' => 'required',
            ]); 

            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'validation error',
                    'data' => $validator->errors()
                ]);
            }
            $input = $request->all();
            $input["created_by"] = 1;

            ortu_santri::create($input);
            return response()->json([
                'success' => true,
                'message' => 'ortu_santri Created Successfully',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ortu_santri $ortu_santri)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Fetch ortu_santri by id Successfully',
                'data' => $ortu_santri
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ortu_santri $ortu_santri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ortu_santri $ortu_santri)
    {
        try {
            $validator = Validator::make($request->all(),[
                'id_ortu'  => 'required',
                'id_santri' => 'required'
            ]); 

            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'validation error',
                    'data' => $validator->errors()
                ], 403);
            }
            $input = $request->all();
            $input["updated_by"] = 1;

            $ortu_santri->update($input);
            return response()->json([
                'success' => true,
                'message' => 'ortu_santri Updated Successfully',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,ortu_santri $ortu_santri)
    {
        try {
            $input = $request->all();
            $input["deleted_by"] = 1;

            $ortu_santri->delete($input);
            return response()->json([
                'success' => true,
                'message' => 'Santri Deleted Successfully by id'.$ortu_santri->id,
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
