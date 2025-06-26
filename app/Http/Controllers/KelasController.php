<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kelas = Kelas::query();
            return DataTables::of($kelas)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('kelas.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="' . route('kelas.show', $row->id) . '" class="btn btn-info btn-sm">Show</a>';
                    $btn .= ' <form action="' . route('kelas.destroy', $row->id) . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Yakin ingin hapus?\')">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tingkatan' => 'required',
            'tingkat_kelas' => 'required',
            'nama_kelas' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->only('tingkatan', 'tingkat_kelas', 'nama_kelas');
        $input['created_by'] =  1; // fallback ke 1 kalau belum login

        Kelas::create($input);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tingkatan' => 'required',
            'tingkat_kelas' => 'required',
            'nama_kelas' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kelas = Kelas::findOrFail($id); // <-- ini diperbaiki
        $input = $request->only('tingkatan', 'tingkat_kelas', 'nama_kelas');
        $input['updated_by'] = 1;

        $kelas->update($input);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id); // <-- ini diperbaiki
        $kelas->update(['deleted_by' => 1]);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
    }
}
