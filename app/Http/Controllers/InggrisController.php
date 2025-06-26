<?php

namespace App\Http\Controllers;

use App\Models\Inggris;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InggrisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Inggris::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('inggris.edit', $row->id);
                    $show = route('inggris.show', $row->id);
                    $delete = route('inggris.destroy', $row->id);
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

        return view('inggris.index');
    }

    public function create()
    {
        return view('inggris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subjek' => 'required|string|max:255',
        ]);

        Inggris::create([
            'subjek' => $request->subjek,
            'created_by' => 1,
        ]);

        return redirect()->route('inggris.index')->with('success', 'Data berhasil disimpan.');
    }

    public function show(Inggris $inggris)
    {
        return view('inggris.show', compact('inggris'));
    }

    public function edit($id)
    {
        $inggris = Inggris::findOrFail($id);
        return view('inggris.edit', compact('inggris'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'subjek' => 'required|string|max:255',
        ]);
        $inggris = Inggris::findOrFail($id);
        $inggris->update([
            'subjek' => $request->subjek,
            'updated_by' => 1,
        ]);

        return redirect()->route('inggris.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $inggris = Inggris::findOrFail($id);
        $inggris->update(['deleted_by' => 1]);
        $inggris->delete();

        return redirect()->route('inggris.index')->with('success', 'Data berhasil dihapus.');
    }
}
