<?php

namespace App\Http\Controllers;

use App\Models\detail_ekskul_raport;
use App\Models\DetailNilaiRaport;
use App\Models\DetailRaportP5;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\mapel_kelas;
use App\Models\Master_Mapel;
use App\Models\orang_tua;
use App\Models\ortu_santri;
use App\Models\Raport;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $raports = Raport::with(['santri', 'guru', 'kelas'])->select('raports.*');

            return DataTables::of($raports)
                ->addIndexColumn()
                ->addColumn('nama_santri', function ($row) {
                    return $row->santri->nama_santri ?? '-';
                })
                ->addColumn('nama_guru', function ($row) {
                    return $row->guru->nama_guru ?? '-';
                })
                ->addColumn('nama_kelas', function ($row) {
                    return $row->kelas->nama_kelas ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('raport.edit', $row->id);
                    $deleteUrl = route('raport.destroy', $row->id);
                    $btn = "<a href='$editUrl' class='btn btn-primary btn-sm'>Edit</a> ";
                    $btn .= "<form action='$deleteUrl' method='POST' style='display:inline-block;'>"
                        . csrf_field() . method_field('DELETE') .
                        "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus?\")'>Hapus</button>
                    </form>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('raport.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $santris = Santri::all();
        $gurus = Guru::all();
        $kelas = Kelas::all();
        return view('raport.create', compact('santris', 'gurus', 'kelas')); // Tampilkan form untuk membuat raport
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'id_santri' => 'required|string',
            'id_guru' => 'required|string',
            'id_kelas' => 'required|string',
            'semester' => 'required|string',
        ]);

        // Menyimpan data raport baru
        Raport::create([
            'id_santri' => $request->id_santri,
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
            'semester' => $request->semester,
            'created_by' => 1, // Gunakan ID pengguna yang login
        ]);

        return redirect()->route('raport.index')->with('success', 'Raport created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil raport beserta relasi dengan santri, guru, dan kelas
        $raport = Raport::with(['santri', 'guru', 'kelas'])->findOrFail($id);

        return view('raport.show', compact('raport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Menemukan raport berdasarkan ID
        $raport = Raport::with(['santri', 'guru', 'kelas'])->findOrFail($id);

        // Mengambil data terkait untuk form dropdown
        $santris = Santri::all();
        $gurus = Guru::all();
        $kelas = Kelas::all();

        return view('raport.edit', compact('raport', 'santris', 'gurus', 'kelas')); // Tampilkan form untuk mengedit raport
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'id_santri' => 'required|string',
            'id_guru' => 'required|string',
            'id_kelas' => 'required|string',
            'semester' => 'required|string',
        ]);

        // Menemukan raport berdasarkan ID
        $raport = Raport::findOrFail($id);

        // Memperbarui data raport
        $raport->update([
            'id_santri' => $request->id_santri,
            'id_guru' => $request->id_guru,
            'id_kelas' => $request->id_kelas,
            'semester' => $request->semester,
            'updated_by' => 1, // Gunakan ID pengguna yang login
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('raport.index')->with('success', 'Raport updated successfully');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id)
    {
        // Menemukan raport berdasarkan ID
        $raport = Raport::findOrFail($id);

        // Menandai siapa yang menghapus raport
        $raport->deleted_by = 1;
        $raport->save();

        // Menghapus raport
        $raport->delete();

        return redirect()->route('raport.index')->with('success', 'Raport deleted successfully');
    }

    public function eraport(Request $request)
    {
        try {
            $user = $request->user();
            $orang_tuas = orang_tua::where('no_telepon', '=', $user->wa)->first();
            $orang_tua_santri = ortu_santri::where('id_ortu', '=', $orang_tuas->id)->get();
        } catch (\Exception $e) {
        }
    }


    public function get_kelas()
    {
        try {
            $kelas = Kelas::all();
            return response()->json([
                'success' => true,
                'message' => "success get data",
                'data' => $kelas
            ], 200);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function get_all_mapel(Request $request)
    {
        try {
            $user = $request->user();

            // Cari orang tua berdasarkan nomor WhatsApp
            $orang_tua = orang_tua::where('no_telepon', $user->no_wa)->first();

            if (!$orang_tua) {
                return response()->json([
                    'success' => false,
                    'message' => 'Orang tua tidak ditemukan',
                    'data' => null
                ], 404);
            }

            // Ambil relasi ortu_santri
            $ortu_santri = ortu_santri::where('id_ortu', $orang_tua->id)->first();


            if (!$ortu_santri) {
                return response()->json([
                    'success' => false,
                    'message' => 'Santri terkait tidak ditemukan',
                    'data' => null
                ], 404);
            }

            $raport = Raport::with(['santri', 'guru', 'kelas'])
                ->where('id_santri', $ortu_santri->id_santri)
                ->get()
                ->map(function ($item) {

                    // Ambil semua detail nilai untuk raport ini
                    $detail_nilai = DetailNilaiRaport::where('id_raport', $item->id)->get();

                    // Ambil data nama mapel dan nilai
                    $mapel = $detail_nilai->map(function ($nilai) {
                        $nama_mapel = Master_Mapel::find($nilai->id_mapel)->nama_mapel ?? null;

                        return [
                            'id' => $nilai->id,
                            'nama_mapel' => $nama_mapel,
                            'nilai' => $nilai->nilai
                        ];
                    });

                    // Ambil data ekskul dan relasi nama ekskul
                    $detail_ekskul = detail_ekskul_raport::where('id_raport', $item->id)
                        ->with('ekskul')
                        ->get()
                        ->map(function ($ekskul_item) {
                            return [
                                'nama_ekskul' => $ekskul_item->ekskul->nama_ekskul ?? null,
                                'nilai' => $ekskul_item->nilai,
                            ];
                        });
                    $p5_item = DetailRaportP5::where('id_raport', $item->id)->first();

                    $p5 = $p5_item ? [
                        'judul' => $p5_item->judul,
                        'foto' => $p5_item->foto,
                        'desk' => $p5_item->desk,
                    ] : null;
                    // Log hasil jika diperlukan

                    return [
                        'id' => $item->id,
                        'semester' => $item->semester,
                        'nama_santri' => $item->santri->nama_santri ?? null,
                        'nama_guru' => $item->guru->username ?? null,
                        'kelas' => $item->kelas->tingkat_kelas ?? null,
                        'mapel' => $mapel,
                        'ekskul' => $detail_ekskul,
                        'p5' => $p5,
                    ];
                });

            Log::info($raport);

            return response()->json([
                'success' => true,
                'message' => 'Data raport berhasil diambil',
                'data' => $raport
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
