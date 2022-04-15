<?= $this->extend('template/main'); ?>

<?= $this->section('container'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="text-dark text-uppercase font-weight-bold h5">Catatan Perjalanan</h4>
            </div>
            <div class="card-body">
                <a href="<?= base_url("IsiCatatan"); ?>" name="kirim" class="btn btn-primary btn-sm mb-2"> <i class="fa fa-fw fa-clipboard-list"></i> Isi Catatan </a>
                <div class="row">
                    <div class="col-lg-4">
                        <form class="my-2">
                            <div class="input-group">
                                <input id="InputCari" type="text" class="form-control bg-light border-0 small" placeholder="Cari Riwayat..." autofocus>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="tabel">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th> Lokasi</th>
                                    <th>Suhu Tubuh</th>
                                    <th> Keterangan</th>
                                    <th> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($catatan as $row) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row['tanggal']; ?></td>
                                        <td><?= $row['jam']; ?></td>
                                        <td><?= $row['lokasi']; ?></td>
                                        <td><?= $row['suhu']; ?></td>
                                        <td><?= $row['keterangan']; ?></td>
                                        <td width="150px">
                                            <button type="submit" name="detail" class="btn btn-sm btn-info btn-block"> Detail </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('#InputCari').keyup(function() {
            $.ajax({
                url: "Catatan/cariData",
                type: "post",
                dataType: "json",
                data: {
                    data: $("#InputCari").val()
                },
                success: function(data) {
                    // console.log(data)
                    $('#tabel').html(data);
                }
            });
        })
    })
</script>
<?= $this->endSection(); ?>