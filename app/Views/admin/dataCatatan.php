<?= $this->extend('template/mainAdmin'); ?>

<?= $this->section('container'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bold text-dark">Data Catatan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($user as $row) : ?>
                        <div class="col-xl-3 col-md-6 mb-2">
                            <a href="<?= base_url("Pengguna/" . $row['id']); ?>" style="text-decoration: none;">
                                <div class="card border-left-primary shadow h-100 py-2" data-tilt data-tilt-scale="1.1">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    <?= $row['namaLengkap']; ?></div>
                                                <?php foreach ($catatan as $rows) : ?>
                                                    <?php if ($rows['id_user'] == $row['id']) : ?>
                                                        <?php $arr[] = $rows['id_user'] ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($arr)  ? count($arr) : '0' ?> Catatan</div>
                                            </div>
                                            <div class="col-auto">
                                                <img src="<?= base_url('assets'); ?>/img/pp/<?= $row['img']; ?>" class="img-fluid rounded-circle" width="80">
                                                <!-- <i class="fas fa-book-open fa-2x text-primary"></i> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>