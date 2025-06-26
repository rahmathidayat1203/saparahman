<?php

namespace App\Http\Controllers;

use App\Models\DetailNilaiRaport;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Raport;
use App\Models\Mapel; // Asumsi bahwa model Mapel sudah ada
use App\Models\mapel_kelas;
use App\Models\Master_Mapel;
use App\Models\Santri;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DetailNilaiRaportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $detailNilaiRaports = DetailNilaiRaport::select('*'); // Pilih kolom yang diperlukan

            return DataTables::of($detailNilaiRaports)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Menambahkan kolom action untuk tombol Edit dan Delete
                    $editUrl = route('detail-nilai-raport.edit', $row->id);
                    $deleteUrl = route('detail-nilai-raport.destroy', $row->id);
                    $btn = "<a href='$editUrl' class='btn btn-primary btn-sm'>Edit</a> ";
                    $btn .= "<form action='$deleteUrl' method='POST' style='display:inline-block;'>"
                        . csrf_field() . method_field('DELETE') .
                        "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus?\")'>Hapus</button>
                            </form>";
                    return $btn;
                })->addColumn('raport_santri', function ($row) {
                    return $row->raport->santri->nama_santri;
                })->addColumn('mapel', function ($row) {
                    return $row->mapel->nama_mapel;
                })
                ->rawColumns(['action']) // Mengatur kolom action agar bisa dirender sebagai HTML
                ->make(true);
        }

        return view('detail-nilai-raport.index'); // Tampilkan view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $raports = Raport::with('santri')->get(); // Mengambil semua data raport
        $mapels = Master_Mapel::all(); // Mengambil semua data mapel

        foreach ($raports as $raport) {
            // dd($raport->santri->nama_santri);
        }

        return view('detail-nilai-raport.create', compact('raports', 'mapels')); // Tampilkan form untuk membuat detail nilai raport
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'id_raport' => 'required|string',
            'id_mapel' => 'required|string',
            'nilai' => 'required|string',
            'desk' => 'required|string',
        ]);

        // Menyimpan data detail nilai raport baru
        DetailNilaiRaport::create([
            'id_raport' => $request->id_raport,
            'id_mapel' => $request->id_mapel,
            'nilai' => $request->nilai,
            'desk' => $request->desk,
            'created_by' => 1, // Gunakan ID pengguna yang login
        ]);

        return redirect()->route('detail-nilai-raport.index')->with('success', 'Detail Nilai Raport created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil detail nilai raport beserta relasi dengan raport dan mapel
        $detailNilaiRaport = DetailNilaiRaport::with(['raport', 'mapel'])->findOrFail($id);

        return view('detail-nilai-raport.show', compact('detailNilaiRaport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Menemukan detail nilai raport berdasarkan ID
        $detailNilaiRaport = DetailNilaiRaport::findOrFail($id);

        // Mengambil data yang dibutuhkan
        $raports = Raport::all(); // Mengambil semua data raport
        $mapels = Master_Mapel::all(); // Mengambil semua data mapel
        $santris = Santri::all(); // Mengambil semua data santri
        $gurus = Guru::all(); // Mengambil semua data guru (asumsi ada model Guru)
        $kelas = Kelas::all(); // Mengambil semua data kelas (asumsi ada model Kelas)

        // Mengirim data ke view
        return view('detail-nilai-raport.edit', compact('detailNilaiRaport', 'raports', 'mapels', 'santris', 'gurus', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'id_raport' => 'required|string',
            'id_mapel' => 'required|string',
            'nilai' => 'required|string',
            'desk' => 'required|string',
        ]);

        // Menemukan detail nilai raport berdasarkan ID
        $detailNilaiRaport = DetailNilaiRaport::findOrFail($id);

        // Memperbarui data detail nilai raport
        $detailNilaiRaport->update([
            'id_raport' => $request->id_raport,
            'id_mapel' => $request->id_mapel,
            'nilai' => $request->nilai,
            'desk' => $request->desk,
            'updated_by' => 1, // Gunakan ID pengguna yang login
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('detail-nilai-raport.index')->with('success', 'Detail Nilai Raport updated successfully');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id)
    {
        // Menemukan detail nilai raport berdasarkan ID
        $detailNilaiRaport = DetailNilaiRaport::findOrFail($id);

        // Menandai siapa yang menghapus detail nilai raport
        $detailNilaiRaport->deleted_by = 1;
        $detailNilaiRaport->save();

        // Menghapus detail nilai raport
        $detailNilaiRaport->delete();

        return redirect()->route('detail-nilai-raport.index')->with('success', 'Detail Nilai Raport deleted successfully');
    }
}
