<?php

namespace App\Http\Controllers;

use App\Models\Master_Ekskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MasterEkskulController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Master_Ekskul::whereNull('deleted_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="'.route('master_ekskul.edit', $row->id).'" class="edit btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<form action="'.route('master_ekskul.destroy', $row->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin?\')">Hapus</button>
                            </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('master_ekskul.index');
    }

    public function create()
    {
        return view('master_ekskul.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ekskul' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Master_Ekskul::create([
            'nama_ekskul' => $request->nama_ekskul,
            'created_by' => 1, // Hardcode sementara
        ]);

        return redirect()->route('master_ekskul.index')->with('success', 'Ekskul berhasil ditambahkan.');
    }

    public function show(Master_Ekskul $master_ekskul)
    {
        return view('master_ekskul.show', compact('master_ekskul'));
    }

    public function edit(Master_Ekskul $master_ekskul)
    {
        return view('master_ekskul.edit', compact('master_ekskul'));
    }

    public function update(Request $request, Master_Ekskul $master_ekskul)
    {
        $validator = Validator::make($request->all(), [
            'nama_ekskul' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $master_ekskul->update([
            'nama_ekskul' => $request->nama_ekskul,
            'updated_by' => 1, // Hardcode sementara
        ]);

        return redirect()->route('master_ekskul.index')->with('success', 'Ekskul berhasil diupdate.');
    }

    public function destroy(Master_Ekskul $master_ekskul)
    {
        $master_ekskul->update([
            'deleted_by' => 1, // Hardcode sementara
        ]);
        $master_ekskul->delete();

        return redirect()->route('master_ekskul.index')->with('success', 'Ekskul berhasil dihapus.');
    }
}
