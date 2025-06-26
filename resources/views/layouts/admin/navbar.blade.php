<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="dashboard#"><img src="{{ asset('assets/images/SAPA.png') }}"
                class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="dashboard#"><img src="{{ asset('assets/images/logo.PNg') }}"
                alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                @php
                    use Illuminate\Support\Facades\Auth;
                    use App\Models\Admin;
                    use App\Models\Guru;

                    $user = Auth::user();
                    $foto = asset('assets/images/faces/face28.jpg'); // default foto

                    if ($user) {
                        if ($user->hasRole('Admin')) {
                            $admin = Admin::where('nama_admin', $user->name)->first();
                            if ($admin && $admin->foto) {
                                $foto = asset('storage/' . $admin->foto);
                            }
                        } elseif ($user->hasRole('Guru')) {
                            $guru = Guru::where('nama_guru', $user->name)->first();
                            if ($guru && $guru->foto) {
                                $foto = asset('storage/' . $guru->foto);
                            }
                        }
                    }
                @endphp

                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" data-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ $foto }}" alt="profile"
                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" />
                </a>

                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>

            <li class="nav-item nav-settings d-none d-lg-flex">
                <a class="nav-link" href="#">
                    <i class="icon-ellipsis"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
