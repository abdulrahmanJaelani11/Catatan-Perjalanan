<?= $this->extend('template/mainAdmin'); ?>

<?= $this->section('container'); ?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4>Data Catatan <?= $user['namaLengkap']; ?></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Lokasi</th>
                                <th>Suhu</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if (count($catatan) > 0) : ?>
                                <?php foreach ($catatan as $row) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row['namaLengkap']; ?></td>
                                        <td><?= $row['tanggal']; ?></td>
                                        <td><?= $row['jam']; ?></td>
                                        <td><?= $row['lokasi']; ?></td>
                                        <td><?= $row['suhu']; ?></td>
                                        <td><?= $row['keterangan']; ?></td>
                                        <td>
                                            <form action="<?= base_url("Catatan/hapusCatatan"); ?>" class="id_catatan" method="post">
                                                <input type="hidden" name="id" value="<?= $row['id_catatan']; ?>">
                                                <button type="submit" name="hapus" class="btn btn-danger btn-sm btn-block"> Hapus </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <h4 class="text-center mb-3">Catatan Masih Kosong</h4>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    function getTable() {
        $.ajax({
            type: "post",
            url: "<?= base_url("Catatan/getCatatan"); ?>",
            data: {
                id: <?= $user['id']; ?>
            },
            dataType: "json",
            success: function(response) {
                $("#table").html(response)
            }
        });
    }
    $(document).ready(function() {

        $(".id_catatan").on('submit', function(e) {
            e.preventDefault()

            Swal.fire({
                title: 'Yakin?',
                text: "Apakah Anda Yakin untuk Menghapus Data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Yakin!',
                cancelButtonText: "Kembali"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            console.log(data)
                            if (data.sukses) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: "Berhasil Menghapus Data",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location = "<?= base_url('Pengguna/' . $user['id']); ?>"
                                    }
                                })

                            }
                        }
                    });
                }
            })
        })
    })
</script>
<?= $this->endSection(); ?>