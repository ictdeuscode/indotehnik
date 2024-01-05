<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link {{ set_active('dashboard.index') }}" href="{{ route('dashboard.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Home
                        </a>

                        @if(checkPermissions([
                            'master_role',
                            'master_permission_role',
                            'master_pegawai',
                            'master_operator',
                            'master_mesin',
                            'master_nomor_order'
                        ]))
                        <a class="nav-link collapsed 
                        {{ set_active([
                            'masterrole.index',
                            'masterrole.create',
                            'masterrole.show',
                            'masterrole.edit',
                            'masterpermissionrole.index',
                            'mastermesin.index',
                            'mastermesin.create',
                            'mastermesin.show',
                            'mastermesin.edit',
                            'QRMasterMesin',
                            'masterpegawai.index',
                            'masterpegawai.create',
                            'masterpegawai.show',
                            'masterpegawai.edit',
                            'QRMasterPegawai',
                            'masteroperator.index',
                            'masteroperator.create',
                            'masteroperator.show',
                            'masteroperator.edit',
                            'QRMasterOperator',
                            'masterpreorder.index',
                            'masterpreorder.create',
                            'masterpreorder.show',
                            'masterpreorder.edit',
                            'QRMasterPreorder',
                        ]) }}"
                            href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-sitemap"></i></div>
                            Master
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                @can('hasPermission', 'master_role')
                                <a class="nav-link {{ set_active(['masterrole.index', 'masterrole.create', 'masterrole.show', 'masterrole.edit']) }}"
                                    href="{{ route('masterrole.index') }}">Master Role</a>
                                @endcan
                                @can('hasPermission', 'master_permission_role')
                                <a class="nav-link {{ set_active(['masterpermissionrole.index']) }}"
                                    href="{{ route('masterpermissionrole.index') }}">Master Permission Role</a>
                                @endcan
                                @can('hasPermission', 'master_pegawai')
                                <a class="nav-link {{ set_active(['masterpegawai.index', 'masterpegawai.create', 'masterpegawai.show', 'masterpegawai.edit', 'QRMasterPegawai']) }}"
                                    href="{{ route('masterpegawai.index') }}">Master Pegawai</a>
                                @endcan
                                @can('hasPermission', 'master_operator')
                                <a class="nav-link {{ set_active(['masteroperator.index', 'masteroperator.create', 'masteroperator.show', 'masteroperator.edit', 'QRMasterOperator']) }}"
                                    href="{{ route('masteroperator.index') }}">Master Operator</a>
                                @endcan
                                @can('hasPermission', 'master_mesin')
                                <a class="nav-link {{ set_active(['mastermesin.index', 'mastermesin.create', 'mastermesin.show', 'mastermesin.edit', 'QRMasterMesin']) }}"
                                    href="{{ route('mastermesin.index') }}">Master Mesin</a>
                                @endcan
                                @can('hasPermission', 'master_nomor_order')
                                <a class="nav-link {{ set_active(['masterpreorder.index', 'masterpreorder.create', 'masterpreorder.show', 'masterpreorder.edit', 'QRMasterPreorder']) }}"
                                    href="{{ route('masterpreorder.index') }}">Master Nomor Order</a>
                                @endcan
                            </nav>
                        </div>
                        @endif

                        @can('hasPermission', 'qr')
                        <a class="nav-link {{ set_active('masterQR.QR') }}" href="{{ route('masterQR.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-qrcode"></i></div>
                            QR
                        </a>
                        @endcan

                        @if(checkPermissions([
                            'laporan_detail_pengerjaan',
                            'laporan_poin_karyawan',
                            'laporan_reject',
                            'laporan_reject_customer',
                            'laporan_stock',
                        ]))
                        <a class="nav-link collapsed {{ set_active(['laporandetailpengerjaan.index', 'laporanpoinkaryawan.index', 'laporanreject.index', 'laporanrejectcustomer']) }}"
                            href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fab fa-wpforms"></i></div>
                            Laporan
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                @can('hasPermission', 'laporan_detail_pengerjaan')
                                <a class="nav-link {{ set_active('laporandetailpengerjaan.index') }}"
                                    href="{{ route('laporandetailpengerjaan.index') }}">Laporan Detail Pengerjaan</a>
                                @endcan
                                <!-- <a class="nav-link {{ set_active('historyoperator.index') }}"
                                    href="{{ route('historyoperator.index') }}">History Operator</a>
                                <a class="nav-link {{ set_active('historymesin.index') }}"
                                    href="{{ route('historymesin.index') }}">History Mesin</a>
                                <a class="nav-link {{ set_active('historygudang.index') }}"
                                    href="{{ route('historygudang.index') }}">History Gudang</a> -->
                                @can('hasPermission', 'laporan_poin_karyawan')    
                                <a class="nav-link {{ set_active('laporanpoinkaryawan.index') }}"
                                    href="{{ route('laporanpoinkaryawan.index') }}">Laporan Poin Karyawan</a>
                                @endcan
                                @can('hasPermission', 'laporan_reject')
                                <a class="nav-link {{ set_active('laporanreject.index') }}"
                                    href="{{ route('laporanreject.index') }}">Laporan Reject</a>
                                @endcan
                                @can('hasPermission', 'laporan_reject_customer')
                                <a class="nav-link {{ set_active('laporanrejectcustomer.index') }}"
                                    href="{{ route('laporanrejectcustomer.index') }}">Laporan Reject Customer</a>
                                @endcan
                                @can('hasPermission', 'laporan_reject_customer')
                                <a class="nav-link {{ set_active('laporanstock.index') }}"
                                    href="{{ route('laporanstock.index') }}">Laporan Stock</a>
                                @endcan
                            </nav>
                        </div>
                        @endif
                        <a class="nav-link" href="{{ route('backup.downloadBackup') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-download"></i></div>
                            Export Backup
                        </a>
                    </div>
                </div>
                @if(checkPermissions([
                    'export_backup',
                ]))
                <div class="sb-sidenav-footer">
                    <div class="small">Masuk Sebagai:</div>
                    {{ Auth::user()->nama }}
                </div>
                @endif
            </nav>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
