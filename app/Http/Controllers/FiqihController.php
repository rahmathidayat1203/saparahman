<?php

namespace App\Http\Controllers;

use App\Models\Fiqih;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FiqihController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Fiqih::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('fiqih.edit', $row->id);
                    $show = route('fiqih.show', $row->id);
                    $delete = route('fiqih.destroy', $row->id);
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

        return view('fiqih.index');
    }

    public function create()
    {
        return view('fiqih.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_fiqih' => 'required|string|max:255',
        ]);

        Fiqih::create([
            'jenis_fiqih' => $request->jenis_fiqih,
            'created_by' => 1,
        ]);

        return redirect()->route('fiqih.index')->with('success', 'Data berhasil disimpan.');
    }

    public function show(Fiqih $fiqih)
    {
        return view('fiqih.show', compact('fiqih'));
    }

    public function edit($id)
    {
        $fiqih = Fiqih::findOrFail($id);
        return view('fiqih.edit', compact('fiqih'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_fiqih' => 'required|string|max:255',
        ]);

        $fiqih = Fiqih::findOrFail($id);
        $fiqih->update([
            'jenis_fiqih' => $request->jenis_fiqih,
            'updated_by' => 1,
        ]);

        return redirect()->route('fiqih.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $fiqih = Fiqih::findOrFail($id);
        $fiqih->update(['deleted_by' => 1]);
        $fiqih->delete();

        return redirect()->route('fiqih.index')->with('success', 'Data berhasil dihapus.');
    }

    public function get_all(){
        
    }
}
