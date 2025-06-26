<?php

namespace App\Http\Controllers;

use App\Models\detail_ekskul_raport;
use App\Models\Raport;
use App\Models\Master_Ekskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DetailEkskulRaportController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = detail_ekskul_raport::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_santri', function ($row) {
                    return $row->raport && $row->raport->santri ? $row->raport->santri->nama_santri : '-';
                })
                ->addColumn('nama_ekskul', function ($row) {
                    return $row->ekskul ? $row->ekskul->nama_ekskul : '-';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('detail_ekskul_raport.edit', $row->id);
                    $deleteUrl = route('detail_ekskul_raport.destroy', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">'
                        . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</button>
                    </form>';
                })
                ->rawColumns(['action', 'nama_santri', 'nama_ekskul'])
                ->make(true);
        }

        return view('detail_ekskul_raport.index');
    }

    public function create()
    {
        $raports = Raport::all(); // ambil semua raport
        $ekskuls = Master_Ekskul::all(); // ambil semua ekskul
        return view('detail_ekskul_raport.create', compact('raports', 'ekskuls'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_raport' => 'required',
            'id_ekskul' => 'required',
            'nilai' => 'required|in:A,B,C',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $input["created_by"] = 1;

        detail_ekskul_raport::create($input);

        return redirect()->route('detail_ekskul_raport.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(detail_ekskul_raport $detail_ekskul_raport)
    {
        return view('detail_ekskul_raport.show', compact('detail_ekskul_raport'));
    }

    public function edit(detail_ekskul_raport $detail_ekskul_raport)
    {
        $raports = Raport::all();
        $ekskuls = Master_Ekskul::all();
        return view('detail_ekskul_raport.edit', compact('detail_ekskul_raport', 'raports', 'ekskuls'));
    }

    public function update(Request $request, detail_ekskul_raport $detail_ekskul_raport)
    {
        $validator = Validator::make($request->all(), [
            'id_raport' => 'required',
            'id_ekskul' => 'required',
            'nilai' => 'required|in:A,B,C',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $input["updated_by"] = 1;

        $detail_ekskul_raport->update($input);

        return redirect()->route('detail_ekskul_raport.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(detail_ekskul_raport $detail_ekskul_raport)
    {
        $detail_ekskul_raport->delete();

        return redirect()->route('detail_ekskul_raport.index')->with('success', 'Data berhasil dihapus');
    }

    
}
