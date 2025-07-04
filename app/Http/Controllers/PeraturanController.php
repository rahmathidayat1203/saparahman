<?php

namespace App\Http\Controllers;

use App\Models\peraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class PeraturanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = peraturan::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('file', function ($row) {
                    return "<a href='" . asset('storage/peraturans/' . $row->file) . "' target='_blank'>Lihat File</a>";
                })
                ->addColumn('jenis_peraturan', function ($row) {
                    return ucfirst($row->jenis_peraturan);
                })
                ->addColumn('action', function ($row) {
                    $edit = route('peraturan.edit', $row->id);
                    $show = route('peraturan.show', $row->id);
                    $delete = route('peraturan.destroy', $row->id);
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

        return view('peraturan.index');
    }

    public function create()
    {
        return view('peraturan.create');
    }


    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nama_peraturan' => 'required|string|max:255',
                'jenis_peraturan' => 'required|in:peraturan umum,peraturan agama,peraturan sekolah,peraturan asrama',
                'file' => 'required|file|max:10240|mimes:png,jpeg,jpg,pdf,doc,docx', // Max 10MB
            ]);

            $file = $request->file('file');

            // Sanitasi nama file original untuk keamanan
            $originalName = $file->getClientOriginalName();
            $sanitizedName = preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $originalName);

            // Generate nama file yang unik untuk menghindari konflik
            $fileName = time() . '_' . uniqid() . '_' . $sanitizedName;

            // Simpan file ke storage
            $filePath = $file->storeAs('public/peraturans', $fileName);

            // Pastikan file berhasil disimpan
            if (!$filePath) {
                throw new \Exception('Gagal menyimpan file');
            }

            // Simpan data ke database
            $peraturan = peraturan::create([
                'nama_peraturan' => $request->nama_peraturan,
                'jenis_peraturan' => $request->jenis_peraturan,
                'file' => $fileName,
                'file_original_name' => $originalName, // Simpan nama asli jika kolom ada
                'file_size' => $file->getSize(), // Simpan ukuran file jika kolom ada
                'file_type' => $file->getMimeType(), // Simpan tipe file jika kolom ada
            ]);

            return redirect()->route('peraturan.index')
                ->with('success', 'peraturan "' . $request->nama_peraturan . '" berhasil disimpan.');
        } catch (ValidationException $e) {
            // Tangani error validasi
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Data yang dimasukkan tidak valid.');
        } catch (\Exception $e) {
            // Tangani error umum
            \Log::error('Error saat menyimpan peraturan: ' . $e->getMessage());

            // Hapus file jika sudah tersimpan tapi database gagal
            if (isset($fileName) && Storage::exists('public/peraturans/' . $fileName)) {
                Storage::delete('public/peraturans/' . $fileName);
            }

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan peraturan. Silakan coba lagi.');
        }
    }

    public function show(peraturan $peraturan)
    {
        return view('peraturan.show', compact('peraturan'));
    }

    public function edit(peraturan $peraturan)
    {
        return view('peraturan.edit', compact('peraturan'));
    }

    public function update(Request $request, peraturan $peraturan)
    {
        $request->validate([
            'nama_peraturan' => 'required|string',
            'jenis_peraturan' => 'required|in:peraturan umum,peraturan agama,peraturan sekolah,peraturan asrama',
            'file' => 'nullable|mimes:pdf,doc,docx',
        ]);

        $data = [
            'nama_peraturan' => $request->nama_peraturan,
            'jenis_peraturan' => $request->jenis_peraturan,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($peraturan->file && Storage::disk('public')->exists('peraturans/' . $peraturan->file)) {
                Storage::disk('public')->delete('peraturans/' . $peraturan->file);
            }

            // Simpan file baru
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('peraturans', $fileName, 'public'); // Simpan ke storage/app/public/peraturans

            $data['file'] = $fileName;
        }

        $peraturan->update($data);

        return redirect()->route('peraturan.index')->with('success', 'Peraturan berhasil diperbarui.');
    }

    public function destroy(peraturan $peraturan)
    {
        if ($peraturan->file && Storage::exists('public/peraturans/' . $peraturan->file)) {
            Storage::delete('public/peraturans/' . $peraturan->file);
        }

        $peraturan->delete();

        return back()->with('success', 'Peraturan berhasil dihapus.');
    }

    public function peraturan()
    {
        try {
            $data = peraturan::all(); // Ambil semua data dari tabel peraturan

            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengambil data peraturan',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }
}
