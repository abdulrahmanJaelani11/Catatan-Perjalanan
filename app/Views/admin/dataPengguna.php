<?= $this->extend('template/mainAdmin'); ?>

<?= $this->section('container'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="text-dark text-uppercase font-weight-bold h5">Data Pengguna</h4>
            </div>
            <div class="card-body">
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
                                    <th> Foto</th>
                                    <th>Nama</th>
                                    <th>Nik</th>
                                    <th> Telepon</th>
                                    <th>Alamat</th>
                                    <th> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($dataUser as $row) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><img class="rounded-circle d-block mx-auto" src="<?= base_url('assets'); ?>/img/pp/<?= $row['img']; ?>" width="50px"></td>
                                        <td><?= $row['namaLengkap']; ?></td>
                                        <td><?= $row['nik']; ?></td>
                                        <td><?= $row['telepon']; ?></td>
                                        <td><?= $row['alamat']; ?></td>
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
                url: "Auth/cariUser",
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