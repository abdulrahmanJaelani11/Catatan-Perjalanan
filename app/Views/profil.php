<?= $this->extend('template/main'); ?>

<?= $this->section("container"); ?>
<div class="row">
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12" style="display: none;" id="cardImg">
                <div class="card shadow mt-2">
                    <div class="card-body">
                        <form action="Profil/ubahImg" id="formImg" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-10">
                                    <input type="file" name="img" class="form-control form-control-sm" class="is-invalid" required>
                                    <input type="hidden" name="id" class="form-control form-control-sm" value="<?= session('id'); ?>">
                                </div>
                                <div class="col-2">
                                    <button type="submit" name="save" class="btn btn-sm btn-primary btn-block"> save </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card shadow mt-2">
                    <div class="card-body">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('pesan'); ?>
                            </div>
                        <?php endif ?>
                        <?php if (session()->getFlashdata('sukses')) : ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('sukses'); ?>
                            </div>
                        <?php endif ?>
                        <img id="img" style="cursor: pointer;" src="<?= base_url("assets"); ?>/img/pp/<?= $data['img']; ?>" class="d-block mx-auto img-fluid rounded-circle img-thumbnail" alt="<?= session("nik"); ?>">
                        <h3 class="mt-3 font-weight-bold text-dark text-center" id="username"><?= $data['namaLengkap']; ?></h3>
                        <hr>
                        <button type="submit" name="" class="btn btn-sm btn-block btn-danger"> Hapus Akun </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card shadow mt-2" style="margin-bottom: 60px;">
            <div class="card-header">
                <h3 class="font-weight-bold text-uppercase h4">Ubah Informasi Anda</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('Profil/ubahInfo'); ?>" method="post" enctype="multipart/form-data" id="formInfo">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="hidden" name="id" id="id" value="<?= session('id') ?>">
                        <input type="number" name="nik" id="nik" class="form-control" autocomplete="off" readonly="" value="<?= $data['nik']; ?>">
                        <div class="invalid-feedback invalid-nik"></div>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" readonly="" value="<?= $data['namaLengkap']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="telepon" name="telepon" id="telepon" class="form-control" autocomplete="off" readonly="" value="<?= $data['telepon']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" coba="" id="alamat" class="form-control" aria-label="Text input with checkbox" readonly="" autocomplete="off" value="<?= $data['alamat']; ?>">
                    </div>
                    <div class="form-group">
                        <button type="button" id="ubah" class="btn btn-primary"> Ubah </button>
                        <button type="submit" id="simpan" name="ubah" class="btn btn-primary" disabled=""> <i class="fa fa-fw fa-save"></i> Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {

        $("#ubah").click(function(e) {
            if ($("#simpan").prop("disabled")) {
                $("#nik").prop("readonly", false);
                $("#nama").prop("readonly", false);
                $("#telepon").prop("readonly", false);
                $("#alamat").prop("readonly", false);
                $("#simpan").removeAttr('disabled')
                $(this).text("Batal")
            } else {
                $("#nik").prop("readonly", true);
                $("#nama").prop("readonly", true);
                $("#telepon").prop("readonly", true);
                $("#alamat").prop("readonly", true);
                $("#simpan").prop('disabled', true)
                $(this).text("Ubah")
            }
        })

        $('#formInfo').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    if (response.errors) {
                        if (response.errors.nik) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.errors.nik,
                            })
                        }
                        if (response.errors.telepon) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.errors.telepon,
                            })
                        }
                        if (response.errors.telp) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.errors.telp,
                            })
                        }
                        if (response.errors.img) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.errors.img,
                            })
                        }
                    }
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Berhasil Mengubah Data',
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            denyButtonText: `Don't save`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                $("#nik").prop("readonly", true);
                                $("#nama").prop("readonly", true);
                                $("#telepon").prop("readonly", true);
                                $("#alamat").prop("readonly", true);
                                $("#simpan").prop('disabled', true)
                                $(this).text("Ubah")
                                $("#username").text(response.nama)
                                $(".namaNav").text(response.nama)
                                $(".sambut").text("Anda login Sebagai " + response.nama)
                                // Swal.fire('Saved!', '', 'success')
                                // document.location = '<?= base_url('Auth'); ?>'
                            }
                        })
                    }
                }
            });
        })

        $("#img").click(function() {
            $('#cardImg').slideToggle('fast')
        })
        // $("#formImg").on('submit', function(e) {
        //     e.preventDefault()
        //     $.ajax({
        //         url: $(this).attr('action'),
        //         type: $(this).attr('method'),
        //         data: $(this).serialize(),
        //         success: function(data) {
        //             console.log(data)
        //         }
        //     });
        // })

        // $("#nik").keyup(function() {
        //     $.ajax({
        //         type: "post",
        //         url: "proses/prosesCariNik.php",
        //         data: {
        //             data: $(this).val(),
        //             nik: 3205101112030006
        //         },
        //         success: function(response) {
        //             // console.log(response)
        //             if (response == "tidakAda") {
        //                 $("#nik").removeClass('is-invalid');
        //                 $("#nik").addClass('is-valid');
        //             }
        //             if (response == "ok") {
        //                 $("#nik").removeClass('is-invalid');
        //                 $("#nik").addClass('is-valid');
        //             }
        //             if (response == "ada") {
        //                 $("#nik").removeClass('is-valid');
        //                 $("#nik").addClass('is-invalid');
        //                 $(".invalid-nik").text('Nik Sudah terdaftar')
        //             }
        //             if (response == "nikInvalid") {
        //                 $("#nik").removeClass('is-valid');
        //                 $("#nik").addClass('is-invalid');
        //                 $(".invalid-nik").text('Nik Salah')
        //             }
        //         }
        //     });
        // })
    })
</script>
<?= $this->endSection(); ?>