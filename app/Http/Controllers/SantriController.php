<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Kelas;
use App\Models\orang_tua;
use App\Models\ortu_santri;
use Illuminate\Http\Request;
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
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('santri.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<form action="' . route('santri.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin?\')">Hapus</button>
                            </form>';
                    return $btn;
                })->addColumn('tingkatan', function ($row) {
                    return $row->kelas->tingkatan;
                })->addColumn('nama_kelas', function ($row) {
                    return $row->kelas->nama_kelas;
                })
                ->rawColumns(['action'])
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Santri::create([
            'nama_santri' => $request->nama_santri,
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nsm' => $request->nsm,
            'npsm' => $request->npsm,
            'id_kelas' => $request->id_kelas,
            'gender' => $request->gender,
            'created_by' => 1, // Hardcode sementara
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $santri->update([
            'nama_santri' => $request->nama_santri,
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nsm' => $request->nsm,
            'npsm' => $request->npsm,
            'id_kelas' => $request->id_kelas,
            'gender' => $request->gender,
            'updated_by' => 1, // Hardcode sementara
        ]);

        return redirect()->route('santri.index')->with('success', 'Santri berhasil diupdate.');
    }

    public function get_all_santri_by_ortu(Request $request)
    {
        try {
            $user = $request->user();
            $ortu = orang_tua::where('no_telepon','=',$user->no_wa)->first();
            $santris = ortu_santri::where('id_ortu', $ortu->id)
                ->with('santri.kelas') // eager load relasi kelas
                ->get();

            $data = $santris->pluck('santri')->filter()->map(function ($santri) {
                return [
                    'nama_santri' => $santri->nama_santri,
                    'nis' => $santri->nis,
                    'nisn' => $santri->nisn,
                    'nsm' => $santri->nsm,
                    'npsm' => $santri->npsm,
                    'gender' => $santri->gender,
                    'kelas' => $santri->kelas->nama_kelas ?? null, // ambil nama_kelas dari relasi kelas
                    'createdBy' => $santri->created_by,
                    'updatedBy' => $santri->updated_by,
                    'deletedBy' => $santri->deleted_by,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Get santri success',
                'data' => $data->values() // reset key jika perlu
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500); // 500 karena ini error server
        }
    }

    public function destroy(Santri $santri)
    {
        $santri->update([
            'deleted_by' => 1, // Hardcode sementara
        ]);
        $santri->delete();

        return redirect()->route('santri.index')->with('success', 'Santri berhasil dihapus.');
    }
}
