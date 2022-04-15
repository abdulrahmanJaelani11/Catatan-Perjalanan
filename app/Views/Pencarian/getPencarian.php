<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>
                    <i class="fa fa-number"></i>
                    No
                </th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th> Lokasi</th>
                <th>Suhu Tubuh</th>
                <th> Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php if ($catatan) : ?>
                <?php foreach ($catatan as $row) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $row['tanggal']; ?></td>
                        <td><?= $row['jam']; ?></td>
                        <td><?= $row['lokasi']; ?></td>
                        <td><?= $row['suhu']; ?></td>
                        <td><?= $row['keterangan']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
        </tbody>
    </table>
    <h4 class="text-center">Data Tidak Ditemukan</h4>
<?php endif ?>
</div>