<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\KalenderAkademik;
use App\Models\orang_tua;
use App\Models\Santri;
use App\Models\User;
use Database\Seeders\SantriSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Admin::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.show', $row->id) . '" class="btn btn-info btn-sm">View</a> ';
                    $btn .= '<a href="' . route('admin.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<form action="' . route('admin.destroy', $row->id) . '" method="POST" style="display:inline-block">'
                        . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>' .
                        '</form>';
                    return $btn;
                })
                ->addColumn('foto', function ($row) {
                    if ($row->foto) {
                        $url = asset('storage/' . $row->foto);
                        return '<img src="' . $url . '" width="80" height="60" style="object-fit:cover;" />';
                    } else {
                        return '-';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.index');
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'username' => 'required|string|max:255|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|confirmed|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'roles' => 'required'
        ]);


        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto-admin', 'public');
        }

        $user = User::create([
            'name' => $validated['nama_admin'],
            'no_wa' => $validated['no_wa'],
            'password' => Hash::make($validated['password'])
        ]);

        $user->assignRole($validated['roles']);

        Admin::create([
            'nama_admin' => $validated['nama_admin'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'foto' => $fotoPath,
            'created_by' => Auth::id() ?? 1
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }


    public function show(Admin $admin)
    {
        return view('admin.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        $users = User::where('name', $admin->nama_admin)->first();
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.edit', compact('admin', 'users', 'roles'));
    }

    public function update(Request $request, Admin $admin)
    {
        $user = User::where('name', $admin->nama_admin)->first();

        $validated = $request->validate([
            'nama_admin' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|confirmed|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'roles' => 'required'
        ]);

        // Update ke tabel users
        if ($user) {
            $userData = [
                'name' => $validated['nama_admin'],
                'no_wa' => $validated['no_wa'],
            ];

            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $user->update($userData);
            $user->syncRoles($validated['roles']);
        }

        $data = [
            'nama_admin' => $validated['nama_admin'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'updated_by' => Auth::id() ?? 1,
        ];

        // Foto baru?
        if ($request->hasFile('foto')) {
            if ($admin->foto && Storage::disk('public')->exists($admin->foto)) {
                Storage::disk('public')->delete($admin->foto);
            }

            $data['foto'] = $request->file('foto')->store('foto-admin', 'public');
        }

        $admin->update($data);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy(Admin $admin)
    {
        $admin->update(['deleted_by' => Auth::id()]);

        if ($admin->foto && Storage::disk('public')->exists($admin->foto)) {
            Storage::disk('public')->delete($admin->foto);
        }

        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully.');
    }

    public function dashboard()
    {
        $bulanIni = Carbon::now()->format('m');
        $tahunIni = Carbon::now()->format('Y');

        $kalender = KalenderAkademik::whereYear('tanggal_mulai', $tahunIni)
            ->whereMonth('tanggal_mulai', $bulanIni)
            ->orWhere(function ($query) use ($tahunIni, $bulanIni) {
                $query->whereYear('tanggal_selesai', $tahunIni)
                    ->whereMonth('tanggal_selesai', $bulanIni);
            })
            ->get();
        $totalSantri = Santri::count();
        $totalPendidik = Guru::count();
        $totalAdmin = Admin::count();
        $totalOrangTua = orang_tua::count();

        // Mengirim data ke view
        return view('dashboard', [
            'kalender' => $kalender,
            // Data dashboard lainnya:
            'totalSantri' => Santri::count(),
            'totalPendidik' => Guru::count(),
            'totalOrangTua' => orang_tua::count(),
            'totalAdmin' => Admin::count(),
        ]);
    }
}
