<?php

namespace App\Http\Controllers;

use App\Models\Master_Mapel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MasterMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $master__mapel = Master_Mapel::query();
            return DataTables::of($master__mapel)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('master_mapel.edit', $row) . '" class="btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="' . route('master_mapel.show', $row) . '" class="btn btn-info btn-sm">Show</a>';
                    $btn .= ' <form action="' . route('master_mapel.destroy', $row) . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Yakin ingin hapus?\')">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('master_mapel.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master_mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_mapel' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->only('nama_mapel');
        $input['created_by'] = Auth::id() ?? 1;

        Master_Mapel::create($input);

        return redirect()->route('master_mapel.index')->with('success', 'Master Mapel berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $master__mapel = Master_Mapel::findOrFail($id);
        return view('master_mapel.show', compact('master__mapel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $master__mapel = Master_Mapel::findOrFail($id);
        return view('master_mapel.edit', compact('master__mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel'  => 'required'
        ]);
        $master__mapel = Master_Mapel::findOrFail($id);

        $data = $request->only(['nama_mapel']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        $data['updated_by'] = 1;

        $master__mapel->update($data);

        return redirect()->route('master_mapel.index')->with('success', 'Data guru berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $master__mapel = Master_Mapel::findOrFail($id);

        $master__mapel->update(['deleted_by' => Auth::id() ?? 1]);
        $master__mapel->delete();

        return redirect()->route('master_mapel.index')->with('success', 'Master Mapel berhasil dihapus');
    }
}
