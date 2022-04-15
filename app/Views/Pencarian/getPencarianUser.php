<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>
                    <i class="fa fa-number"></i>
                    No
                </th>
                <th>Foto</th>
                <th>Nama</th>
                <th> Nik</th>
                <th>Telepon</th>
                <th> Alamat</th>
                <th> Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php if ($user) : ?>
                <?php foreach ($user as $row) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><img src="<?= base_url('assets'); ?>/img/pp/<?= $row['img']; ?>" class="rounded-circle d-block mx-auto" width="50px"></td>
                        <td><?= $row['namaLengkap']; ?></td>
                        <td><?= $row['nik']; ?></td>
                        <td><?= $row['telepon']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td>
                            <button type="submit" name="detail" class="btn btn-info btn-sm btn-block"> Detail </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
        </tbody>
    </table>
    <h4 class="text-center">Data Tidak Ditemukan</h4>
<?php endif ?>
</div>