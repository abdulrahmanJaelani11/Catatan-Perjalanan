<?= $this->extend('template/mainAdmin'); ?>

<?= $this->section('container'); ?>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-2">
        <a href="<?= base_url("Pengguna"); ?>" style="text-decoration: none;">
            <div class="card border-left-primary shadow h-100 py-2" data-tilt data-tilt-scale="1.1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahUsers; ?> Orang</div>
                        </div>
                        <div class="col-auto">
                            <img src="<?= base_url('assets'); ?>/img/list.png" class="img-fluid" width="80">
                            <!-- <i class="fas fa-book-open fa-2x text-primary"></i> -->
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-2">
        <div class="card border-left-success shadow h-100 py-2" data-tilt data-tilt-glare data-tilt-max-glare="0.8">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Catatan Keseluruhan
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlahCatatan; ?></div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $jumlahCatatan ?>%" aria-valuenow="<?= $jumlahCatatan ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <img src="<?= base_url('assets'); ?>/img/listAll.png" class="img-fluid">
                        <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-4 col-md-6 mb-2">
        <div class="card border-left-warning shadow h-100 py-2" data-tilt="">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            CATATAN PERJALANAN</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">PEDULI DIRI</div>
                    </div>
                    <div class="col-auto">
                        <img src="<?= base_url('assets'); ?>/img/catat.png" class="img-fluid">
                        <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">


    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="myPieChart" width="962" height="416" style="display: block; height: 208px; width: 481px;" class="chartjs-render-monitor"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Jumlah Pengguna
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Catatan Keseluruhan
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-7 mb-4">
        <!-- Project Card Example -->
        <div class="card shadow mb-4" data-tilt data-tilt-glare data-tilt-max-glare="0.8">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #090979;">Data</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Jumlah Seluruh Catatan <span class="float-right"><?= $jumlahCatatan; ?></span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: <?= $jumlahCatatan ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">Jumlah Pengguna<span class="float-right"><?= $jumlahUsers; ?></span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $jumlahUsers ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Pengguna", "Catatan"],
            datasets: [{
                data: [<?= $jumlahUsers; ?>, <?= $jumlahCatatan; ?>],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
</script>
<?= $this->endSection(); ?>