<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Guru::with(['kelas', 'creator'])->select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kelas_name', function ($row) {
                    return $row->kelas ? $row->kelas->nama_kelas : '-';
                })
                ->addColumn('foto', function ($row) {
                    if ($row->foto) {
                        $url = asset('storage/' . $row->foto);
                        return '<img src="' . $url . '" width="80" height="60" style="object-fit:cover;" />';
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="' . route('guru.edit', $row->id) . '" class="btn btn-sm btn-warning mx-1">Edit</a>';
                    $deleteBtn = '<form action="' . route('guru.destroy', $row->id) . '" method="POST" class="d-inline">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</button>
                                  </form>';
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['action', 'foto'])
                ->make(true);
        }

        return view('guru.index');
    }

    public function create()
    {
        $kelas = Kelas::all();
        $roles = Role::pluck('name','name')->all();
        return view('guru.create', compact('kelas', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_guru' => 'required|string|max:255',
            'no_wa' => 'required',
            'username' => 'required|string|max:255|unique:gurus',
            'password' => 'required|same:confirm-password',
            'email' => 'required|email|unique:gurus',
            'id_kelas' => 'required|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'roles' => 'required'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto-guru', 'public');
        }

        $user = User::create([
            'name' => $validated['nama_guru'],
            'no_wa' => $validated['no_wa'],
            'password' => Hash::make($validated['password'])
        ]);

        $user->assignRole($validated['roles']);

        Guru::create([
            'nama_guru' => $validated['nama_guru'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'id_kelas' => $validated['id_kelas'],
            'foto' => $fotoPath,
            'created_by' => Auth::id() ?? 1
        ]);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan');
    }

    public function show(Guru $guru)
    {
        return view('guru.show', compact('guru'));
    }

    public function edit(Guru $guru)
    {
        $kelas = Kelas::all();
        $users = User::where('name', $guru->nama_guru)->first();
        $roles = Role::pluck('name','name')->all();
        // dd($users);
        return view('guru.edit', compact('guru', 'kelas', 'users', 'roles'));
    }

    public function update(Request $request, Guru $guru)
    {
        $users = User::where('name', $guru->nama_guru)->first();
        
        $rules = [
            'nama_guru' => 'required|string|max:255',
            'no_wa' => 'required',
            'username' => 'required|string|max:255|unique:gurus',
            'password' => 'required|same:confirm-password',
            'email' => 'required|email|unique:gurus',
            'id_kelas' => 'required|exists:kelas,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'roles' => 'required'
        ];

        $validated = $request->validate($rules);

        $user = [
            'name' => $validated['nama_guru'],
            'no_wa' => $validated['no_wa'],
            'password' => Hash::make($validated['password'])
        ];

        $users->update($user);

        $data = [
            'nama_guru' => $validated['nama_guru'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'id_kelas' => $validated['id_kelas'],
            'updated_by' => Auth::id()
        ];

        // Handle foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }

            $data['foto'] = $request->file('foto')->store('foto-guru', 'public');
        }

        $guru->update($data);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui');
    }

    public function destroy(Guru $guru)
    {
        $guru->update(['deleted_by' => Auth::id()]);

        // Hapus foto jika ada
        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus');
    }

    public function getAllGuru()
    {
        $gurus = Guru::all();

        return response()->json([
            'success' => true,
            'message' => 'Data guru berhasil diambil',
            'data' => $gurus,
        ], 200);
    }
}
