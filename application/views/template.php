<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $judul ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="<?=base_url()?>assets/Login/images/icons/favicon.ico"/>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?=base_url()?>assets/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
        <link rel="stylesheet" href="<?=base_url()?>assets/css/ionicons.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?=base_url()?>assets/AdminLTE-3.0.5/dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
        <link rel="stylesheet" href="<?=base_url()?>assets/css/googlefont.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?= base_url()?>assets/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url()?>assets/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?=base_url();?>assets/AdminLTE-3.0.5/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/AdminLTE-3.0.5/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- Sweet Alert -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/sweetalert2-10.15.6/package/dist/sweetalert2.min.css">
        <!-- Date Range Picker -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->
        <link rel="stylesheet" href="<?=base_url()?>assets/css/daterangepicker.css">
        <!-- Custom Style CSS -->
        <link rel="stylesheet" href="<?=base_url()?>assets/css/mycustom.css">

        <style>
              /* Back to Top Pure CSS by igniel.com */
            html {scroll-behavior:smooth;}
            .ignielToTop {
                width:50px;
                height:50px; 
                position:fixed; 
                bottom:50px; 
                right: 50px; 
                z-index:99; 
                cursor:pointer; 
                border-radius:100px; 
                transition:all .5s; 
                background:rgba(105,221,201,1) url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7.41,15.41L12,10.83L16.59,15.41L18,14L12,8L6,14L7.41,15.41Z' fill='%23fff'/%3E%3C/svg%3E") no-repeat center center;
            }
            .ignielToTop:hover {
                background:#1d2129 url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7.41,15.41L12,10.83L16.59,15.41L18,14L12,8L6,14L7.41,15.41Z' fill='%23fff'/%3E%3C/svg%3E") no-repeat center center;
            }
        </style>

    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="javascript:void(0)" class="nav-link">Visualisasi Manajemen Aset</a>
                    </li>
                </ul>
                

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <a class="nav-link logout" href="<?=site_url('Auth/logout')?>"> Logout <i class="fas fa-sign-out-alt" style="margin-left:2px"></i> </a>   
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="<?=base_url('Dashboard')?>" class="brand-link">
                <img src="<?=base_url()?>/assets/images/logorounded.png"
                    alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">VMA-PoliBatam</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                        <img src="<?=base_url()?>assets/images/profile2.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                        <a href="#" class="d-block"><?=$this->fungsi->user_login()->fullname?></a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->                        
                            <li class="nav-item">
                                <a href="<?=site_url('Dashboard')?>" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=site_url('Umum')?>" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Visualisasi
                                    </p>
                                </a>
                            </li>
                            <?php if($this->fungsi->user_login()->userlevel == "A1"){?>   
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Master Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview ml-3">
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Aset <i class="right fas fa-angle-left"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview ml-3">
                                            <li class="nav-item">
                                                <a href="<?=site_url('Admin/laptop')?>" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Laptop</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?=site_url('Admin/monitor')?>" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Monitor</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?=site_url('Admin/printer')?>" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Printer</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?=site_url('Admin/user')?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data User</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php }?>
                            <?php if($this->fungsi->user_login()->userlevel != "A3"){?>
                            <li class="nav-item">
                                <a href="<?=site_url('Manajemen')?>" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Manajemen Aset
                                    </p>
                                </a>
                            </li>
                            <?php } ?>                   
                        </ul>
                    </nav>
                <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php echo $contents ?>
                
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                <b>Version</b> 21.1.0
                </div>
                <strong>Copyright &copy; 2021 <a href="javascript:void(0)">VMA-PoliBatam</a>.</strong> All rights
                reserved.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <!-- <script src="<?=base_url()?>assets/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script> -->
        <script src="<?php echo base_url()?>assets/js/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?=base_url()?>assets/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url()?>assets/AdminLTE-3.0.5/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?=base_url()?>assets/AdminLTE-3.0.5/dist/js/demo.js"></script>
        <!-- DataTables -->
        <script src="<?= base_url()?>assets/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url()?>assets/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url()?>assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url()?>assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <!-- Select2 -->
        <script src="<?= base_url()?>assets/AdminLTE-3.0.5/plugins/select2/js/select2.full.min.js"></script>
        <!-- Sweet Alert -->
        <script src="<?php echo base_url()?>assets/sweetalert2-10.15.6/package/dist/sweetalert2.min.js" type="text/javascript"></script> 
        <!-- Date Range Picker -->
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->
        <script src="<?php echo base_url()?>assets/js/moment.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/daterangepicker.min.js"></script>
        
        <!-- ChartJS -->
        <script src="<?= base_url()?>assets/AdminLTE-3.0.5/plugins/chart.js/Chart.min.js"></script>
        <!-- MOrris JS -->
        <script src="<?php echo base_url()?>assets/js/raphael.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/morris.min.js"></script>
        <!-- Custom -->
        <script src="<?php echo base_url()?>assets/js/myscript.js"></script>
        
        
        <script type="text/javascript">
            $(function () {
                var url = window.location;
                // for single sidebar menu
                $('ul.nav-sidebar a').filter(function () {
                    return this.href == url;
                }).addClass('active');

                // for sidebar menu and treeview
                $('ul.nav-treeview a').filter(function () {
                    return this.href == url;
                }).parentsUntil(".nav-sidebar > .nav-treeview")
                    .css({'display': 'block'})
                    .addClass('menu-open').prev('a')
                    .addClass('active');
            });

            // Alert hilang sendiri 
            window.setTimeout(function () {
                $(".alert-dismissable").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 5000);


            // Data Tables
            $(function () {
                $("#example1,#example2,#example3").DataTable({
                "responsive": true,
                "autoWidth": false,
                "language": {
                    "url":"//cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
                    "sEmptyTable":"Tidads"
                }
                });
            });

            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                theme: 'bootstrap4'
                })
            })

            // Function untuk menghitung session timeout, dan otomatis update status (OFF) pada tb_login tanpa button logout
            var mins = 15 * 60; //second 
            var active = setTimeout("logout()",(mins*1000)); //active minutes
            function logout()
            {
                location='<?=base_url();?>Auth/sessionOff'; // <-- put your controller function here to destroy the session object and redirect the user to the login page.
            }

            // Tooltip 
            $(function () {
                $("[rel='tooltip']").tooltip();
            });

            // Daterangepicker
            $(function() {                
                $('#datefilter,#datefilter2').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear',
                    }
                });

                $('#datefilter,#datefilter2').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD-MM-YYYY') + ' s/d ' + picker.endDate.format('DD-MM-YYYY'));
                });

                $('#datefilter,#datefilter2').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

            });

        </script>
    <!-- TOmbol Bak to top -->
    <a href="#" class="ignielToTop"></a>
    </body>
</html>
