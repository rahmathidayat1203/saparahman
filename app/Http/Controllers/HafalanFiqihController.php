<?php

namespace App\Http\Controllers;

use App\Models\HafalanFiqih;
use App\Models\Santri;
use App\Models\Fiqih;
use App\Models\orang_tua;
use App\Models\ortu_santri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HafalanFiqihController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HafalanFiqih::with(['santri', 'fiqih'])->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('santri', fn($row) => $row->santri->nama_santri ?? '-')
                ->addColumn('fiqih', fn($row) => $row->fiqih->jenis_fiqih ?? '-')
                ->addColumn('action', function ($row) {
                    $edit = route('hafalan-fiqih.edit', $row->id);
                    $delete = route('hafalan-fiqih.destroy', $row->id);
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

        return view('hafalan_fiqih.index');
    }

    public function create()
    {
        $santriList = Santri::all();
        $fiqihList = Fiqih::all();
        $nilaiOptions = ['A', 'B', 'C', 'D'];
        return view('hafalan_fiqih.create', compact('santriList', 'fiqihList', 'nilaiOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_santri' => 'required',
            'id_fiqih' => 'required',
            'tgl_setoran' => 'required|date',
            'nilai' => 'required|in:A,B,C,D',
        ]);

        $validated['created_by'] = 1;

        HafalanFiqih::create($validated);

        return redirect()->route('hafalan-fiqih.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $hafalanFiqih = HafalanFiqih::findOrFail($id);
        $santriList = Santri::all();
        $fiqihList = Fiqih::all();
        $nilaiOptions = ['A', 'B', 'C', 'D'];
        return view('hafalan_fiqih.edit', compact('hafalanFiqih', 'santriList', 'fiqihList', 'nilaiOptions'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_santri' => 'required',
            'id_fiqih' => 'required',
            'tgl_setoran' => 'required|date',
            'nilai' => 'required|in:A,B,C,D',
        ]);

        $validated['updated_by'] = 1;
        $hafalanFiqih = HafalanFiqih::findOrFail($id);
        $hafalanFiqih->update($validated);

        return redirect()->route('hafalan-fiqih.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = HafalanFiqih::findOrFail($id);
        $data->deleted_by = 1;
        $data->save();
        $data->delete();

        return redirect()->route('hafalan-fiqih.index')->with('success', 'Data berhasil dihapus');
    }
    public function getBySantri(Request $request)
    {
        try {
            $user = $request->user();
            $ortu = orang_tua::where('no_telepon', $user->no_wa)->first();
            $ortu_santri = ortu_santri::where('id_ortu', $ortu->id)->first();

            $hafalan = HafalanFiqih::with(['santri', 'fiqih'])
                ->where('id_santri', $ortu_santri->id_santri)
                ->get();

            $data = $hafalan->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_fiqih' => $item->fiqih ? $item->fiqih->jenis_fiqih : null,
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
