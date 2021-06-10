<?php    
    function getRomawi($bln){
        switch ($bln){
            case 1: 
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    };
    $bulan      = date('m');
    $romawi    = getRomawi($bulan);
    $tahun     = date ('Y');
    $nomor     = "/TRX-PJM/".$romawi."/".$tahun;
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manajemen Aset</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Manajemen Aset</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card alert-dismissable">
        <div class="card-header">
            <h3 class="card-title">Hai, <?=$this->fungsi->user_login()->username?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            Selamat datang, berikut halaman manajemen aset.
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <?= gmdate("d F Y", time()+60*60*7);?>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    <!-- Flash Data -->
    <div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
    <div class="flashErr" data-flashdata="<?=$this->session->flashdata('flash_error'); ?>"></div>

    <!-- Info box -->
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-info">
                <span class="info-box-icon"><i class="fas fa-laptop"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">LAPTOP <a href="<?=site_url('LaporanPDF/downloadLaptopOut')?>" target="_blank"  style="margin-left:5px" class="btn btn-outline-secondary btn-sm float-right"> <i class="fas fa-cloud-download-alt" rel="tooltip" title="Download"></i></a></span>
                    <span class="info-box-number">
                        <?php 
                        // $this->db->where('stts_pinjam',"Y");
                        $data = $this->db->count_all_results('tb_laptop');
                        
                        $this->db->where('stts_pinjam',"Y");
                        $this->db->from('tb_laptop');
                        $data1 =$this->db->count_all_results();
                        echo $data1.' Dipinjam';

                        $persen = ($data1/$data)*100; //hitung rata2
                        ?>
                    </span>

                    <div class="progress">
                        <div class="progress-bar" style="width: <?=$persen?>%"></div>
                    </div>
                    <span class="progress-description">
                    <?=round($persen).'% dari jumlah laptop '.$data.' unit.'?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-success">
                <span class="info-box-icon"><i class="fas fa-desktop"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">MONITOR <a href="<?=site_url('LaporanPDF/downloadMonitorOut')?>" target="_blank"  style="margin-left:5px" class="btn btn-outline-secondary btn-sm float-right"> <i class="fas fa-cloud-download-alt" rel="tooltip" title="Download"></i></a></span>
                    <span class="info-box-number">
                        <?php 
                        // $this->db->where('stts_pinjam',"Y");
                        $data = $this->db->count_all_results('tb_monitor');
                        
                        $this->db->where('stts_pinjam',"Y");
                        $this->db->from('tb_monitor');
                        $data1 =$this->db->count_all_results();
                        echo $data1.' Dipinjam';

                        $persen = ($data1/$data)*100; //hitung rata2
                        ?>
                    </span>

                    <div class="progress">
                        <div class="progress-bar" style="width: <?=$persen?>%"></div>
                    </div>
                    <span class="progress-description">
                    <?=round($persen).'% dari jumlah laptop '.$data.' unit.'?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-warning">
                <span class="info-box-icon"><i class="fas fa-print"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">PRINTER <a href="<?=site_url('LaporanPDF/downloadPrinterOut')?>" target="_blank"  style="margin-left:5px" class="btn btn-outline-secondary btn-sm float-right"> <i class="fas fa-cloud-download-alt" rel="tooltip" title="Download"></i></a></span> 
                    <span class="info-box-number">
                        <?php 
                        // $this->db->where('stts_pinjam',"Y");
                        $data = $this->db->count_all_results('tb_printer');
                        
                        $this->db->where('stts_pinjam',"Y");
                        $this->db->from('tb_printer');
                        $data1 =$this->db->count_all_results();
                        echo $data1.' Dipinjam';

                        $persen = ($data1/$data)*100; //hitung rata2
                        ?>
                    </span>

                    <div class="progress">
                        <div class="progress-bar" style="width: <?=$persen?>%"></div>
                    </div>
                    <span class="progress-description">
                    <?=round($persen).'% dari jumlah laptop '.$data.' unit.'?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- /. =========================================================== -->

    <!-- START CUSTOM TABS -->
    <div class="row">
        <div class="col-12">
        <!-- Custom Tabs -->
            <div class="card">
                <div class="card-header d-flex p-0">
                    <h3 class="card-title p-3">Table Transaksi Peminjamam <a class="btn btn-outline-info btn-sm ml-3" href="#" id="tambahData" data-toggle="modal" data-target="#modalTambah"><i class="far fa-plus-square"></i> Tambah</a> 
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-danger btn-sm dropdown-toggle ml-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cloud-download-alt"></i> Download
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=site_url('LaporanPdf/downloadTrxPinjamLaptop')?>" target="_blank"><i class="fas fa-laptop"></i><span class="ml-2">Laptop</span> </a>
                                <a class="dropdown-item" href="<?=site_url('LaporanPdf/downloadTrxPinjamMonitor')?>" target="_blank"><i class="fas fa-desktop"></i><span class="ml-2">Monitor</span></a>
                                <a class="dropdown-item" href="<?=site_url('LaporanPdf/downloadTrxPinjamPrinter')?>" target="_blank"><i class="fas fa-print"></i> <span class="ml-2">Printer</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" id="customData" href="#" data-toggle="modal" data-target="#modalCustom"><i class="fas fa-search"></i><span class="ml-2">Custom Filter</span></a>
                            </div>
                        </div>
                    </h3>
                    
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Laptop</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Monitor</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Printer</a></li>
                        <li class="nav-item dropdown" style="margin-left:10px">
                        <!-- <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                            Transaksi <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" tabindex="-1" href="#"><i class="fas fa-file-export" style="margin-right:5px"></i> Peminjaman</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" tabindex="-1" href="#"><i class="fas fa-file-import"style="margin-right:5px"></i> Pengembalian</a>
                        </div> -->
                        </li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Transaksi</th>
                                        <th>ID Aset</th>
                                        <th>Peminjaman</th>
                                        <th>Pengembalian</th>
                                        <th>User</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $today = gmdate("Y-m-d", time()+60*60*7); 
                                    $no=1;
                                    foreach ($rowlt as $datalt) {?>
                                        <tr <?= $datalt['tgl_bts_pinjam'] < $today && $datalt['tgl_kembali'] == "0000-00-00" ? "class='table-danger'" : null ?>>
                                            <td><?=$no++?></td>
                                            <td>
                                                <a href="#" id="detailData" data-toggle="modal" data-target="#modalDetail" data-id="<?=$datalt['id_pinjam']?>" data-aset="<?=$datalt['id_aset']?>" data-tglpinjam="<?=date("d-M-Y",strtotime($datalt['tgl_pinjam']))?>" data-btspinjam="<?=date("d-M-Y",strtotime($datalt['tgl_bts_pinjam']))?>" data-tglkembali="<?=date("d-M-Y",strtotime($datalt['tgl_kembali']))?>" data-user="<?=$datalt['fullname']?>" data-operator="<?=$datalt['operator']?>" data-operator2="<?=$datalt['operator_update']?>" data-tglinput="<?=date("d-m-Y H:i:s",strtotime($datalt['tgl_trx_input']))?>" data-tglupdate="<?=date("d-m-Y H:i:s",strtotime($datalt['tgl_trx_update']))?>">
                                                    <strong><?=$datalt['id_pinjam']?></strong>
                                                </a>
                                            </td>
                                            <td><?=$datalt['id_aset']?></td>
                                            <td><?php echo date("d-M-Y",strtotime($datalt['tgl_pinjam'])); ?></td>
                                            <td><?php if(date($datalt['tgl_kembali']) == "0000-00-00"){
                                                echo "<i class='far fa-question-circle text-danger' rel='tooltip' title='Outstanding'></i>";
                                            }else echo date("d-M-Y",strtotime($datalt['tgl_kembali']));?></td>
                                            <td><?=$datalt['username']?></td>
                                            <td class="text-center">
                                                <?php if($datalt['tgl_kembali'] == "0000-00-00"){ ?>
                                                <a href="<?=site_url('Manajemen/trxPengembalian/').encrypt_url($datalt['id_trx_pinjam']).'/'.encrypt_url($datalt['id_aset']).'/'.'1'.'/'.$datalt['tgl_bts_pinjam']?>" type="button" class="btn btn-outline-primary btn-xs return" rel="tooltip" title="Proses Pengembalian" ><i class="fas fa-trash-restore"></i></a>
                                                <?php } else echo "<i class='far fa-check-circle text-success' rel='tooltip' title='Sudah Dikembalikan'></i>"; ?>
                                            </td>
                                        </tr>
                                    <?php }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Transaksi</th>
                                        <th>ID Aset</th>
                                        <th>Peminjaman</th>
                                        <th>Pengembalian</th>
                                        <th>User</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $today = gmdate("Y-m-d", time()+60*60*7); 
                                    $no=1;
                                    foreach ($rowmt as $datamt) {?>
                                        <tr <?= $datamt['tgl_bts_pinjam'] < $today && $datamt['tgl_kembali'] == "0000-00-00" ? "class='table-danger'" : null ?>>
                                            <td><?=$no++?></td>
                                            <td>
                                                <a href="#" id="detailData" data-toggle="modal" data-target="#modalDetail" data-id="<?=$datamt['id_pinjam']?>" data-aset="<?=$datamt['id_aset']?>" data-tglpinjam="<?=date("d-M-Y",strtotime($datamt['tgl_pinjam']))?>" data-btspinjam="<?=date("d-M-Y",strtotime($datamt['tgl_bts_pinjam']))?>" data-tglkembali="<?=date("d-M-Y",strtotime($datamt['tgl_kembali']))?>" data-user="<?=$datamt['fullname']?>" data-operator="<?=$datamt['operator']?>" data-operator2="<?=$datamt['operator_update']?>" data-tglinput="<?=date("d-m-Y H:i:s",strtotime($datamt['tgl_trx_input']))?>" data-tglupdate="<?=date("d-m-Y H:i:s",strtotime($datamt['tgl_trx_update']))?>">
                                                    <strong><?=$datamt['id_pinjam']?></strong>
                                                </a>
                                            </td>
                                            <td><?=$datamt['id_aset']?></td>
                                            <td><?=date("d-M-Y",strtotime($datamt['tgl_pinjam']))?></td>
                                            <td><?php if(date($datamt['tgl_kembali']) == "0000-00-00"){
                                                echo "<i class='far fa-question-circle text-danger' rel='tooltip' title='Outstanding'></i>";
                                            }else echo date("d-M-Y",strtotime($datamt['tgl_kembali']));?></td>
                                            <td><?=$datamt['username']?></td>
                                            <td class="text-center">
                                                <?php if($datamt['tgl_kembali'] == "0000-00-00"){ ?>
                                                <a href="<?=site_url('Manajemen/trxPengembalian/').encrypt_url($datamt['id_trx_pinjam']).'/'.encrypt_url($datamt['id_aset']).'/'.'2'?>" type="button" class="btn btn-outline-primary btn-xs return" rel="tooltip" title="Proses Pengembalian" ><i class="fas fa-trash-restore"></i></a>
                                                <?php } else echo "<i class='far fa-check-circle text-success' rel='tooltip' title='Sudah Dikembalikan'></i>"; ?>
                                            </td>
                                        </tr>
                                    <?php }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Transaksi</th>
                                        <th>ID Aset</th>
                                        <th>Peminjaman</th>
                                        <th>Pengembalian</th>
                                        <th>User</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $today = gmdate("Y-m-d", time()+60*60*7); 
                                    $no=1;
                                    foreach ($rowpt as $datapt) {?>
                                        <tr <?= $datapt['tgl_bts_pinjam'] < $today && $datapt['tgl_kembali'] == "0000-00-00" ? "class='table-danger'" : null ?>>
                                            <td><?=$no++?></td>
                                            <td>
                                                <a href="#" id="detailData" data-toggle="modal" data-target="#modalDetail" data-id="<?=$datapt['id_pinjam']?>" data-aset="<?=$datapt['id_aset']?>" data-tglpinjam="<?=date("d-M-Y",strtotime($datapt['tgl_pinjam']))?>" data-btspinjam="<?=date("d-M-Y",strtotime($datapt['tgl_bts_pinjam']))?>" data-tglkembali="<?=date("d-M-Y",strtotime($datapt['tgl_kembali']))?>" data-user="<?=$datapt['fullname']?>" data-operator="<?=$datapt['operator']?>" data-operator2="<?=$datapt['operator_update']?>" data-tglinput="<?=date("d-m-Y H:i:s",strtotime($datapt['tgl_trx_input']))?>" data-tglupdate="<?=date("d-m-Y H:i:s",strtotime($datapt['tgl_trx_update']))?>">
                                                    <strong><?=$datapt['id_pinjam']?></strong>
                                                </a>
                                            </td>
                                            <td><?php echo $datapt['id_aset'];?></td>
                                            <td><?=date("d-M-Y",strtotime($datapt['tgl_pinjam']))?></td>
                                            <td><?php if(date($datapt['tgl_kembali']) == "0000-00-00"){
                                                echo "<i class='far fa-question-circle text-danger' rel='tooltip' title='Outstanding'></i>";
                                            }else echo date("d-M-Y",strtotime($datapt['tgl_kembali']));?></td>
                                            <td><?=$datapt['username']?></td>
                                            <td class="text-center">
                                                <?php if($datapt['tgl_kembali'] == "0000-00-00"){ ?>
                                                <a href="<?=site_url('Manajemen/trxPengembalian/').encrypt_url($datapt['id_trx_pinjam']).'/'.encrypt_url($datapt['id_aset']).'/'.'3'?>" type="button" class="btn btn-outline-primary btn-xs return" rel="tooltip" title="Proses Pengembalian" ><i class="fas fa-trash-restore"></i></a>
                                                <?php } else echo "<i class='far fa-check-circle text-success' rel='tooltip' title='Sudah Dikembalikan'></i>"; ?>
                                            </td>
                                        </tr>
                                    <?php }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- END CUSTOM TABS -->

</section>
<!-- /.content -->

<!-- Modal Tambah  -->
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="far fa-plus-square"></i> Transaksi Baru Peminjaman Aset </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=site_url('Manajemen/trxTambahPinjam')?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="idtrx">No Transaksi</label>
                            <div class="input-group mb3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
                                </div>
                                <input type="text" class="form-control" id="idtrx" name="idtrx" value="<?=$rowIdTrx.$nomor?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ram">Tgl Peminjaman</label>
                            <div class="input-group mb3 date" id="datetimepicker7" data-target-input="nearest">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" data-target="#datefilter" data-toggle="datefilter"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control" name="tglpinjam" id="datefilter" required/>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label>Jenis Aset</label>
                            <select class="custom-select" style="width: 100%;" name="aset" id="aset" required>
                                <option selected="selected" disabled>- Pilih -</option>
                                <option value="laptop">LAPTOP</option>
                                <option value="monitor">MONITOR</option>
                                <option value="printer">PRINTER</option>
                            </select>                                                  
                        </div>
                        <div class="form-group">
                            <label>ID Aset</label>
                            <select class="idAset form-control select2bs4" style="width: 100%;" name="idaset" id="idaset" onchange="aktifuser()" required>
                                <option selected="selected" disabled>- Pilih -</option>
                            </select>                                                  
                        </div>                        
                        <div class="form-group">
                            <label for="peminjam">Peminjam</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="peminjam" id="peminjam" onchange="aktiftombol()">
                                <option selected="selected"disabled>- Pilih -</option>
                                <?php foreach ($rowUser as $data) {?>
                                    <option value="<?=$data['id_user']?>"> <?=$data['username'] ?></option>
                                <?php }?>
                            </select>
                        </div>      
                        <input type="hidden" class="form-control" name="operator" id="operator" value="<?=$this->fungsi->user_login()->username;?>" />
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="simpan" id="btnsimpan"> <i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?=base_url();?>assets/js/jqueryv3.2.1.min.js" type="text/javascript"></script>
    <script>
        $(document).on("click","#tambahData",function(){
            $("#btnsimpan").attr("disabled",'disabled');
            $("#idaset").attr("disabled",'disabled');
            $("#peminjam").attr("disabled",'disabled');
        })

        $(document).ready(function(){            
            $("#aset").change(function(){
                var jenis = $(this).val();
                console.log(jenis);
                $.ajax({
                    url : "<?=base_url()?>index.php/Manajemen/cariAset",
                    method : "POST",
                    data : {jenis: jenis},
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '<option selected="selected"disabled>- Pilih -</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id_aset+'>'+data[i].id_aset+' | '+data[i].merk_aset+'</option>';
                        }

                        $(".idAset").html(html);
                        $("#idaset").attr("disabled",false);
                    }

                })
            })
        });

        function aktifuser(){
            $("#peminjam").attr("disabled",false);
        }

        function aktiftombol(){
            $("#btnsimpan").attr("disabled",false);
        }
    </script>

