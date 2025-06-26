<?php

namespace App\Http\Controllers;

use App\Models\HafalanArab;
use App\Models\Santri;
use App\Models\Arab;
use App\Models\orang_tua;
use App\Models\ortu_santri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HafalanArabController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HafalanArab::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('santri', fn($row) => $row->santri->nama_santri ?? '-')
                ->addColumn('arab', fn($row) => $row->arab->subjek ?? '-')
                ->addColumn('action', function ($row) {
                    $edit = route('hafalan-arab.edit', $row->id);
                    $delete = route('hafalan-arab.destroy', $row->id);
                    return "
                        <a href='$edit' class='btn btn-primary btn-sm'>Edit</a>
                        <form action='$delete' method='POST' style='display:inline-block'>
                            " . csrf_field() . method_field('DELETE') . "
                            <button type='submit' onclick='return confirm(\"Yakin hapus?\")' class='btn btn-danger btn-sm'>Hapus</button>
                        </form>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('hafalan_arab.index');
    }

    public function create()
    {
        $santriList = Santri::all();
        $arabList = Arab::all();
        $nilaiOptions = ['A', 'B', 'C', 'D'];
        return view('hafalan_arab.create', compact('santriList', 'arabList', 'nilaiOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_santri' => 'required',
            'id_arab' => 'required',
            'tgl_setoran' => 'required|date',
            'nilai' => 'required|in:A,B,C,D',
        ]);

        $validated['created_by'] = 1;

        HafalanArab::create($validated);

        return redirect()->route('hafalan-arab.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $hafalanArab = HafalanArab::findOrFail($id);
        $santriList = Santri::all();
        $arabList = Arab::all();
        $nilaiOptions = ['A', 'B', 'C', 'D'];
        return view('hafalan_arab.edit', compact('hafalanArab', 'santriList', 'arabList', 'nilaiOptions'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_santri' => 'required',
            'id_arab' => 'required',
            'tgl_setoran' => 'required|date',
            'nilai' => 'required|in:A,B,C,D',
        ]);

        $validated['updated_by'] = 1;
        $hafalanArab = HafalanArab::findOrFail($id);
        $hafalanArab->update($validated);

        return redirect()->route('hafalan-arab.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = HafalanArab::findOrFail($id);
        $data->deleted_by = 1;
        $data->save();
        $data->delete();

        return redirect()->route('hafalan-arab.index')->with('success', 'Data berhasil dihapus');
    }
    public function getBySantri(Request $request)
    {
        try {
            $user = $request->user();
            $ortu = orang_tua::where('no_telepon', $user->no_wa)->first();
            $ortu_santri = ortu_santri::where('id_ortu', $ortu->id)->first();

            $hafalan = HafalanArab::with(['santri', 'arab'])
                ->where('id_santri', $ortu_santri->id_santri)
                ->get();

            $data = $hafalan->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->arab ? $item->arab->subjek : null,
                    'tgl_setoran' => $item->tgl_setoran,
                    'nilai' => $item->nilai,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => "Data hafalan fiqih berhasil diambil",
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
