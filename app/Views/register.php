<?= $this->extend('template/mainLogin'); ?>
<?= $this->section('card'); ?>
<div class="card shadow">
    <div class="card-body">
        <div class="p-4">
            <div class="text-center">
                <Span class="h2 text-primary font-weight-bold">Selamat Datang</Span>
                <div class="alert alert-success mt-3">
                    Selamat datang, Silahkan Daftar dengan menggunakan data yang valid
                </div>
            </div>
            <form action="<?= base_url('Auth/prosesRegister'); ?>" method="post" class="user mt-4">
                <div class="form-group">
                    <input type="number" name="nik" id="nik" class="form-control form-control-sm form-control-user" placeholder="Masukan NIK" autocomplete="off" autofocus required>
                    <div class="invalid-feedback invalid-nik"></div>
                    <div class="valid-feedback valid-nik"></div>
                </div>
                <div class="form-group">
                    <input type="text" name="nama" id="nama" class="form-control form-control-sm form-control-user" placeholder="Masukan Nama Lengkap" autocomplete="off" required>
                    <div class="invalid-feedback invalid-nama"></div>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control form-control-sm form-control-user" placeholder="Masukan password" autocomplete="off" required>
                    <div class="invalid-feedback invalid-password"></div>
                </div>
                <div class="form-group">
                    <input type="konfirmasi" name="konfirmasi" id="konfirmasi" class="form-control form-control-sm form-control-user" placeholder="Masukan konfirmasi password" autocomplete="off" required>
                    <div class="invalid-feedback invalid-konfirmasi"></div>
                </div>
                <div class="form-group pb-3">
                    <input type="checkbox" name="check" id="show" style="margin: 0;"><span style="font-size: small; margin-left:10px;" id="textShow">Tampilkan Password</span>
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" name="masuk" class="btn btn-primary btn-block btn-user">
                        <i class="fa fa-fw fa-security"></i>
                        Daftar
                    </button>
                </div>
                <a href="<?= base_url('Auth'); ?>" style="font-size: 13px;" class="text-center d-block"> Saya Sudah Punya Akun </a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    function resetError() {
        $('input').click(function() {
            $(this).removeClass('is-invalid')
        })
    }
    $(document).ready(function() {
        resetError()
        $('form').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                    console.log(data)
                    if (data.errors) {
                        if (data.errors.nik) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.errors.nik,
                            })
                            $('#nik').addClass('is-invalid')
                            $('.invalid-nik').text(data.errors.nik)
                        }
                        if (data.errors.nama) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.errors.nama,
                            })
                            $('#nama').addClass('is-invalid')
                            $('.invalid-nama').text(data.errors.nama)
                        }
                        if (data.errors.password) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.errors.password,
                            })
                            $('#password').addClass('is-invalid')
                            $('.invalid-password').text(data.errors.password)
                        }
                        if (data.errors.konfirmasi) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.errors.konfirmasi,
                            })
                            $('#konfirmasi').addClass('is-invalid')
                            $('.invalid-konfirmasi').text(data.errors.konfirmasi)
                        }
                    }
                    if (data.errorKon) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.errorKon,
                        })
                        $('#konfirmasi').addClass('is-invalid')
                        $('.invalid-konfirmasi').text(data.errorKon)
                    }
                    if (data.errorNik) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.errorNik,
                        })
                        $('#nik').addClass('is-invalid')
                        $('.invalid-passwordnik').text(data.errorNik)
                    }
                    if (data.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Berhasil Membuat Akun',
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            denyButtonText: `Don't save`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                // Swal.fire('Saved!', '', 'success')
                                document.location = '<?= base_url('Auth'); ?>'
                            }
                        })
                    }
                }
            });
        })

        $("#nik").keyup(function() {
            var nik = $("#nik").val()
            $.ajax({
                type: "post",
                url: "Auth/prosesCariNik",
                data: {
                    nik: nik
                },
                success: function(response) {
                    console.log(response)
                    if (response == 'ada') {
                        $("#nik").addClass("is-invalid")
                        $(".invalid-nik").text("Nik Sudah Terdaftar")
                    }
                    if (response == 'tidakAda') {
                        $("#nik").removeClass("is-invalid")
                        $("#nik").addClass("is-valid")
                        $(".invalid-nik").text("")
                        $(".valid-nik").text("Nik Belum Terdaftar")
                    }
                    if (response == "nikPendek") {
                        $("#nik").addClass("is-invalid")
                        $(".valid-nik").text("")
                        $(".invalid-nik").text("Nik terlalu pendek")
                    }
                    if (response == "nikPanjang") {
                        $("#nik").addClass("is-invalid")
                        $(".valid-nik").text("")
                        $(".invalid-nik").text("Nik terlalu panjang")
                    }
                    if (response == "formatNikSalah") {
                        $("#nik").addClass("is-invalid")
                        $(".invalid-nik").text("Maaf, Sepertinya anda memasukan nik yang salah")
                    }
                }
            });
        })

        $("#password").keyup(function() {
            $.ajax({
                type: "post",
                url: "Auth/prosesCekPass",
                data: {
                    pass: $("#password").val()
                },
                // dataType: "dataType",
                success: function(response) {
                    console.log(response)
                    if (response == "passPendek") {
                        $("#password").addClass("is-invalid")
                        $(".invalid-password").text("Password terlalu pendek")
                    }
                    if (response == "passPanjang") {
                        $("#password").addClass("is-invalid")
                        $(".invalid-password").text("Password terlalu panjang")
                    }
                    if (response == "ok") {
                        $("#password").removeClass("is-invalid")
                        $("#password").addClass("is-valid")
                    }
                }
            });
        })

    })
</script>
<?= $this->endSection(); ?>