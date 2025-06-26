@extends('layouts.admin.index')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                @php
                    use App\Models\Admin;
                    use App\Models\Guru;

                    $user = Auth::user();
                    $displayName = $user->name; // default

                    if ($user->hasRole('admin')) {
                        $admin = Admin::where('nama_admin', $user->name)->first();
                        if ($admin) {
                            $displayName = $admin->nama_admin;
                        }
                    } elseif ($user->hasRole('user')) {
                        $guru = Guru::where('nama_guru', $user->name)->first();
                        if ($guru) {
                            $displayName = $guru->nama_guru;
                        }
                    }
                @endphp

                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome {{ $displayName }}</h3>
                    <h6 class="font-weight-normal mb-0">All systems are running smoothly!
                        You have
                        <span class="text-primary">{{ $unreadCount ?? 0 }} unread alerts!</span>
                    </h6>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today ({{ date('d M Y') }})
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                <a class="dropdown-item" href="#">January - March</a>
                                <a class="dropdown-item" href="#">March - June</a>
                                <a class="dropdown-item" href="#">June - August</a>
                                <a class="dropdown-item" href="#">August - November</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="{{ asset('assets/images/dashboard/bgdashboard.png') }}" alt="people">
                    <div class="weather-info">
                        <div class="d-flex">
                            <div class="ml-2">
                                <h4 class="location font-weight-normal">Palembang</h4>
                                <h6 class="font-weight-normal">Sumatera Selatan</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Total Santri</p>
                            <p class="fs-30 mb-2">{{ number_format($totalSantri) }}</p>
                            <p>{{ $totalSantri > 0 ? '100%' : '0%' }} Active</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Total Pendidik</p>
                            <p class="fs-30 mb-2">{{ number_format($totalPendidik) }}</p>
                            <p>{{ $totalPendidik > 0 ? '100%' : '0%' }} Active</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Total Orang Tua</p>
                            <p class="fs-30 mb-2">{{ number_format($totalOrangTua) }}</p>
                            <p>{{ $totalOrangTua > 0 ? '100%' : '0%' }} Active</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <p class="mb-4">Total Admin</p>
                            <p class="fs-30 mb-2">{{ number_format($totalAdmin) }}</p>
                            <p>{{ $totalAdmin > 0 ? '100%' : '0%' }} Active</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- TO DO LIST -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">To Do Lists</h4>
                    <div class="list-wrapper pt-2">
                        <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                            <li>
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox"> Meeting with Urban Team
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked> Duplicate a project for new
                                        customer
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li>
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox"> Project meeting with CEO
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked> Follow up of team zilla
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li>
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox"> Level up for Antony
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="add-items d-flex mb-0 mt-2">
                        <input type="text" class="form-control todo-list-input" placeholder="Add new task">
                        <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent">
                            <i class="icon-circle-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- KALENDER AKADEMIK VISUAL -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title">Kalender Akademik - {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</h4>
                    @php
                        use Carbon\Carbon;

                        $startOfMonth = Carbon::now()->startOfMonth();
                        $endOfMonth = Carbon::now()->endOfMonth();
                        $startDay = $startOfMonth->copy()->startOfWeek(); // Start from Sunday
                        $endDay = $endOfMonth->copy()->endOfWeek();

                        $days = [];
                        while ($startDay <= $endDay) {
                            $days[] = $startDay->copy();
                            $startDay->addDay();
                        }

                        // Buat mapping tanggal => data keterangan dan jenis libur
                        $mapKeterangan = collect();
                        foreach ($kalender as $item) {
                            $mulai = Carbon::parse($item->tanggal_mulai);
                            $selesai = Carbon::parse($item->tanggal_selesai);
                            while ($mulai <= $selesai) {
                                $mapKeterangan[$mulai->format('Y-m-d')] = [
                                    'keterangan' => $item->keterangan,
                                    'libur_akademik' => strtolower($item->libur_akademik),
                                ];
                                $mulai->addDay();
                            }
                        }

                        // Fungsi warna berdasarkan jenis libur
                        function warnaBulatan($jenis)
                        {
                            return match ($jenis) {
                                'pts' => '#2196f3', // biru
                                'pas' => '#e91e63', // pink
                                'hari libur' => '#f44336', // merah
                                'acara khusus' => '#ffeb3b', // kuning
                                default => '', // tidak diberi warna
                            };
                        }

                        function warnaTeks($jenis)
                        {
                            return $jenis === 'acara khusus' ? 'black' : 'white';
                        }
                    @endphp

                    <div class="table-responsive">
                        <table class="table table-bordered text-center" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th class="text-danger">Su</th>
                                    <th>Mo</th>
                                    <th>Tu</th>
                                    <th>We</th>
                                    <th>Th</th>
                                    <th>Fr</th>
                                    <th>Sa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (array_chunk($days, 7) as $week)
                                    <tr>
                                        @foreach ($week as $day)
                                            @php
                                                $tanggalKey = $day->format('Y-m-d');
                                                $event = $mapKeterangan[$tanggalKey] ?? null;
                                                $warnaBg = $event ? warnaBulatan($event['libur_akademik']) : '';
                                                $warnaText = $event ? warnaTeks($event['libur_akademik']) : '';
                                            @endphp
                                            <td class="{{ $day->month != now()->month ? 'text-muted' : '' }}">
                                                <div style="margin: auto; font-size: 12px;">
                                                    <div
                                                        style="width: 28px; height: 28px; line-height: 28px; border-radius: 50%; margin: auto;
                                {{ $warnaBg ? "background-color: $warnaBg; color: $warnaText;" : '' }}">
                                                        {{ $day->day }}
                                                    </div>
                                                    @if ($event)
                                                        <div style="font-size: 10px; color: #333; margin-top: 4px;">
                                                            {{ $event['keterangan'] }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <!-- LEGENDA -->
                    <div class="mt-2" style="font-size: 12px;">
                        <strong>*</strong> Keterangan:
                        <div style="margin-top: 8px;">
                            <span
                                style="display: inline-block; width: 16px; height: 16px; background-color: #2196f3; border-radius: 50%; margin-right: 5px;"></span>
                            PTS
                            <span
                                style="display: inline-block; width: 16px; height: 16px; background-color: #4E9F3D; border-radius: 50%; margin: 0 10px 0 20px;"></span>
                            PAS
                            <span
                                style="display: inline-block; width: 16px; height: 16px; background-color: #f44336; border-radius: 50%; margin: 0 10px 0 20px;"></span>
                            Hari Libur
                            <span
                                style="display: inline-block; width: 16px; height: 16px; background-color: #ffeb3b; border-radius: 50%; border: 1px solid #999; margin: 0 10px 0 20px;"></span>
                            Acara Khusus
                        </div>

                        <!-- Daftar Event -->
                        <div class="mt-2 text-left">
                            @foreach ($kalender as $item)
                                <div>
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M') }}
                                    @if ($item->tanggal_mulai != $item->tanggal_selesai)
                                        - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M') }}
                                    @endif
                                    : <strong>{{ $item->keterangan }}</strong> ({{ $item->libur_akademik }})
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
