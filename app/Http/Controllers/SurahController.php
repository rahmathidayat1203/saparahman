<?php

namespace App\Http\Controllers;

use App\Models\Surah;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SurahController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Surah::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('surah.edit', $row->id);
                    $show = route('surah.show', $row->id);
                    $delete = route('surah.destroy', $row->id);
                    return "
                        <a href='$show' class='btn btn-info btn-sm'>Lihat</a>
                        <a href='$edit' class='btn btn-warning btn-sm'>Edit</a>
                        <form action='$delete' method='POST' style='display:inline-block'>
                            " . csrf_field() . method_field('DELETE') . "
                            <button type='submit' onclick='return confirm(\"Yakin hapus?\")' class='btn btn-danger btn-sm'>Hapus</button>
                        </form>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('surah.index');
    }

    public function create()
    {
        return view('surah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_surah' => 'required|string',
            'arti_surah' => 'required|string',
            'jml_ayat' => 'required|integer',
        ]);

        Surah::create([
            'nama_surah' => $request->nama_surah,
            'arti_surah' => $request->arti_surah,
            'jml_ayat' => $request->jml_ayat,
            'created_by' => 1,
        ]);

        return redirect()->route('surah.index')->with('success', 'Surah berhasil disimpan.');
    }

    public function show(Surah $surah)
    {
        return view('surah.show', compact('surah'));
    }

    public function edit(Surah $surah)
    {
        return view('surah.edit', compact('surah'));
    }

    public function update(Request $request, Surah $surah)
    {
        $request->validate([
            'nama_surah' => 'required|string',
            'arti_surah' => 'required|string',
            'jml_ayat' => 'required|integer',
        ]);

        $surah->update([
            'nama_surah' => $request->nama_surah,
            'arti_surah' => $request->arti_surah,
            'jml_ayat' => $request->jml_ayat,
            'updated_by' => 1,
        ]);

        return redirect()->route('surah.index')->with('success', 'Surah berhasil diperbarui.');
    }

    public function destroy(Surah $surah)
    {
        $surah->update(['deleted_by' => 1]);
        $surah->delete();

        return redirect()->route('surah.index')->with('success', 'Surah berhasil dihapus.');
    }

    // response success
    // buat APi untuk get all hafalan surah berdasarkan id_santri dengan response 
    // return response()->json([
    //             'success'=> true,
    //             'message'=> "pengumuman get success",
    //             'data' => $data
    //         ],200);
    // response gagal
    // return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //             'data' => null
    //         ],200);
    // dengan table sekema sebagai berikut
    // Schema::create('hafalan_surah', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('id_santri');
    //         $table->string('id_surah');
    //         $table->date('tgl_setoran');
    //         $table->string('nilai');
    //         $table->unsignedBigInteger('created_by');
    //         $table->unsignedBigInteger('updated_by')->nullable();
    //         $table->unsignedBigInteger('deleted_by')->nullable();
    //         $table->softDeletes();
    //         $table->timestamps();
    //     });
}
