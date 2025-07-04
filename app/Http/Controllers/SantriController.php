<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Kelas;
use App\Models\orang_tua;
use App\Models\ortu_santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $santris = Santri::whereNull('deleted_at')->get();

            return DataTables::of($santris)
                ->addIndexColumn()
                ->addColumn('foto', function ($row) {
                    $url = asset('storage/' . $row->foto);
                    return '<img src="' . $url . '" width="60" height="60" class="img-thumbnail rounded-circle" />';
                })
                ->addColumn('tingkatan', function ($row) {
                    return $row->kelas->tingkatan;
                })
                ->addColumn('nama_kelas', function ($row) {
                    return $row->kelas->nama_kelas;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('santri.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<form action="' . route('santri.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin?\')">Hapus</button>
                            </form>';
                    return $btn;
                })
                ->rawColumns(['action', 'foto'])
                ->make(true);
        }

        return view('santri.index');
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('santri.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_santri' => 'required|string|max:255',
            'nisn' => 'required|string|max:50',
            'nis' => 'required|string|max:50',
            'nsm' => 'required|string|max:50',
            'npsm' => 'required|string|max:50',
            'id_kelas' => 'required|exists:kelas,id',
            'gender' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto-santri', 'public');
        }

        Santri::create([
            'nama_santri' => $request->nama_santri,
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nsm' => $request->nsm,
            'npsm' => $request->npsm,
            'id_kelas' => $request->id_kelas,
            'gender' => $request->gender,
            'foto' => $fotoPath,
            'created_by' => 1,
        ]);

        return redirect()->route('santri.index')->with('success', 'Santri berhasil ditambahkan.');
    }

    public function show(Santri $santri)
    {
        return view('santri.show', compact('santri'));
    }

    public function edit(Santri $santri)
    {
        $kelas = Kelas::all();
        return view('santri.edit', compact('santri', 'kelas'));
    }

    public function update(Request $request, Santri $santri)
    {
        $validator = Validator::make($request->all(), [
            'nama_santri' => 'required|string|max:255',
            'nisn' => 'required|string|max:50',
            'nis' => 'required|string|max:50',
            'nsm' => 'required|string|max:50',
            'npsm' => 'required|string|max:50',
            'id_kelas' => 'required|exists:kelas,id',
            'gender' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle foto jika diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($santri->foto && Storage::disk('public')->exists($santri->foto)) {
                Storage::disk('public')->delete($santri->foto);
            }

            $fotoPath = $request->file('foto')->store('foto-santri', 'public');
            $santri->foto = $fotoPath;
        }

        $santri->update([
            'nama_santri' => $request->nama_santri,
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nsm' => $request->nsm,
            'npsm' => $request->npsm,
            'id_kelas' => $request->id_kelas,
            'gender' => $request->gender,
            'foto' => $santri->foto,
            'updated_by' => 1,
        ]);

        return redirect()->route('santri.index')->with('success', 'Santri berhasil diupdate.');
    }

    public function get_all_santri_by_ortu(Request $request)
    {
        try {
            $user = $request->user();
            $ortu = orang_tua::where('no_telepon', '=', $user->no_wa)->first();
            $santris = ortu_santri::where('id_ortu', $ortu->id)
                ->with('santri.kelas')
                ->get();

            $data = $santris->pluck('santri')->filter()->map(function ($santri) {
                return [
                    'nama_santri' => $santri->nama_santri,
                    'nis' => $santri->nis,
                    'nisn' => $santri->nisn,
                    'nsm' => $santri->nsm,
                    'npsm' => $santri->npsm,
                    'gender' => $santri->gender,
                    'kelas' => $santri->kelas->nama_kelas ?? null,
                    'foto' => $santri->foto,
                    'createdBy' => $santri->created_by,
                    'updatedBy' => $santri->updated_by,
                    'deletedBy' => $santri->deleted_by,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Get santri success',
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

    public function destroy(Santri $santri)
    {
        if ($santri->foto && Storage::disk('public')->exists($santri->foto)) {
            Storage::disk('public')->delete($santri->foto);
        }

        $santri->update([
            'deleted_by' => 1,
        ]);

        $santri->delete();

        return redirect()->route('santri.index')->with('success', 'Santri berhasil dihapus.');
    }
}