<!-- /. Modal Tambah -->

<!-- Modal Detail -->
    <div class="modal fade" id="modalDetail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" id="bodyModalDetail">
                    <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-secondary">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="<?=base_url()?>/assets/images/logorounded.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                                <h5 class="widget-user-desc">Detail Transaksi Peminjaman</h5>
                                <h5 id="idTrx"></h5>
                        </div>
                        <div class="card-footer p-0" id="detailAset">
                            
                        </div>
                        <!-- <small style="margin-left:15px"><cite>*Update adalah proses pengembalian aset dari peminjam.</cite></small> -->
                        <small><cite style="margin-left:15px">* <i class="far fa-question-circle text-danger"></i> artinya belum ada proses pengembalian aset yang dipinjam.</cite></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click","#detailData",function(){
            var id          = $(this).data('id');
            var aset        = $(this).data('aset');
            var tglpinjam   = $(this).data('tglpinjam');
            var tglbts      = $(this).data('btspinjam');
            var tglkembali  = $(this).data('tglkembali');
            if(tglkembali == "30-Nov--0001"){
                var pengembalian = "<i class='far fa-question-circle ml-3 text-danger'></i>"
            }else var pengembalian = tglkembali; 
            var user        = $(this).data('user');
            var operator    = $(this).data('operator');
            var operator2    = $(this).data('operator2');
            if(operator2 == ""){
                var operate = "<i class='far fa-question-circle ml-3 text-danger'></i>";
            }else var operate = operator2; 
            var input      = $(this).data('tglinput'); 
            if(input == "30-11--0001 00:00:00"){
                var tglinput = "<i class='far fa-question-circle ml-3 text-danger'></i>";
            }else var tglinput = input;  
            var update      = $(this).data('tglupdate'); 
            if(update == "30-11--0001 00:00:00"){
                var tglupdate = "<i class='far fa-question-circle ml-3 text-danger'></i>";
            }else var tglupdate = update;      

            $("#idTrx").html('<h5 class="widget-user-username">'+id+'</h5>');
            $("#detailAset").html('<ul class="nav flex-column"><li class="nav-item" id="aset"><a href="javascript:void(0)" class="nav-link custom">ID Aset : '+aset+'</a></li><li class="nav-item" id="tglpinjam"><a href="javascript:void(0)" class="nav-link custom">Tgl Peminjaman : '+tglpinjam+' s/d '+tglbts+'</a></li><li class="nav-item" id="tglkembali"><a href="javascript:void(0)" class="nav-link custom">Tgl Pengembalian : '+pengembalian+'</a></li><li class="nav-item" id="user"><a href="javascript:void(0)" class="nav-link custom">User : '+user+'</a></li><li class="nav-item" id="operator"><a href="javascript:void(0)" class="nav-link custom"><span class="mr-5">Operator : '+operator+'</span> <span class="ml-4">Operator Update : '+operate+'</span></a> </li><li class="nav-item" id="update"><a href="javascript:void(0)" class="nav-link custom"> <span>Tgl Input : '+tglinput+'</span> | <span class="ml-2"> Update : '+tglupdate+'</span></a></li></ul>');
                            
        })
    </script>
