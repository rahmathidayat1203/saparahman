<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KalenderAkademikController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = KalenderAkademik::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = route('kalender_akademik.edit', $row->id);
                    $show = route('kalender_akademik.show', $row->id);
                    $delete = route('kalender_akademik.destroy', $row->id);
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

        return view('kalender_akademik.index');
    }

    public function create()
    {
        return view('kalender_akademik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'libur_akademik' => 'required',
            'keterangan' => 'required|string',
            'tahun_ajaran' => 'required|string',
        ]);

        KalenderAkademik::create([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'libur_akademik' => $request->libur_akademik,
            'keterangan' => $request->keterangan,
            'tahun_ajaran' => $request->tahun_ajaran,
            'created_by' => 1,
        ]);

        return redirect()->route('kalender_akademik.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(KalenderAkademik $kalenderAkademik)
    {
        return view('kalender_akademik.edit', compact('kalenderAkademik'));
    }

    public function update(Request $request, KalenderAkademik $kalenderAkademik)
    {
        $request->validate([
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'libur_akademik' => 'required',
            'keterangan' => 'required|string',
            'tahun_ajaran' => 'required|string',
        ]);

        $kalenderAkademik->update([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'libur_akademik' => $request->libur_akademik,
            'keterangan' => $request->keterangan,
            'tahun_ajaran' => $request->tahun_ajaran,
            'updated_by' => 1,
        ]);

        return redirect()->route('kalender_akademik.index')->with('success', 'Data berhasil diupdate.');
    }

    public function show(KalenderAkademik $kalenderAkademik)
    {
        return view('kalender_akademik.show', compact('kalenderAkademik'));
    }

    public function destroy(KalenderAkademik $kalenderAkademik)
    {
        $kalenderAkademik->update(['deleted_by' => 1]);
        $kalenderAkademik->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }

    /**
     * API method to get kalender data for mobile app or AJAX requests
     */
    public function getKalendar(Request $request)
    {
        try {
            $query = KalenderAkademik::query();

            // Filter by tahun_ajaran if provided
            if ($request->has('tahun_ajaran') && !empty($request->tahun_ajaran)) {
                $query->where('tahun_ajaran', $request->tahun_ajaran);
            }

            // Filter by date range if provided
            if ($request->has('start_date') && !empty($request->start_date)) {
                $query->where('tanggal_mulai', '>=', $request->start_date);
            }

            if ($request->has('end_date') && !empty($request->end_date)) {
                $query->where('tanggal_selesai', '<=', $request->end_date);
            }

            // Order by tanggal_mulai
            $kalender = $query->orderBy('tanggal_mulai', 'asc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data kalender akademik berhasil diambil',
                'data' => $kalender
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kalender akademik',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * API method to get upcoming events
     */
    public function getUpcomingEvents(Request $request)
    {
        try {
            $today = now()->format('Y-m-d');
            $limit = $request->get('limit', 10);

            $upcomingEvents = KalenderAkademik::where('tanggal_mulai', '>=', $today)
                ->orderBy('tanggal_mulai', 'asc')
                ->limit($limit)
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Data event mendatang berhasil diambil',
                'data' => $upcomingEvents
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data event mendatang',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * API method to get events by month
     */
    public function getEventsByMonth(Request $request)
    {
        try {
            $year = $request->get('year', now()->year);
            $month = $request->get('month', now()->month);

            $events = KalenderAkademik::whereYear('tanggal_mulai', $year)
                ->whereMonth('tanggal_mulai', $month)
                ->orderBy('tanggal_mulai', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Data event berhasil diambil',
                'data' => $events,
                'year' => $year,
                'month' => $month
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data event',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}