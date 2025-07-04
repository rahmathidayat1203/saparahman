<?php

namespace App\Http\Controllers;

use App\Models\KandunganMading;
use App\Models\Mading;
use App\Models\MasterAsas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class KandunganMadingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = KandunganMading::with('asas')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_asas', function ($row) {
                    return $row->asas ? $row->asas->nama_asas : '-';
                })
                ->addColumn('pdf_file', function ($row) {
                    return $row->pdf
                        ? '<a href="' . asset("/storage/{$row->pdf}") . '" target="_blank" class="btn btn-primary btn-sm">Lihat PDF</a>'
                        : '-';
                })
                ->addColumn('png_file', function ($row) {
                    return $row->file
                        ? '<a href="' . asset("/storage/{$row->file}") . '" target="_blank">Lihat Gambar</a>'
                        : '-';
                })
                ->addColumn('action', function ($row) {
                    $edit = route('kandungan-mading.edit', $row->id);
                    $show = route('kandungan-mading.show', $row->id);
                    $delete = route('kandungan-mading.destroy', $row->id);
                    return "
                    <a href='$show' class='btn btn-info btn-sm'>Lihat</a>
                    <a href='$edit' class='btn btn-warning btn-sm'>Edit</a>
                    <form action='$delete' method='POST' style='display:inline-block' class='delete-form'>
                        " . csrf_field() . method_field('DELETE') . "
                        <button type='submit' onclick='return confirm(\"Yakin hapus?\")' class='btn btn-danger btn-sm'>Hapus</button>
                    </form>
                ";
                })
                ->rawColumns(['pdf_file', 'png_file', 'action'])
                ->make(true);
        }

        return view('kandungan_mading.index');
    }


    public function create()
    {
        $mading = Mading::all();
        $asass = MasterAsas::all();
        return view('kandungan_mading.create', compact('asass', 'mading'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_asas' => 'required|exists:master_asas,id',
            'nama_pengampu' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'pdf_file' => 'required|file|mimes:pdf|max:2048', // PDF wajib, maks 2MB
            'png_file' => 'nullable', // PNG opsional, maks 2MB
            'desk' => 'required|string',
        ]);

        // Simpan file PDF
        $pdfPath = $request->file('pdf_file')->store('kandungan_mading_files', 'public');

        // Simpan file PNG (jika ada)
        $pngPath = null;
        if ($request->hasFile('png_file')) {
            $pngPath = $request->file('png_file')->store('kandungan_mading_files', 'public');
        }

        // Simpan data ke database
        KandunganMading::create([
            'id_asas' => $request->id_asas,
            'nama_pengampu' => $request->nama_pengampu,
            'judul' => $request->judul,
            'pdf' => $pdfPath, // Simpan path PDF
            'file' => $pngPath, // Simpan path PNG (bisa null)
            'desk' => $request->desk,
            'created_by' => 1, // Sementara, ganti dengan auth()->id() jika menggunakan autentikasi
        ]);

        return redirect()->route('kandungan-mading.index')->with('success', 'Kandungan Mading berhasil disimpan.');
    }

    public function show($id)
    {
        $kandunganMading = KandunganMading::findOrFail($id);
        return view('kandungan_mading.show', compact('kandunganMading'));
    }

    public function edit($id)
    {
        $kandunganMading = KandunganMading::findOrFail($id);
        $asass = MasterAsas::all();
        $mading = Mading::all();
        return view('kandungan_mading.edit', compact('kandunganMading', 'asass', 'mading'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_asas' => 'required|exists:master_asas,id',
            'nama_pengampu' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'file' => 'nullable|file',
            'desk' => 'required',
        ]);

        $kandunganMading = KandunganMading::findOrFail($id);

        $filePath = $kandunganMading->file;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('kandungan_mading_files', 'public');
        }

        $kandunganMading->update([
            'id_asas' => $request->id_asas,
            'nama_pengampu' => $request->nama_pengampu,
            'judul' => $request->judul,
            'file' => $filePath,
            'desk' => $request->desk,
            'updated_by' => 1,
        ]);

        return redirect()->route('kandungan-mading.index')->with('success', 'Kandungan Mading berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kandunganMading = KandunganMading::findOrFail($id);
        $kandunganMading->update(['deleted_by' => 1]);
        $kandunganMading->delete();

        return redirect()->route('kandungan-mading.index')->with('success', 'Kandungan Mading berhasil dihapus.');
    }

    public function kandungan_mading()
    {
        try {
            $kandunganMading = KandunganMading::with('asas')->get();
            $data = $kandunganMading->filter()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'pengampu' => $item->nama_pengampu,
                    'file' => $item->file,
                    'gambar' => $item->nama_pengampu,
                    'asas' => $item->asas->nama_asas ?? null, // ambil nama_asas dari relasi asas
                    'createdBy' => $item->created_by,
                    'updatedBy' => $item->updated_by,
                    'deletedBy' => $item->deleted_by,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Get kandungan mading success',
                'data' => $data->values()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    

    public function kandungan_mading_by_asas(Request $request)
    {
        try {
            Log::info($request->all());



            $kandunganMading = KandunganMading::with('asas')
                ->where('id', $request->nama_asas)
                ->first();

            if (!$kandunganMading) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kandungan mading not found',
                    'data' => null
                ], 404);
            }

            // Ubah jadi array agar bisa dimodifikasi
            $data = $kandunganMading->toArray();

            // Tambahkan nama_asas langsung ke data utama
            $data['nama_asas'] = $data['asas']['nama_asas'] ?? null;

            // Hapus key 'asas' dari data
            unset($data['asas']);

            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
