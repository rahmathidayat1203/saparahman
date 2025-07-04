<?php

namespace App\Http\Controllers;

use App\Models\tahfidz;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TahfidzController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = tahfidz::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('tahfidz.edit', $row->id);
                    $show = route('tahfidz.show', $row->id);
                    $delete = route('tahfidz.destroy', $row->id);
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

        return view('tahfidz.index');
    }

    public function create()
    {
        return view('tahfidz.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_tahfidz' => 'required|string',
            'arti' => 'required|string',
            'juz_ayat' => 'required|string',
        ]);

        tahfidz::create([
            'jenis_tahfidz' => $request->jenis_tahfidz,
            'arti' => $request->arti,
            'juz_ayat' => $request->juz_ayat,
            'created_by' => 1,
        ]);

        return redirect()->route('tahfidz.index')->with('success', 'Data tahfidz berhasil disimpan.');
    }

    public function show(tahfidz $tahfidz)
    {
        return view('tahfidz.show', compact('tahfidz'));
    }

    public function edit(tahfidz $tahfidz)
    {
        return view('tahfidz.edit', compact('tahfidz'));
    }

    public function update(Request $request, tahfidz $tahfidz)
    {
        $request->validate([
            'jenis_tahfidz' => 'required|string',
            'arti' => 'required|string',
            'juz_ayat' => 'required|string',
        ]);

        $tahfidz->update([
            'jenis_tahfidz' => $request->jenis_tahfidz,
            'arti' => $request->arti,
            'juz_ayat' => $request->juz_ayat,
            'updated_by' => 1,
        ]);

        return redirect()->route('tahfidz.index')->with('success', 'Data tahfidz berhasil diperbarui.');
    }

    public function destroy(tahfidz $tahfidz)
    {
        $tahfidz->update(['deleted_by' => 1]);
        $tahfidz->delete();

        return redirect()->route('tahfidz.index')->with('success', 'Data tahfidz berhasil dihapus.');
    }
}
