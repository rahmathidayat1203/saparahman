<?php

namespace App\Http\Controllers;

use App\Models\MasterAsas;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MasterAsasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterAsas::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('master-asas.edit', $row->id);
                    $show = route('master-asas.show', $row->id);
                    $delete = route('master-asas.destroy', $row->id);
                    return "
                        <a href='$show' class='btn btn-info btn-sm'>Lihat</a>
                        <a href='$edit' class='btn btn-warning btn-sm'>Edit</a>
                        <form action='$delete' method='POST' style='display:inline-block'>
                            " . csrf_field() . method_field('DELETE') . "
                            <button type='submit' onclick='return confirm(\"Yakin hapus?\")' class='btn btn-danger btn-sm'>Hapus</button>
                        </form>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('master_asas.index');
    }

    public function create()
    {
        return view('master_asas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_asas' => 'required|string|max:255',
        ]);

        MasterAsas::create([
            'nama_asas' => $request->nama_asas,
            'created_by' => 1,
        ]);

        return redirect()->route('master-asas.index')->with('success', 'Data Master Asas berhasil disimpan.');
    }

    public function show($id)
    {
        $masterAsas = MasterAsas::findOrFail($id);

        return view('master_asas.show', compact('masterAsas'));
    }

    public function edit($id)
    {
        $masterAsas = MasterAsas::findOrFail($id);
        return view('master_asas.edit', compact('masterAsas'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_asas' => 'required|string|max:255',
    ]);

    $masterAsas = MasterAsas::findOrFail($id);
    $masterAsas->update([
        'nama_asas' => $request->nama_asas,
        'updated_by' => 1, 
    ]);

    return redirect()->route('master-asas.index')->with('success', 'Data berhasil diperbarui.');
}


    public function destroy($id)
    {
        $masterAsas = MasterAsas::findOrFail($id);
        $masterAsas->update([
            'deleted_by' => 1, // Hardcode sementara
        ]);
        $masterAsas->delete();

        return redirect()->route('master-asas.index')->with('success', 'Asas berhasil dihapus.');
    }
}
