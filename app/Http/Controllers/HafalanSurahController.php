<?php

namespace App\Http\Controllers;

use App\Models\HafalanSurah;
use App\Models\orang_tua;
use App\Models\ortu_santri;
use App\Models\Santri;
use App\Models\Surah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class HafalanSurahController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HafalanSurah::select('*')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('santri', function ($row) {
                    return $row->santri->nama_santri ?? '-';
                })
                ->addColumn('surah', function ($row) {
                    return $row->surah->nama_surah ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="' . route('hafalan-surah.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger" onclick="deleteData(' . $row->id . ')">Hapus</button>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('hafalan_surah.index');
    }

    public function create()
    {
        $santriList = Santri::all();
        $surahList = Surah::all();
        $nilaiOptions = ['A', 'B', 'C', 'D'];
        return view('hafalan_surah.create', compact('santriList', 'surahList', 'nilaiOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_santri' => 'required',
            'id_surah' => 'required',
            'tgl_setoran' => 'required|date',
            'nilai' => 'required||in:A,B,C,D',
        ]);

        $validated['created_by'] = 1;

        HafalanSurah::create($validated);

        return redirect()->route('hafalan-surah.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(HafalanSurah $hafalanSurah)
    {
        $santriList = Santri::all();
        $surahList = Surah::all();
        $nilaiOptions = ['A', 'B', 'C', 'D'];
        return view('hafalan_surah.edit', compact('hafalanSurah', 'santriList', 'surahList', 'nilaiOptions'));
    }

    public function update(Request $request, HafalanSurah $hafalanSurah)
    {
        $validated = $request->validate([
            'id_santri' => 'required',
            'id_surah' => 'required|exists:surah,id',
            'tgl_setoran' => 'required|date',
            'nilai' => 'required|in:A,B,C,D',
        ]);

        $validated['updated_by'] = 1;

        $hafalanSurah->update($validated);

        return redirect()->route('hafalan-surah.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = HafalanSurah::findOrFail($id);
        $data->deleted_by = 1;
        $data->save();
        $data->delete();

        return redirect()->route('hafalan-surah.index')->with('success', 'Data berhasil diperbarui');
    }

    public function getBySantri(Request $request)
    {
        try {
            $user = $request->user();

            $ortu = orang_tua::where('no_telepon', $user->no_wa)->first();
            $ortu_santri = ortu_santri::where('id_ortu', $ortu->id)->first();

            $data = HafalanSurah::with('surah')
                ->where('id_santri', $ortu_santri->id_santri)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama_surah' => $item->surah->nama_surah ?? '-',
                        'nilai' => $item->nilai,
                        'tanggal_setoran' => $item->tgl_setoran,
                        'jumlah_ayat' => $item->surah->jml_ayat,
                        'arti_surah' => $item->surah->arti_surah
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => "hafalan surah get success",
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 200);
        }
    }
}
