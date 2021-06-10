<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Data Monitor</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Monitor</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card alert-dismissable"">
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
        Selamat datang, berikut daftar aset monitor. Monitor memiliki prefix ICT-2xxx .
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Table Data Aset Monitor</h3>
                    <a href="<?=site_url('LaporanPDF/downloadMonitor')?>" target="_blank" type="button" class="btn btn-outline-danger btn-sm float-right" style="margin-left:5px"> <i class="fas fa-cloud-download-alt"></i> Download</a>
                    <a class="btn btn-outline-info btn-sm float-right" href="#" data-toggle="modal" data-target="#modalTambah"><i class="far fa-plus-square"></i> Tambah</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID/Kode</th>
                                <th>Merk</th>
                                <th>SN</th>
                                <th>Display</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;
                        foreach ($row as $data) { ?>
                            <tr <?=$data['stts_monitor'] == "R" ? "class='table-danger'" : null ?>>
                                <td><?=$no++?></td>
                                <td>
                                    <a href="#" id="detailData" data-toggle="modal" data-target="#modalDetail" data-id="<?=$data['id_aset']?>" data-merk="<?=$data['merk_aset']?>" data-seri="<?=$data['sn_aset']?>" data-display="<?=$data['display_monitor']?>" data-input="<?=$data['tgl_input']?>"" data-update="<?=$data['tgl_update']?>" data-stts="<?=$data['stts_monitor']?>"> 
                                        <?=$data['id_aset']?> 
                                    </a>
                                </td>
                                <td><?=$data['merk_aset']?></td>
                                <td><?=$data['sn_aset']?></td>
                                <td><?=$data['display_monitor']?></td>
                                <td><?php if($data['stts_monitor'] == "B"){
                                    echo "BAIK";
                                } else if($data['stts_monitor'] == "R"){
                                    echo  "RUSAK";} else { echo "PERBAIKAN";}?></td>
                                <td class="text-center">
                                    <a href="#" id="editData" type="button" class="btn btn-outline-info btn-xs" rel="tooltip" title="Edit" data-toggle="modal" data-target="#modalEdit" data-id="<?=$data['id_aset']?>" data-merk="<?=$data['merk_aset']?>" data-seri="<?=$data['sn_aset']?>" data-display="<?=$data['display_monitor']?>" data-stts="<?=$data['stts_monitor']?>"><i class="fas fa-edit"></i></a>
                                    <?php if($data['stts_pinjam'] != "Y"){ ?>
                                    <a href="<?=site_url('Admin/hapusMonitor/').encrypt_url($data['id_aset'])?>" id="hapusData" type="button" class="btn btn-outline-danger btn-xs hapus" rel="tooltip" title="Hapus"><i class="far fa-trash-alt text-danger"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah  -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="far fa-plus-square"></i> Tambah Aset Monitor </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=site_url('Admin/tambahMonitor')?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="idmonitor">ID/Kode Monitor</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
                            </div>
                            <input type="text" class="form-control" id="idmonitor" name="idmonitor" value="<?=$rowId?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="merk">Merk Monitor</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                            </div>
                            <input type="text" class="form-control" id="merk" name="merk" onkeyup="this.value = this.value.toUpperCase()" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="seri">Serial Number</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                            </div>
                            <input type="text" class="form-control" id="seri" name="seri" onkeyup="this.value = this.value.toUpperCase()" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="display">Display (Inch)</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-desktop"></i></span>
                            </div>
                            <input type="number" class="form-control" id="display" name="display" required>
                        </div>
                    </div>                  
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="simpan" id="simpan"> <i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title"><i class="fas fa-edit"></i> Edit Data Aset Monitor </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=site_url('Admin/editMonitor')?>" method="post">
                <div class="modal-body" id="bodyModalEdit">
                    <div class="form-group">
                        <label for="idmonitor">ID/Kode Monitor</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
                            </div>
                            <input type="text" class="form-control" id="idmonitor" name="idmonitor" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="merk">Merk Monitor</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                            </div>
                            <input type="text" class="form-control" id="merk" name="merk" onkeyup="this.value = this.value.toUpperCase()" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="seri">Serial Number</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                            </div>
                            <input type="text" class="form-control" id="seri" name="seri" onkeyup="this.value = this.value.toUpperCase()" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="display">Display (Inch)</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-desktop"></i></span>
                            </div>
                            <input type="number" class="form-control" id="display" name="display" required>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label>Status Aset</label>
                        <select class="custom-select" style="width: 100%;" name="status" id="status" required>
                            <option selected="selected"disabled>- Pilih -</option>
                            <option value="B">BAIK</option>
                            <option value="R">RUSAK</option>
                            <option value="P">PERBAIKAN</option>
                        </select>                                                  
                    </div>                   
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="simpan" id="simpan"> <i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?=base_url();?>assets/js/jqueryv3.2.1.min.js" type="text/javascript"></script>
<script>
    $(document).on("click","#editData",function(){
        var id      = $(this).data('id');
        var merk    = $(this).data('merk');
        var seri    = $(this).data('seri');
        var display = $(this).data('display');
        var stts    = $(this).data('stts');

        $("#bodyModalEdit #idmonitor").val(id);
        $("#bodyModalEdit #merk").val(merk);
        $("#bodyModalEdit #seri").val(seri);
        $("#bodyModalEdit #display").val(display);
        $("#bodyModalEdit #status").val(stts);
    })
</script>

<!-- Modal Edit -->
<div class="modal fade" id="modalDetail">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header bg-info">
                <h4 class="modal-title"><i class="far fa-plus-square"></i> Detail Data Aset Laptop </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
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
                            <h5 class="widget-user-desc">Detail Aset Laptop</h5>
                            <h5 id="idMonitor"></h5>
                    </div>
                    <div class="card-footer p-0" id="detailAset">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on("click","#detailData",function(){
        var id      = $(this).data('id');
        var merk    = $(this).data('merk');
        var seri    = $(this).data('seri');
        var display = $(this).data('display');
        var input     = $(this).data('input');
        var update     = $(this).data('update'); 
        if(update == "0000-00-00 00:00:00"){
            var tglupdate = "-"
        }else var tglupdate = update;
        var stts    = $(this).data('stts');
        if(stts == "B"){
            var status = "BAIK";
        }else if(stts == "R"){
            var status = "RUSAK";
        }else var status = "PERBAIKAN";

        $("#idMonitor").html('<h5 class="widget-user-username">ID / Kode '+id+'</h5>');
        $("#detailAset").html('<ul class="nav flex-column"><li class="nav-item" id="merk"><a href="javascript:void(0)" class="nav-link custom">'+merk+'</a></li><li class="nav-item" id="seri"><a href="javascript:void(0)" class="nav-link custom">Serial Number : '+seri+'</a></li><li class="nav-item" id="processor"><a href="javascript:void(0)" class="nav-link custom">Display : '+display+' Inch</a></li><li class="nav-item" id="input"><a href="javascript:void(0)" class="nav-link custom">Tgl Input : '+input+'</a></li><li class="nav-item" id="update"><a href="javascript:void(0)" class="nav-link custom">Tgl Update : '+tglupdate+'</a></li><li class="nav-item" id="status"><a href="javascript:void(0)" class="nav-link custom">Status Kondisi : '+status+'</a></li></ul>');
                        
    })
</script>



<!-- /.content -->