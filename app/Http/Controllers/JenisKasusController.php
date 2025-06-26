<?php

namespace App\Http\Controllers;

use App\Models\jenis_kasus;
use App\Models\JenisKasus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class JenisKasusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $jenis_kasus = jenis_kasus::all();
            return DataTables::of($jenis_kasus)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('jenis_kasus.edit', $row->id) . '" class="edit btn btn-primary btn-sm me-1">Edit</a>';
                    $btn .= '<a href="' . route('jenis_kasus.show', $row->id) . '" class="show btn btn-info btn-sm me-1">Show</a>';
                    $btn .= '
                        <form action="' . route('jenis_kasus.destroy', $row->id) . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('jenis_kasus.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis_kasus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_kasus'  => 'required'
        ]);

        $input = $request->all();
        $input['created_by'] = 1;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        jenis_kasus::create($input);

        return redirect()->route('jenis_kasus.index')->with('success', 'Jenis Kasus Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jenisKasus = jenis_kasus::findOrFail($id);
        return view('jenis_kasus.show', compact('jenisKasus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jenisKasus = jenis_kasus::findOrFail($id);

        return view('jenis_kasus.edit', compact('jenisKasus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis_kasus'  => 'required'
        ]);
        $jenisKasus = jenis_kasus::findOrFail($id);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jenisKasus->update($request->all());

        return redirect()->route('jenis_kasus.index')->with('success', 'Jenis Kasus Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jenisKasus = jenis_kasus::findOrFail($id);
        $jenisKasus->delete();

        return redirect()->route('jenis_kasus.index')->with('success', 'Jenis Kasus Deleted Successfully');
    }
}
