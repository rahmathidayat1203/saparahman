<?php

namespace App\Http\Controllers;

use App\Models\DetailRaportP5;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Raport;
use App\Models\Santri;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DetailRaportP5Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $details = DetailRaportP5::select('id', 'id_raport', 'judul', 'foto', 'desk')->with('raport.santri');

            return DataTables::of($details)
                ->addIndexColumn()

                // Tambahkan kolom nama santri jika perlu
                ->addColumn('raport_santri', function ($row) {
                    return $row->raport && $row->raport->santri ? $row->raport->santri->nama_santri : '-';
                })

                // Render kolom foto sebagai <img>
                ->editColumn('foto', function ($row) {
                    if ($row->foto) {
                        $url = asset('storage/' . $row->foto);
                        return '<img src="' . $url . '" width="80" class="img-thumbnail" />';
                    }
                    return '-';
                })

                // Kolom aksi edit & delete
                ->addColumn('action', function ($row) {
                    $editUrl = route('detail-raport-p5.edit', $row->id);
                    $deleteUrl = route('detail-raport-p5.destroy', $row->id);
                    $btn = "<a href='$editUrl' class='btn btn-primary btn-sm'>Edit</a> ";
                    $btn .= "<form action='$deleteUrl' method='POST' style='display:inline-block;'>"
                        . csrf_field() . method_field('DELETE') . "
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus?\")'>Hapus</button>
                    </form>";
                    return $btn;
                })

                ->rawColumns(['foto', 'action']) // penting agar <img> & tombol dirender sebagai HTML
                ->make(true);
        }

        $raports = Raport::all();
        return view('detail_raport_p5.index', compact('raports'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $raports = Raport::all();
        return view('detail_raport_p5.create', compact('raports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_raport' => 'required|string',
            'judul' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desk' => 'required|string',
        ]);

        // dd($request->foto);

        // Simpan file foto ke folder 'foto-p5' di storage/app/public
        $fotoPath = $request->file('foto')->store('foto-p5', 'public');

        DetailRaportP5::create([
            'id_raport' => $request->id_raport,
            'judul' => $request->judul,
            'foto' => $fotoPath, // hanya path-nya yang disimpan di DB
            'desk' => $request->desk,
            'created_by' => 1, // gunakan ID user login, default 1
        ]);

        return redirect()->route('detail-raport-p5.index')->with('success', 'Detail Raport P5 created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detail = DetailRaportP5::findOrFail($id);
        return view('detail_raport_p5.show', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $raport = Raport::findOrFail($id);         // Ambil data raport berdasarkan ID
        $santris = Santri::all();                  // Ambil semua santri
        $gurus = Guru::all();                      // Ambil semua guru
        $kelas = Kelas::all();                     // Ambil semua kelas

        return view('raport.edit', compact('raport', 'santris', 'gurus', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_raport' => 'required|string',
            'judul' => 'required|string',
            'foto' => 'required|string',
            'desk' => 'required|string',
        ]);

        $detail = DetailRaportP5::findOrFail($id);

        $detail->update([
            'id_raport' => $request->id_raport,
            'judul' => $request->judul,
            'foto' => $request->foto,
            'desk' => $request->desk,
            'updated_by' => 1, // ganti sesuai ID user login
        ]);

        return redirect()->route('detail-raport-p5.index')->with('success', 'Detail Raport P5 updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detail = DetailRaportP5::findOrFail($id);
        $detail->deleted_by = 1; // ganti sesuai ID user login
        $detail->save();
        $detail->delete();

        return redirect()->route('detail-raport-p5.index')->with('success', 'Detail Raport P5 deleted successfully');
    }
}
