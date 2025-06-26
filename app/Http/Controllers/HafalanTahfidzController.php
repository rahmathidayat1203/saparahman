<?php

namespace App\Http\Controllers;

use App\Models\HafalanTahfidz;
use App\Models\orang_tua;
use App\Models\ortu_santri;
use App\Models\Santri;
use App\Models\Tahfidz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class HafalanTahfidzController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HafalanTahfidz::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('santri', function ($row) {
                    return $row->santri->nama_santri ?? "N\A";
                })
                ->addColumn('tahfidz', function ($row) {
                    return $row->tahfidz->jenis_tahfidz;
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="' . route('hafalan-tahfidz.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>';
                    $deleteBtn = '<form action="' . route('hafalan-tahfidz.destroy', $row->id) . '" method="POST" style="display:inline-block;">'
                        . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</button>'
                        . '</form>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('hafalan_tahfidz.index');
    }

    public function create()
    {
        $santriList = Santri::all();
        $tahfidzList = Tahfidz::all();
        $nilaiOptions = ['A', 'B', 'C', 'D'];

        return view('hafalan_tahfidz.create', compact('santriList', 'tahfidzList', 'nilaiOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_santri' => 'required|exists:santris,id',
            'id_tahfidz' => 'required|exists:tahfidz,id',
            'tgl_setoran' => 'required|date',
            'nilai' => 'required|in:A,B,C,D',
        ]);

        $validated['created_by'] = 1;

        HafalanTahfidz::create($validated);

        return redirect()->route('hafalan-tahfidz.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(HafalanTahfidz $hafalanTahfidz)
    {
        $santriList = Santri::all();
        $tahfidzList = Tahfidz::all();
        $nilaiOptions = ['A', 'B', 'C', 'D'];

        return view('hafalan_tahfidz.edit', compact('hafalanTahfidz', 'santriList', 'tahfidzList', 'nilaiOptions'));
    }

    public function update(Request $request, HafalanTahfidz $hafalanTahfidz)
    {
        $validated = $request->validate([
            'id_santri' => 'required|exists:santris,id',
            'id_tahfidz' => 'required|exists:tahfidz,id',
            'tgl_setoran' => 'required|date',
            'nilai' => 'required|in:A,B,C,D',
        ]);

        $validated['updated_by'] = 1;

        $hafalanTahfidz->update($validated);

        return redirect()->route('hafalan-tahfidz.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = HafalanTahfidz::findOrFail($id);
        $data->deleted_by = 1;
        $data->save();
        $data->delete();

        return redirect()->route('hafalan-tahfidz.index')->with('success', 'Data berhasil dihapus');
    }

    public function getBySantri(Request $request)
    {
        try {
            $user = $request->user();
            $ortu = orang_tua::where('no_telepon', $user->no_wa)->first();
            $ortu_santri = ortu_santri::where('id_ortu', $ortu->id)->first();

            $hafalan = HafalanTahfidz::with(['santri', 'tahfidz'])
                ->where('id_santri', $ortu_santri->id_santri)
                ->get();

            $data = $hafalan->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_surah' => $item->tahfidz ? $item->tahfidz->jenis_tahfidz : null,
                    'arti' => $item->tahfidz ? $item->tahfidz->arti : null,
                    'tgl_setoran' => $item->tgl_setoran,
                    'nilai' => $item->nilai,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => "Data hafalan tahfidz berhasil diambil",
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
