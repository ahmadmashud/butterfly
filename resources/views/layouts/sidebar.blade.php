<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{asset('assets/img/admin-avatar.png')}}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ Session::get('user')->nama }} </div><small>{{ Session::get('user')->role->nama }}</small>
            </div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a id="menu_dashboard" href="/"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>


            <li class="heading">TRANSAKSI</li>
            @if( in_array('GALERI', Session::get('privileges')) )
            <li>
                <a id="menu_galery" href="/terapis/transaction/gallery"><i class="sidebar-item-icon fa fa-photo"></i>
                    <span class="nav-label">Galeri</span>
                </a>
            </li>
            @endif

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-shopping-cart"></i>
                    <span class="nav-label">Transaksi</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">

                    @if( in_array('TRX', Session::get('privileges')) )
                    <li>
                        <a id="menu_transaksi" href="/transactions">Transaksi</a>
                    </li>
                    @endif
                    <li>
                        <!-- <a id="menu_riwayat" href="/transactions/history">Riwayat Transaksi</a> -->
                    </li>
                    <!-- <li>
                        <a href="datatables.html">Datatables</a>
                    </li> -->
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-file"></i>
                    <span class="nav-label">Laporan</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    @if( in_array('LAPORAN', Session::get('privileges')) )
                    <li>
                        <a id="menu_laporan_transaksi" href="/laporan">Laporan Transaksi</a>
                    </li>
                    @endif
                    @if( in_array('LAPORAN_FND', Session::get('privileges')) )
                    <li>
                        <a id="menu_laporan_fnd" href="/laporan/fnd">Laporan F&D</a>
                    </li>
                    @endif
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-money"></i>
                    <span class="nav-label">Komisi & Gaji</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    @if( in_array('KM_USER', Session::get('privileges')) )
                    <li>
                        <a id="menu_kg_user" href="/komisi_gaji/user">Pengguna</a>
                    </li>
                    @endif
                    @if( in_array('KM_TERAPIS', Session::get('privileges')) )
                    <li>
                        <a id="menu_kg_terapis" href="/komisi_gaji/terapis">Terapis</a>
                    </li>
                    @endif
                    @if( in_array('KM_SUPPLIER', Session::get('privileges')) )
                    <li>
                        <a id="menu_kg_supplier" href="/komisi_gaji/supplier">Supplier</a>
                    </li>
                    @endif
                </ul>
            </li>

            <li class="heading">MASTER</li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-database"></i>
                    <span class="nav-label">Master</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    @if( in_array('M_PRODUK', Session::get('privileges')) )
                    <li>
                        <a id="menu_produk" href="/products"><i class="sidebar-item-icon fa fa-file"></i>
                            <span class="nav-label">Produk</span>
                        </a>
                    </li>
                    @endif

                    @if( in_array('M_ROOM', Session::get('privileges')) )
                    <li>
                        <a id="menu_room" href="/rooms"><i class="sidebar-item-icon fa fa-university"></i>
                            <span class="nav-label">Room</span>
                        </a>
                    </li>
                    @endif

                    @if( in_array('M_LOKER', Session::get('privileges')) )
                    <li>
                        <a id="menu_loker" href="/lokers"><i class="sidebar-item-icon fa fa-inbox"></i>
                            <span class="nav-label">Loker</span>
                        </a>
                    </li>
                    @endif

                    @if( in_array('M_TERAPIS', Session::get('privileges')) )
                    <li>
                        <a id="menu_terapis" href="/terapis"><i class="sidebar-item-icon fa fa-users"></i>
                            <span class="nav-label">Terapis</span>
                        </a>
                    </li>
                    @endif

                    @if( in_array('M_KATEGORI', Session::get('privileges')) )
                    <li>
                        <a id="menu_kategori_fnd" href="/categoryFoodDrinks"><i class="sidebar-item-icon fa fa-list-alt"></i>
                            <span class="nav-label">kategori F&D</span>
                        </a>
                    </li>
                    @endif

                    @if( in_array('M_FND', Session::get('privileges')) )
                    <li>
                        <a id="menu_fnd" href="/foodDrinks"><i class="sidebar-item-icon fa fa-shopping-basket"></i>
                            <span class="nav-label">F&D</span>
                        </a>
                    </li>
                    @endif

                    @if( in_array('M_SUPPLIER', Session::get('privileges')) )
                    <li>
                        <a id="menu_supplier" href="/suppliers"><i class="sidebar-item-icon fa fa-user"></i>
                            <span class="nav-label">Supplier</span>
                        </a>
                    </li>
                    @endif

                    @if( in_array('M_PAKET', Session::get('privileges')) )
                    <li>
                        <a id="menu_pkg_room" href="/packageRooms"><i class="sidebar-item-icon fa fa-briefcase"></i>
                            <span class="nav-label">Paket Room</span>
                        </a>
                    </li>
                    @endif

                    @if( in_array('M_SESI', Session::get('privileges')) )
                    <li>
                        <a id="menu_sesi" href="/sessions"><i class="sidebar-item-icon fa fa-clock-o"></i>
                            <span class="nav-label">Sesi</span>
                        </a>
                    </li>
                    @endif

                    @if( in_array('M_TARIF', Session::get('privileges')) )
                    <li>
                        <a id="menu_tarif" href="/prices"><i class="sidebar-item-icon fa fa-money"></i>
                            <span class="nav-label">Tarif Parameter</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            <li class="heading">SETTING</li>
            @if( in_array('M_USER', Session::get('privileges')) )
            <li>
                <a id="menu_pengguna" href="/users"><i class="sidebar-item-icon fa fa-user"></i>
                    <span class="nav-label">Pengguna</span>
                </a>
            </li>
            @endif
            @if( in_array('M_ROLE', Session::get('privileges')) )
            <li>
                <a id="menu_role" href="/roles"><i class="sidebar-item-icon fa fa-gear"></i>
                    <span class="nav-label">Role Jabatan</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>