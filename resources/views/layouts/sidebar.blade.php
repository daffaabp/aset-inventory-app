<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="menu-title">
                    <span>Beranda</span>
                </li>


                <li class="{{ Route::current()->getName() == 'dashboard.index' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="feather-grid"></i> <span> Dashboard</span></a>
                </li>



                @can(['user.index', 'role.index'])
                    <li class="submenu">
                        <a href="#"><i class="fa fa-users"></i> <span> Superadmin</span> <span
                                class="menu-arrow"></span></a>
                        <ul
                            class="{{ Route::current()->getName() == 'user.index' || Route::current()->getName() == 'role.index' ? 'show' : '' }}">

                            @can('user.index')
                                <li class="{{ Route::current()->getName() == 'user.index' ? 'active' : '' }}"><a
                                        href="{{ route('user.index') }}">User
                                        Managament</a></li>
                            @endcan

                            @can('role.index')
                                <li class="{{ Route::current()->getName() == 'role.index' ? 'active' : '' }}"><a
                                        href="{{ route('role.index') }}">Role Management</a></li>
                            @endcan

                        </ul>
                    </li>
                @endcan



                @canany(['role.index', 'bidang.index'])
                    <li class="menu-title">
                        <span>Fungsional Sistem</span>
                    </li>
                @endcan


                @can('bidang.index')
                    <li class="{{ Route::current()->getName() == 'bidang.index' ? 'active' : '' }}">
                        <a href="{{ route('bidang.index') }}"><i class="fa fa-sitemap"></i> <span>
                                Bidang</span></a>
                    </li>
                @endcan

                @can('status_aset.index')
                    <li class="{{ explode('.', Route::current()->getName())[0] == 'status_aset' ? 'active' : '' }}">
                        <a href="{{ route('status_aset.index') }}"><i class="fa fa-wrench"></i> <span> Status
                                Aset</span></a>
                    </li>
                @endcan

                @can('ruangan.index')
                    <li class="{{ Route::current()->getName() == 'ruangan.index' ? 'active' : '' }}">
                        <a href="{{ route('ruangan.index') }}"><i class="fas fa-holly-berry"></i> <span> Ruangan</span></a>
                    </li>
                @endcan


                @can('tanah.index')
                    <li class="{{ Route::current()->getName() == 'tanah.index' ? 'active' : '' }}">
                        <a href="{{ route('tanah.index') }}"><i class="fa fa-sticky-note"></i> <span> Aset
                                Tanah</span></a>
                    </li>
                @endcan

                @can('gedung.index')
                    <li class="{{ Route::current()->getName() == 'gedung.index' ? 'active' : '' }}">
                        <a href="{{ route('gedung.index') }}"><i class="fa fa-building"></i> <span> Aset Gedung</span></a>
                    </li>
                @endcan

                @can('kendaraan.index')
                    <li class="{{ Route::current()->getName() == 'kendaraan.index' ? 'active' : '' }}">
                        <a href="{{ route('kendaraan.index') }}"><i class="fa fa-car"></i> <span> Aset Kendaraan</span></a>
                    </li>
                @endcan

                @can('inventaris.index')
                    <li class="{{ Route::current()->getName() == 'inventaris.index' ? 'active' : '' }}">
                        <a href="{{ route('inventaris.index') }}"><i class="fas fa-holly-berry"></i> <span> Aset Inventaris
                                Ruangan</span></a>
                    </li>
                @endcan


                @can('peminjaman.create')
                    <li class="{{ Route::current()->getName() == 'peminjaman.index' ? 'active' : '' }}">
                        <a href="{{ route('peminjaman.create') }}"><i class="fas fa-building"></i> <span> Buat
                                Peminjaman</span>
                        </a>
                    </li>
                @endcan

                @canany(['peminjaman.create', 'verifikasiPeminjaman'])
                    <li class="menu-title">
                        <span>Peminjaman</span>
                    </li>
                @endcanany

                @can('verifikasiPeminjaman')
                    <li class="">
                        <a href="{{ route('verifikasiPeminjaman') }}"><i class="fa fa-check"></i> <span> Verifikasi
                                Peminjaman</span></a>
                    </li>
                @endcan

                @can('riwayatPeminjaman')
                    <li class="">
                        <a href="{{ route('riwayatPeminjaman') }}"><i class="fa fa-window-restore"></i> <span> Riwayat
                                Peminjaman</span></a>
                    </li>
                @endcan





                {{-- <li class="menu-title">
                    <span>Pelaporan</span>
                </li> --}}

                {{-- <li class="submenu">
                    <a href="#"><i class="fas fa-building"></i> <span> Daftar Peminjaman</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="departments.html">Department List</a></li>
                        <li><a href="add-department.html">Department Add</a></li>
                        <li><a href="edit-department.html">Department Edit</a></li>
                    </ul>
                </li> --}}

                {{-- <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard"></i> <span> Riwayat Peminjaman</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="invoices.html">Invoices List</a></li>
                        <li><a href="invoice-grid.html">Invoices Grid</a></li>
                        <li><a href="add-invoice.html">Add Invoices</a></li>
                        <li><a href="edit-invoice.html">Edit Invoices</a></li>
                        <li><a href="view-invoice.html">Invoices Details</a></li>
                        <li><a href="invoices-settings.html">Invoices Settings</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
