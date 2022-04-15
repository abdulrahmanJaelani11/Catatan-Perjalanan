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
                        <form action="" class="id_catatan" method="post">
                            <input type="hidden" name="id" value="<?= $row['id_catatan']; ?>">
                            <button type="submit" name="hapus" class="btn btn-danger btn-sm btn-block"> Hapus </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>