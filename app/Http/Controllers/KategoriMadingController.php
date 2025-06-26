<?php

namespace App\Http\Controllers;

use App\Models\KategoriMading;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriMadingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = KategoriMading::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('kategori-mading.edit', $row->id);
                    $show = route('kategori-mading.show', $row->id);
                    $delete = route('kategori-mading.destroy', $row->id);
                    return "
                        <a href='$show' class='btn btn-info btn-sm'>Lihat</a>
                        <a href='$edit' class='btn btn-warning btn-sm'>Edit</a>
                        <form action='$delete' method='POST' style='display:inline-block' class='delete-form'>
                            " . csrf_field() . method_field('DELETE') . "
                            <button type='submit' onclick='return confirm(\"Yakin hapus?\")' class='btn btn-danger btn-sm'>Hapus</button>
                        </form>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kategori_mading.index');
    }

    public function create()
    {
        return view('kategori_mading.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        KategoriMading::create([
            'kategori' => $request->kategori,
            'created_by' => 1, // Sementara
        ]);

        return redirect()->route('kategori-mading.index')->with('success', 'Kategori Mading berhasil disimpan.');
    }

    public function show($id)
    {
        $kategoriMading = KategoriMading::findOrFail($id);
        return view('kategori_mading.show', compact('kategoriMading'));
    }

    public function edit($id)
    {
        $kategoriMading = KategoriMading::findOrFail($id);
        return view('kategori_mading.edit', compact('kategoriMading'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        $kategoriMading = KategoriMading::findOrFail($id);
        $kategoriMading->update([
            'kategori' => $request->kategori,
            'updated_by' => 1,
        ]);

        return redirect()->route('kategori-mading.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategoriMading = KategoriMading::findOrFail($id);
        $kategoriMading->update(['deleted_by' => 1]);
        $kategoriMading->delete();

        return redirect()->route('kategori-mading.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
