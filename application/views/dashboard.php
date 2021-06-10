<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <!-- <li class="breadcrumb-item active">Blank Page</li> -->
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
        Selamat datang di aplikasi Visualisasi Managemen Aset.
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        <?= gmdate("d F Y", time()+60*60*7);?>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    <div class="container-fluid">
        <h5>History Peminjaman Aset</h5>
        <!-- Timelime example  -->
        <div class="row">
            <div class="col-md-12">
                <!-- The time line -->
                <div class="timeline">
                <!-- timeline time label -->
                <?php foreach ($row as $data) { ?>
                    
                    <div class="time-label">
                        <span class="bg-secondary"><?=date("d M Y",strtotime($data['tgl_pinjam'])) ?></span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i><?=date("H:i",strtotime($data['tgl_trx_input'])) ?></span>
                            <h3 class="timeline-header"><a href="javascript:void(0)"><?=$data['id_aset']?></a> - peminjaman baru</h3>

                            <div class="timeline-body">
                                <ul>
                                    <li>Tanggal Peminjaman : <?=date("d M Y",strtotime($data['tgl_pinjam'])) ?></li>
                                    <li>Batas Peminjaman : <?=date("d M Y",strtotime($data['tgl_bts_pinjam'])) ?></li>
                                    <li>Tanggal Pengembalian : <?= $data['tgl_kembali'] == "0000-00-00" ? '<i class="far fa-question-circle text-danger"></i>' : date("d M Y",strtotime($data['tgl_kembali']))  ?></li>
                                </ul>
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-info btn-sm" id="detailData" data-toggle="modal" data-target="#modalDetail" data-id="<?=$data['id_pinjam']?>" data-aset="<?=$data['id_aset']?>" data-tglpinjam="<?=date("d-M-Y",strtotime($data['tgl_pinjam']))?>" data-btspinjam="<?=date("d-M-Y",strtotime($data['tgl_bts_pinjam']))?>" data-tglkembali="<?=date("d-M-Y",strtotime($data['tgl_kembali']))?>" data-operator="<?=$data['operator']?>" data-operator2="<?=$data['operator_update']?>" data-tglinput="<?=date("d-m-Y H:i:s",strtotime($data['tgl_trx_input']))?>" data-tglupdate="<?=date("d-m-Y H:i:s",strtotime($data['tgl_trx_update']))?>">Detail</a>
                                <!-- <a class="btn btn-danger btn-sm">Delete</a> -->
                            </div>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    
                
                <?php } ?>
                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                    </div>
            </div>
        </div>
        <!-- /.col -->
        </div>
    </div>
    <!-- /.timeline -->

</section>
<!-- /.content -->

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
    <script src="<?=base_url();?>assets/js/jqueryv3.2.1.min.js" type="text/javascript"></script>
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
            $("#detailAset").html('<ul class="nav flex-column"><li class="nav-item" id="aset"><a href="javascript:void(0)" class="nav-link custom">ID Aset : '+aset+'</a></li><li class="nav-item" id="tglpinjam"><a href="javascript:void(0)" class="nav-link custom">Tgl Peminjaman : '+tglpinjam+' s/d '+tglbts+'</a></li><li class="nav-item" id="tglkembali"><a href="javascript:void(0)" class="nav-link custom">Tgl Pengembalian : '+pengembalian+'</a></li><li class="nav-item" id="operator"><a href="javascript:void(0)" class="nav-link custom"><span class="mr-5">Operator : '+operator+'</span> <span class="ml-4">Operator Update : '+operate+'</span></a> </li><li class="nav-item" id="update"><a href="javascript:void(0)" class="nav-link custom"> <span>Tgl Input : '+tglinput+'</span> | <span class="ml-2"> Update : '+tglupdate+'</span></a></li></ul>');
                            
        })
    </script>
<!-- /. Modal Detail -->