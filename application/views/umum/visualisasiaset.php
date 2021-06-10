<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Visualisasi</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Visualisasi</li>
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
        <h3 class="card-title">Hi, </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
        </div>
        <div class="card-body">
        Selamat datang, berikut visualisasi management aset untuk kategori <?= $kat?>, antara tanggal <?= date("d-M-Y",strtotime($awal))?> sampai dengan <?= date("d-M-Y",strtotime($akhir))?>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        <?= gmdate("d F Y", time()+60*60*7);?>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    <div class="row">
        <div class="col-md-12">
            <!-- AREA CHART -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Visualisasi Manajemen Aset <?= $kat?></h3>

                    <div class="card-tools">
                    <a href="#" id="customData" class="btn btn-tool bg-gradient-danger btn-sm" rel="tooltip" title="Custom Filter" data-toggle="modal" data-target="#modalCustom"><i class="fas fa-search"></i> Custom</a>
                    <a href="<?=site_url('Umum')?>" class="btn btn-tool bg-gradient-danger btn-sm" rel="tooltip" title="Reset Filter"><i class="fas fa-undo"></i> Reset</a>
                    <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button> -->
                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas> 
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <cite>* Periode <?= date("d-M-Y",strtotime($awal))?> s/d <?= date("d-M-Y",strtotime($akhir))?></cite>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

</section>
<?php
    $tmpid = "";
    $jumlah = "";
    foreach ($row as $data) {
        $id     = $data->id_aset;
        $tmpid  .= "'$id'". ", ";
        // $tgl     = date("d-m-Y",strtotime($data->tgl_pinjam));
        // $tmptgl  .= "'$tgl'". ", ";
        $jum    =$data->total;
        $jumlah .= "$jum". ", "; 
    }


?>


<!-- ChartJS -->
<script src="<?=base_url()?>assets/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>assets/AdminLTE-3.0.5/plugins/chart.js/Chart.min.js"></script>

<!-- <script src="<?php echo base_url()?>assets/js/dashboard.js"></script> -->

<script>
// <!-- Grafik Chart -->
$(function () {

// 'use strict'
/* Chart.js Charts */
// Sales chart
var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
//$('#revenue-chart').get(0).getContext('2d');

var salesChartData = {
labels  : [<?php echo $tmpid; ?>],
datasets: [
    {
        label               : '',
        backgroundColor     : 'rgba(60,141,188,0.4)',
        borderColor         : 'rgba(60,141,188,0.8)',      
        data                : [<?php echo $jumlah; ?>],
        tension             : 0.1
    },
    ]
}

var salesChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
    display: false
    },
    scales: {
        xAxes: [{
        gridLines : {
            display : true,
        }
        }],
        yAxes: [{
        gridLines : {
            display : true,
        }
        }]
    }
}

// This will get the first returned node in the jQuery collection.
var salesChart = new Chart(salesChartCanvas, { 
    type: 'line', 
    data: salesChartData, 
    options: salesChartOptions
    }
)

})
</script>
<!-- /.content -->


<!-- Modal Custom FILTER  -->
<div class="modal fade" id="modalCustom">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-search"></i> Filter Visualisasi Manajemen Aset </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=site_url('Umum/filterVisualisasiAset')?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jenis Aset</label>
                            <select class="custom-select" style="width: 100%;" name="aset" id="aset" required>
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
            $("#aset").change(function(){
                $("#btncari").attr("disabled",false);
            })

        })
    </script>



