<?php

namespace App\Http\Controllers;

use App\Models\orang_tua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OrangTuaController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = orang_tua::whereNull('deleted_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('orangtua.edit', $row->id);
                    $deleteUrl = route('orangtua.destroy', $row->id);
                    $btn = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a> ';
                    $btn .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin mau hapus?\')">Hapus</button>
                            </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('orangtua.index');
    }

    public function create()
    {
        return view('orangtua.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ortu'  => 'required|string|max:255',
            'no_kk' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        orang_tua::create([
            'nama_ortu' => $request->nama_ortu,
            'no_kk' => $request->no_kk,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
            'created_by' => 1,
        ]);

        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil ditambahkan.');
    }

    public function show(orang_tua $orangtua)
    {
        return view('orangtua.show', compact('orangtua'));
    }

    public function edit(orang_tua $orangtua)
    {
        return view('orangtua.edit', compact('orangtua'));
    }

    public function update(Request $request, orang_tua $orangtua)
    {
        $validator = Validator::make($request->all(), [
            'nama_ortu'  => 'required|string|max:255',
            'no_kk' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $orangtua->update([
            'nama_ortu' => $request->nama_ortu,
            'no_kk' => $request->no_kk,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
            'updated_by' => 1,
        ]);

        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil diupdate.');
    }

    public function destroy(orang_tua $orangtua)
    {
        $orangtua->update([
            'deleted_by' => 1,
        ]);
        $orangtua->delete();

        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil dihapus.');
    }
}
