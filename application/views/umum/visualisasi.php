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
        Selamat datang di aplikasi Visualisasi Manajemen Aset.
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
                    <h3 class="card-title">Visualisasi Manajemen Aset Tahun <?= gmdate("Y", time()+60*60*7);?></h3>

                    <div class="card-tools">
                    <a href="#" id="customData" class="btn btn-tool bg-gradient-danger btn-sm" rel="tooltip" title="Custom Filter" data-toggle="modal" data-target="#modalCustom"><i class="fas fa-search"></i> Custom</a>
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
                <cite>* Total peminjaman aset per bulan</cite>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
<?php 
// Laptop
$year 	= gmdate("Y", time()+60*60*7);
    #Januari
    $month = $year.'-01';
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $this->db->like('id_aset',"ICT-1");
    $janlt =$this->db->count_all_results();
    #Gebruari
    $month = $year.'-02';
    $this->db->like('id_aset',"ICT-1");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $feblt =$this->db->count_all_results();
    #Maret
    $month = $year.'-03';
    $this->db->like('id_aset',"ICT-1");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $marlt =$this->db->count_all_results();
    #April
    $month = $year.'-04';
    $this->db->like('id_aset',"ICT-1");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $aprlt =$this->db->count_all_results();
    #Mei
    $month = $year.'-05';
    $this->db->like('id_aset',"ICT-1");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $meilt =$this->db->count_all_results();
    #Juni
    $month = $year.'-06';
    $this->db->like('id_aset',"ICT-1");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $junlt =$this->db->count_all_results();
    #Juli
    $month = $year.'-07';
    $this->db->like('id_aset',"ICT-1");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $jullt =$this->db->count_all_results();
    #Agustus
    $month = $year.'-08';
    $this->db->like('id_aset',"ICT-1");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $agslt =$this->db->count_all_results();
    #September
    $month = $year.'-09';
    $this->db->like('id_aset',"ICT-1");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $seplt =$this->db->count_all_results();
    #Oktober
    $month = $year.'-10';
    $this->db->like('id_aset',"ICT-1");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $oktlt =$this->db->count_all_results();
    #November
    $month = $year.'-11';
    $this->db->like('id_aset',"ICT-1");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $novlt =$this->db->count_all_results();
    #Desember
    $month = $year.'-12';
    $this->db->like('id_aset',"ICT-1");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $deslt =$this->db->count_all_results();

// MONITOR
    $month = $year.'-01';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $janmt =$this->db->count_all_results();
    #Gebruari
    $month = $year.'-02';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $febmt =$this->db->count_all_results();
    #Maret
    $month = $year.'-03';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $marmt =$this->db->count_all_results();
    #April
    $month = $year.'-04';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $aprmt =$this->db->count_all_results();
    #Mei
    $month = $year.'-05';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $meimt =$this->db->count_all_results();
    #Juni
    $month = $year.'-06';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $junmt =$this->db->count_all_results();
    #Juli
    $month = $year.'-07';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $julmt =$this->db->count_all_results();
    #Agustus
    $month = $year.'-08';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $agsmt =$this->db->count_all_results();
    #September
    $month = $year.'-09';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $sepmt =$this->db->count_all_results();
    #Oktober
    $month = $year.'-10';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $oktmt =$this->db->count_all_results();
    #November
    $month = $year.'-11';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $novmt =$this->db->count_all_results();
    #Desember
    $month = $year.'-12';
    $this->db->like('id_aset',"ICT-2");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $desmt =$this->db->count_all_results();

// PRINTER
    $month = $year.'-01';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $janpt =$this->db->count_all_results();
    #Gebruari
    $month = $year.'-02';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $febpt =$this->db->count_all_results();
    #Maret
    $month = $year.'-03';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $marpt =$this->db->count_all_results();
    #April
    $month = $year.'-04';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $aprpt =$this->db->count_all_results();
    #Mei
    $month = $year.'-05';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $meipt =$this->db->count_all_results();
    #Juni
    $month = $year.'-06';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $junpt =$this->db->count_all_results();
    #Juli
    $month = $year.'-07';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $julpt =$this->db->count_all_results();
    #Agustus
    $month = $year.'-08';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $agspt =$this->db->count_all_results();
    #September
    $month = $year.'-09';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $seppt =$this->db->count_all_results();
    #Oktober
    $month = $year.'-10';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $oktpt =$this->db->count_all_results();
    #November
    $month = $year.'-11';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $novpt =$this->db->count_all_results();
    #Desember
    $month = $year.'-12';
    $this->db->like('id_aset',"ICT-3");
    $this->db->like('tgl_pinjam',$month);
    $this->db->from('tb_trx_pinjam');
    $despt =$this->db->count_all_results();

?>

</section>


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
    labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul','Ags','Sep','Okt','Nov','Des'],
    datasets: [
        {
            label               : 'Laptop',
            backgroundColor     : 'rgba(60,141,188,0.4)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : [<?= $janlt;?>, <?= $feblt;?>, <?= $marlt;?>, <?= $aprlt;?>, <?= $meilt;?>, <?= $junlt;?>, <?= $jullt;?>, <?= $agslt;?>, <?= $seplt;?>, <?= $oktlt;?>, <?= $novlt;?>, <?= $deslt;?>],
            // data                : [0,80,66,34,],
            fill                : false,
            tension: 0.1
        },
        {
            label               : 'Monitor',
            backgroundColor     : 'rgba(92,184,92,0.4)',
            borderColor         : 'rgba(92,184,92,1)',
            pointRadius         : false,
            pointColor          : 'rgba(92,184,92,1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [<?= $janmt;?>, <?= $febmt;?>, <?= $marmt;?>, <?= $aprmt;?>, <?= $meimt;?>, <?= $junmt;?>, <?= $julmt;?>, <?= $agsmt;?>, <?= $sepmt;?>, <?= $oktmt;?>, <?= $novmt;?>, <?= $desmt;?>],
            fill                : false,
            tension: 0.1
        },
        {
            label               : 'Printer',
            backgroundColor     : 'rgba(253,207,78,0.4)',
            borderColor         : 'rgba(253,207,78,1)',
            pointRadius         : false,
            pointColor          : 'rgba(253,207,78,1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [<?= $janpt; ?>, <?= $febpt; ?>, <?= $marpt; ?>, <?= $aprpt; ?>, <?= $meipt; ?>, <?= $junpt; ?>, <?= $julpt; ?>, <?= $agspt; ?>, <?= $seppt; ?>, <?= $oktpt; ?>, <?= $novpt; ?>, <?= $despt; ?>],
            fill                : false,
            tension: 0.1
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