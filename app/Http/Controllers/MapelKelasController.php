<?php

namespace App\Http\Controllers;

use App\Models\mapel_kelas;
use App\Models\Master_Mapel;
use App\Models\Kelas;  // Pastikan untuk mengimpor model Kelas
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MapelKelasController extends Controller
{
    // Menampilkan daftar mapel kelas
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Ambil data dengan relasi ke tabel Kelas
            $data = mapel_kelas::with('kelas')->latest()->get();
            return DataTables::of($data)
                ->addColumn('nama_kelas', function ($row) {
                    return $row->kelas->nama_kelas ?? 'N\A';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('mapel_kelas.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<form action="' . route('mapel_kelas.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin?\')">Hapus</button>
                        </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('mapel_kelas.index');
    }

    // Menampilkan form untuk menambah mapel kelas
    public function create()
    {
        $masterMapel = Master_Mapel::all();  // Ambil semua mata pelajaran
        $kelas = Kelas::all();  // Ambil semua kelas dari tabel Kelas
        return view('mapel_kelas.create', compact('masterMapel', 'kelas'));  // Kirim data kelas dan mata pelajaran ke view
    }

    // Menyimpan mapel kelas ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas'  => 'required',
            'id_master_mapel' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('mapel_kelas.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Mengambil data inputan dan menambahkan created_by
        $input = $request->all();
        $input['created_by'] = 1;  // Menyimpan ID user yang membuat data (ganti dengan Auth::id())

        mapel_kelas::create($input);  // Simpan data ke dalam tabel mapel_kelas

        return redirect()->route('mapel_kelas.index')->with('success', 'Mapel Kelas created successfully');
    }

    // Menampilkan data mapel kelas untuk diedit
    public function edit($id)
    {
        $mapel_kelas = mapel_kelas::findOrFail($id);
        $kelas = Kelas::all();  // Ambil data kelas untuk dropdown
        $masterMapel = Master_Mapel::all();  // Ambil data mata pelajaran
        return view('mapel_kelas.edit', compact('mapel_kelas', 'kelas', 'masterMapel'));
    }

    // Mengupdate data mapel kelas
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas'  => 'required', 
            'id_master_mapel' => 'required'
        ]);

        $mapel_kelas = mapel_kelas::findOrFail($id);  // Ambil data yang akan diupdate

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $input['updated_by'] = 1;  // Menyimpan ID user yang mengupdate data

        $mapel_kelas->update($input);  // Update data mapel_kelas dengan data baru

        return redirect()->route('mapel_kelas.index')->with('success', 'Mapel Kelas updated successfully');
    }

    // Menghapus mapel kelas
    public function destroy($id)
    {
        $mapel_kelas = mapel_kelas::findOrFail($id);
        $mapel_kelas->delete();  // Hapus data mapel_kelas

        return redirect()->route('mapel_kelas.index')->with('success', 'Mapel Kelas deleted successfully');
    }
}