<!-- /. Modal Detail -->

<!-- Modal Custom Download  -->
<div class="modal fade" id="modalCustom">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-search"></i> Filter Transaksi Peminjaman </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=site_url('LaporanPdf/downloadFilterTrx')?>" method="post" target="_blank">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jenis Aset</label>
                            <select class="custom-select" style="width: 100%;" name="aset" id="kategori" required>
                                <option selected="selected" disabled>- Pilih -</option>
                                <option value="1">LAPTOP</option>
                                <option value="2">MONITOR</option>
                                <option value="3">PRINTER</option>
                            </select>                                                  
                        </div>
                        <div class="form-group">
                            <label for="ram">Transaksi Peminjaman</label>
                            <div class="input-group mb3 date" id="datetimepicker7" data-target-input="nearest">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" data-target="#datefilter2" data-toggle="datefilter2"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input type="text" class="form-control" name="tglfilter" id="datefilter2" required/>
                            </div>                            
                        </div>
                        
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="cari" id="btncari"> <i class="fas fa-search"></i> Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>   
    <script>
        $(document).on("click","#customData",function(){
            $("#btncari").attr("disabled",'disabled');
            $("#kategori").change(function(){
                $("#btncari").attr("disabled",false);
            })

        })
        $(document).on("click","#cari",function(){
            location.reload();
        })
    </script>

<!-- /. Modal Custom -->


