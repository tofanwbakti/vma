<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Data Laptop</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Laptop</li>
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
        Selamat datang, berikut daftar aset laptop. Laptop memiliki prefix ICT-1xxx .
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
                    <h3 class="card-title">Table Data Aset Laptop</h3>
                    <a href="<?=site_url('LaporanPDF/downloadLaptop')?>" target="_blank" type="button" class="btn btn-outline-danger btn-sm float-right" style="margin-left:5px"> <i class="fas fa-cloud-download-alt"></i> Download</a>
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
                                <th>Processor</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;
                        foreach ($row as $data) { ?>
                            <tr <?=$data['stts_laptop'] == "R" ? "class='table-danger'" : null ?>>
                                <td><?=$no++?></td>
                                <td>
                                    <a href="#" id="detailData" data-toggle="modal" data-target="#modalDetail" data-id="<?=$data['id_aset']?>" data-merk="<?=$data['merk_aset']?>" data-seri="<?=$data['sn_aset']?>" data-processor="<?=$data['processor']?>" data-ram="<?=$data['ram']?>" data-hdd="<?=$data['hdd']?>" data-input="<?=$data['tgl_input']?>"" data-update="<?=$data['tgl_update']?>" data-stts="<?=$data['stts_laptop']?>"> 
                                        <?=$data['id_aset']?> 
                                    </a>
                                </td>
                                <td><?=$data['merk_aset']?></td>
                                <td><?=$data['sn_aset']?></td>
                                <td><?=$data['processor']?></td>
                                <td><?php if($data['stts_laptop'] == "B"){
                                    echo "BAIK";
                                } else if($data['stts_laptop'] == "R"){
                                    echo  "RUSAK";} else { echo "PERBAIKAN";}?></td>
                                <td class="text-center">
                                    <a href="#" id="editData" type="button" class="btn btn-outline-info btn-xs" rel="tooltip" title="Edit" data-toggle="modal" data-target="#modalEdit" data-id="<?=$data['id_aset']?>" data-merk="<?=$data['merk_aset']?>" data-seri="<?=$data['sn_aset']?>" data-processor="<?=$data['processor']?>" data-ram="<?=$data['ram']?>" data-hdd="<?=$data['hdd']?>" data-stts="<?=$data['stts_laptop']?>"><i class="fas fa-edit"></i></a>
                                    <?php if($data['stts_pinjam'] != "Y"){ 
                                    echo "<a href=".site_url('Admin/hapusLaptop/').encrypt_url($data['id_aset'])." id='hapusData' type='button' class='btn btn-outline-danger btn-xs hapus' rel='tooltip' title='Hapus'><i class='far fa-trash-alt text-danger'></i></a>";
                                    } ?>
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
                    <h4 class="modal-title"><i class="far fa-plus-square"></i> Tambah Aset Laptop </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=site_url('Admin/tambahLaptop')?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="idlaptop">ID/Kode Laptop</label>
                            <div class="input-group mb3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
                                </div>
                                <input type="text" class="form-control" id="idlaptop" name="idlaptop" value="<?=$rowId?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="merk">Merk Laptop</label>
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
                            <label for="processor">Processor</label>
                            <div class="input-group mb3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-microchip"></i></span>
                                </div>
                                <input type="text" class="form-control" id="processor" name="processor" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="ram">RAM (Memory)</label>
                                    <div class="input-group mb3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-memory"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="ram" name="ram" required>
                                    </div>
                                    <small><cite>*dalam satuan Gigabyte</cite></small>
                                </div>
                                <div class="col-lg-6">
                                    <label for="hdd">HDD / SSD</label>
                                    <div class="input-group mb3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hdd"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="hdd" name="hdd" required>
                                    </div>
                                    <small><cite>*dalam satuan Gigabyte</cite></small>
                                </div>
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
                <h4 class="modal-title"><i class="fas fa-edit"></i> Edit Data Aset Laptop </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=site_url('Admin/editLaptop')?>" method="post">
                <div class="modal-body" id="bodyModalEdit">
                    <div class="form-group">
                        <label for="idlaptop">ID/Kode Laptop</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
                            </div>
                            <input type="text" class="form-control" id="idlaptop" name="idlaptop" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="merk">Merk Laptop</label>
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
                        <label for="processor">Processor</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-microchip"></i></span>
                            </div>
                            <input type="text" class="form-control" id="processor" name="processor" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="ram">RAM (Memory)</label>
                                <div class="input-group mb3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-memory"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="ram" name="ram" required>
                                </div>
                                <small><cite>*dalam satuan Gigabyte</cite></small>
                            </div>
                            <div class="col-lg-6">
                                <label for="hdd">HDD / SSD</label>
                                <div class="input-group mb3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hdd"></i></span>
                                    </div>
                                    <input type="number" class="form-control" id="hdd" name="hdd" required>
                                </div>
                                <small><cite>*dalam satuan Gigabyte</cite></small>
                            </div>
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
        var processor = $(this).data('processor');
        var ram     = $(this).data('ram');
        var hdd     = $(this).data('hdd');
        var stts    = $(this).data('stts');

        $("#bodyModalEdit #idlaptop").val(id);
        $("#bodyModalEdit #merk").val(merk);
        $("#bodyModalEdit #seri").val(seri);
        $("#bodyModalEdit #processor").val(processor);
        $("#bodyModalEdit #ram").val(ram);
        $("#bodyModalEdit #hdd").val(hdd);
        $("#bodyModalEdit #status").val(stts);
    })
</script>

<!-- Modal Deatil -->
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
                                <h5 id="idLaptop"></h5>
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
            var processor = $(this).data('processor');
            var ram     = $(this).data('ram');
            var hdd     = $(this).data('hdd');
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

            $("#idLaptop").html('<h5 class="widget-user-username">ID / Kode '+id+'</h5>');
            $("#detailAset").html('<ul class="nav flex-column"><li class="nav-item" id="merk"><a href="javascript:void(0)" class="nav-link custom">'+merk+'</a></li><li class="nav-item" id="seri"><a href="javascript:void(0)" class="nav-link custom">Serial Number : '+seri+'</a></li><li class="nav-item" id="processor"><a href="javascript:void(0)" class="nav-link custom">Processor : '+processor+'</a></li><li class="nav-item" id="ram"><a href="javascript:void(0)" class="nav-link custom">RAM : '+ram+' Gb; HDD/SSD : '+hdd+' Gb</a></li><li class="nav-item" id="input"><a href="javascript:void(0)" class="nav-link custom">Tgl Input : '+input+'</a></li><li class="nav-item" id="update"><a href="javascript:void(0)" class="nav-link custom">Tgl Update : '+tglupdate+'</a></li><li class="nav-item" id="status"><a href="javascript:void(0)" class="nav-link custom">Status Kondisi : '+status+'</a></li></ul>');
                            
        })
    </script>



<!-- /.content -->