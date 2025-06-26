<?php

namespace App\Http\Controllers;

use App\Models\KategoriMading;
use App\Models\Mading;
use App\Models\mading as ModelsMading;
use App\Models\MasterAsas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MadingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Mading::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('gambar', function ($row) {
                    $url = asset('storage/' . $row->gambar);
                    return '<img src="' . $url . '" width="80" height="60" style="object-fit:cover;" />';
                })
                ->addColumn('id_asas', function ($row) {
                    return $row->asas ? $row->asas->nama_asas : '-';
                })
                ->addColumn('id_kategori_mading', function ($row) {
                    return $row->kategori ? $row->kategori->kategori : '-';
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="' . route('mading.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>';
                    $deleteBtn = '<button class="btn btn-sm btn-danger" onclick="deleteData(' . $row->id . ')">Hapus</button>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['gambar', 'action']) // <== pastikan ini ada
                ->make(true);
        }


        return view('mading.index'); // Halaman Blade dengan DataTable
    }

    public function mading_by_id($id)
    {
        try {
            $mading = Mading::with('kategori')->find($id);

            if (!$mading) {
                return response()->json([
                    'success' => false,
                    'message' => "Mading tidak ditemukan",
                    'data' => null
                ], 404);
            }

            // Ubah data menjadi array dan manipulasi struktur
            $data = $mading->toArray();

            // Gantikan 'id_kategori_mading' dengan nama kategori
            $data['kategori'] = $mading->kategori->kategori ?? null;
            unset($data['id_kategori_mading']);
            unset($data['kategori']); // Hapus relasi asli kategori (object)

            // Tambahkan ulang key kategori sebagai string
            $data['kategori'] = $mading->kategori->kategori ?? null;

            return response()->json([
                'success' => true,
                'message' => "get mading by id success",
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



    public function get_all_mading(Request $request)
    {
        try {
            $madings = Mading::with('kategori')->get();

            // Kelompokkan berdasarkan nama kategori
            $grouped = $madings->groupBy(function ($item) {
                return $item->kategori->kategori ?? 'Tanpa Kategori';
            });

            // Format ulang hasil agar sesuai struktur JSON yang kamu mau
            $result = [];
            foreach ($grouped as $kategori => $items) {
                $result[$kategori] = $items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'judul' => $item->judul,
                        'gambar' => $item->gambar,
                        'gambaran_deskripsi' => $item->gambaran_deskripsi,
                        'asas' => $item->asas->nama_asas,
                        'created_by' => $item->created_by,
                        'created_at' => $item->created_at,
                    ];
                });
            }

            return response()->json([
                'success' => true,
                'message' => 'Get grouped mading success',
                'data' => $result
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function create()
    {
        $kategoriMadings = KategoriMading::all();
        $asass = MasterAsas::all();
        return view('mading.create', compact('kategoriMadings', 'asass'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori_mading' => 'required',
            'id_asas' => 'required|exists:master_asas,id',
            'judul' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'gambaran_deskripsi' => 'required|string',
        ]);

        // Simpan gambar ke folder public/mading
        $path = $request->file('gambar')->store('mading', 'public');
        $validated['gambar'] = $path;

        $validated['created_by'] = 1;

        $mading = Mading::create($validated);

        return redirect()->route('mading.index')->with('success', 'Data berhasil ditambahkan');
    }


    public function edit(Mading $mading)
    {
        $kategoriList = KategoriMading::all();
        $asass = MasterAsas::all();
        return view('mading.edit', compact('mading', 'kategoriList', 'asass'));
    }

    public function update(Request $request, Mading $mading)
    {
        // dd($request->all());
        $validated = $request->validate([
            'id_kategori_mading' => 'required',
            'id_asas' => 'required|exists:master_asas,id',
            'judul' => 'required',
            'gambaran_deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // (Opsional) Hapus gambar lama
            if ($mading->gambar && Storage::exists('public/' . $mading->gambar)) {
                Storage::delete('public/' . $mading->gambar);
            }

            $gambarPath = $request->file('gambar')->store('mading', 'public');
            $validated['gambar'] = $gambarPath;
        } else {
            // Pertahankan gambar lama
            $validated['gambar'] = $mading->gambar;
        }

        $validated['updated_by'] = Auth::id();

        $mading->update($validated);

        return redirect()->route('mading.index')->with('success', 'Data berhasil diperbarui');
    }


    public function destroy($id)
    {
        $mading = Mading::findOrFail($id);
        $mading->deleted_by = 1;
        $mading->save();
        $mading->delete();

        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
