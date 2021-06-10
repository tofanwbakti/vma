<script src="<?=base_url();?>assets/js/jqueryv3.2.1.min.js" type="text/javascript"></script>
<script>
    function checkUsername(){
        jQuery.ajax({
            url : "<?=base_url()?>Admin/cekUname",
            data : 'username='+$("#username").val(),
            type : "POST",
            success : function(data){
                $("#cekDataUname").html(data);
            },
            error:function(){}
        });
    };
</script>

<style>
    .password{
        position: relative;
    }
    .password input[type="password"]{
    padding-right: 30px;
    }
    .password .icon,#password2 .icon {
        display: none;
        right: 15px;
        position: absolute;
        top: 15px;
        cursor:pointer;
        color: rgba(105,221,201,1);    
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Data User</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Data User</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Flash Data -->
<div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash'); ?>"></div>
<div class="flashErr" data-flashdata="<?=$this->session->flashdata('flash_error'); ?>"></div>

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
        Selamat datang, berikut daftar user pengguna aplikasi.
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        <?= gmdate("d F Y", time()+60*60*7);?>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Table Data User Aplikasi</h3>
                    <a href="<?=site_url('LaporanPDF/downloadUser')?>" target="_blank" id="addUser" type="button" class="btn btn-outline-danger btn-sm float-right" style="margin-left:5px"> <i class="fas fa-cloud-download-alt"></i> Download</a>
                    <a class="btn btn-outline-info btn-sm float-right" href="#" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-user-plus"></i> Tambah</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Level</th>
                                <th>Update</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;
                        foreach ($row as $data) { ?>
                            <tr <?=$data['stts_user'] == "N" ? "class='table-danger'" : null ?>>
                                <td><?=$no++?></td>
                                <td><?=$data['username']?></td>
                                <td><?=$data['fullname']?></td>
                                <td><?=$data['nama_level']?></td>
                                <td><small><cite><?=date("d-m-Y H:i:s",strtotime($data['tgl_input']))?></cite></small></td>
                                <td class="text-center">
                                    <a href="#" id="editUser" type="button" class="btn btn-outline-info btn-xs" rel="tooltip" title="Edit" data-toggle="modal" data-target="#modalEdit" data-id="<?=$data['id_user']?>" data-fullname="<?=$data['fullname']?>" data-level="<?=$data['userlevel']?>"><i class="fas fa-edit"></i></a> 
                                    <?php if($data['stts_user'] == "N") {
                                        echo "<a href='".site_url('Admin/switchStatus/').encrypt_url($data['id_user']).'/'.encrypt_url($data['stts_user'])."' type='button' class='btn btn-outline-success btn-xs switch' rel='tooltip' title='Buka'><i class='fas fa-unlock-alt'></i></a>";
                                    }else{
                                        echo "<a href='".site_url('Admin/switchStatus/').encrypt_url($data['id_user']).'/'.encrypt_url($data['stts_user'])."' type='button' class='btn btn-outline-danger btn-xs switch' rel='tooltip' title='Tutup'><i class='fas fa-lock'></i></a>";

                                    }?>
                                    <a href="#" id="resetPass" type="button" class="btn btn-outline-secondary btn-xs" rel="tooltip" title="Reset" data-toggle="modal" data-target="#modalResetPass" data-id="<?=$data['id_user']?>" data-uname="<?=$data['username']?>"><i class="fas fa-key"></i></a>
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
<!-- /.content -->

<!-- Modal Tambah  -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-user-plus"></i> Tambah User Aplikasi </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=site_url('Admin/tambahUser')?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fullname">Nama Lengkap</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" onblur="checkUsername()" required>
                        </div>
                        <small><cite id="cekDataUname"></cite></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" maxlength="10" required>
                        </div>
                        <small><cite class="text-danger">* Maks. 10 Karakter</cite></small>
                    </div>
                    <div class="form-group">
                        <label>User Level</label>
                        <select class="form-control select2bs4" style="width: 100%;" name="level" id="level" required>
                            <option selected="selected"disabled>- Pilih -</option>
                            <?php foreach ($rowlvl as $dtlvl) {?>
                                <option value="<?=$dtlvl['kode_level']?>"><?=$dtlvl['kode_level']?> - <?=$dtlvl['nama_level']?></option>
                            <?php }?>
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

<!-- Modal Edit  -->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title"><i class="fas fa-user-edit"></i> Edit Data User </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=site_url('Admin/editUser')?>" method="post">
                <div class="modal-body" id="bodyModalEdit">
                    <input type="hidden" class="form-control" id="iduser" name="iduser" required>
                    <div class="form-group">
                        <label for="fullname">Nama Lengkap</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>User Level</label>
                        <select class="form-control" style="width: 100%;" name="level" id="level" required>
                            <option selected="selected"disabled>- Pilih -</option>
                            <?php foreach ($rowlvl as $dtlvl) {?>
                                <option value="<?=$dtlvl['kode_level']?>"><?=$dtlvl['kode_level']?> - <?=$dtlvl['nama_level']?></option>
                            <?php }?>
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
<script>
    $(document).on("click","#editUser",function(){
        var id = $(this).data('id');
        var fullname = $(this).data('fullname');
        var level = $(this).data('level');

        $("#bodyModalEdit #iduser").val(id);
        $("#bodyModalEdit #fullname").val(fullname);
        $("#bodyModalEdit #level").val(level);

    })
</script>

<!-- Modal Reset Password  -->
<div class="modal fade" id="modalResetPass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title"><i class="fas fa-key"></i> Reset Password User </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=site_url('Admin/resetPass')?>" method="post">
                <div class="modal-body" id="bodyModalReset">
                    <input type="hidden" class="form-control" id="iduser" name="iduser" required>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group mb3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userpass">Password</label>
                        <div class="input-group mb3 password">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" id="userpass" name="userpass" onchange="lihat()" required>
                            <span><i class="fas fa-eye icon"></i></span>
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
<script>
    $(document).on("click","#resetPass",function(){
        var id = $(this).data('id');
        var uname = $(this).data('uname');

        $("#bodyModalReset #iduser").val(id);
        $("#bodyModalReset #username").val(uname);
        $("#bodyModalReset #userpass").val('');

    });
    //Untuk menampilkan icon mata inputan password
    function lihat(){
        let x = document.getElementById("userpass");
        if(x.value == ""){
            $(".icon").hide();
        }else{
            $(".icon").show();
        }
    };

    //Untuk Melihat inputan password
    $(".icon").mousedown(function(){
        $("#userpass").attr('type','text');
    }).mouseup(function(){
        $("#userpass").attr('type','password');
    }).mouseout(function(){
        $("#userpass").attr('type','password');
    });
</script>

