<?php

namespace App\Http\Controllers;

use App\Models\pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = pengumuman::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('file', function ($row) {
                    return "<a href='" . asset('storage/pengumuman/' . $row->file) . "' target='_blank'>Lihat File</a>";
                })
                ->addColumn('action', function ($row) {
                    $edit = route('pengumuman.edit', $row->id);
                    $show = route('pengumuman.show', $row->id);
                    $delete = route('pengumuman.destroy', $row->id);
                    return "
                        <a href='$show' class='btn btn-info btn-sm'>Lihat</a>
                        <a href='$edit' class='btn btn-warning btn-sm'>Edit</a>
                        <form action='$delete' method='POST' style='display:inline-block'>
                            " . csrf_field() . method_field('DELETE') . "
                            <button type='submit' onclick='return confirm(\"Yakin hapus?\")' class='btn btn-danger btn-sm'>Hapus</button>
                        </form>
                    ";
                })
                ->rawColumns(['action', 'file'])
                ->make(true);
        }

        return view('pengumuman.index');
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
        // dd($request->file('file'));
        $request->validate([
            'judul' => 'required|string',
            'desk' => 'required|string',
            'file' => 'required|max:5046',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/pengumuman', $fileName);

        Pengumuman::create([
            'judul' => $request->judul,
            'desk' => $request->desk,
            'file' => $fileName,
            'created_by' => 1,
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil disimpan.');
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('pengumuman.show', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string',
            'desk' => 'required|string',
            'file' => 'nullable|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'desk' => $request->desk,
            'updated_by' => 1,
        ];

        if ($request->hasFile('file')) {
            if ($pengumuman->file && Storage::exists('public/pengumuman/' . $pengumuman->file)) {
                Storage::delete('public/pengumuman/' . $pengumuman->file);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/pengumuman', $fileName);
            $data['file'] = $fileName;
        }

        $pengumuman->update($data);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->file && Storage::exists('public/pengumuman/' . $pengumuman->file)) {
            Storage::delete('public/pengumuman/' . $pengumuman->file);
        }

        $pengumuman->update(['deleted_by' => 1]);
        $pengumuman->delete();

        return back()->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function get_pengumuman_data(){
        try {
            $data = Pengumuman::all();
            return response()->json([
                'success'=> true,
                'message'=> "pengumuman get success",
                'data' => $data
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ],200);
        }
    }
}
