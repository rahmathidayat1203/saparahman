<?php

namespace App\Http\Controllers;

use App\Models\Arab;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ArabController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Arab::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('arab.edit', $row->id);
                    $show = route('arab.show', $row->id);
                    $delete = route('arab.destroy', $row->id);
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

        return view('arab.index');
    }

    public function create()
    {
        return view('arab.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subjek' => 'required|string|max:255',
        ]);

        Arab::create([
            'subjek' => $request->subjek,
            'created_by' => 1,
        ]);

        return redirect()->route('arab.index')->with('success', 'Data berhasil disimpan.');
    }

    public function show(Arab $arab)
    {
        return view('arab.show', compact('arab'));
    }

    public function edit($id)
    {
        $arab = Arab::findOrFail($id);
        return view('arab.edit', compact('arab'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subjek' => 'required|string|max:255',
        ]);

        $arab = Arab::findOrFail($id);
        $arab->update([
            'subjek' => $request->subjek,
            'updated_by' => 1,
        ]);

        return redirect()->route('arab.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $arab = Arab::findOrFail($id);
        $arab->update(['deleted_by' => 1]);
        $arab->delete();

        return redirect()->route('arab.index')->with('success', 'Data berhasil diperbarui');
    }
}
