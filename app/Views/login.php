<?= $this->extend("template/mainLogin"); ?>

<?= $this->section('card'); ?>
<div class="card shadow">
    <div class="card-body">
        <div class="p-4">
            <div class="text-center">
                <Span class="h2 text-primary font-weight-bold">Selamat Datang</Span>
                <div class="alert alert-success mt-3">
                    Selamat datang, Silahkan Login menggunakan akun yang sudah anda daftarkan
                </div>
            </div>
            <form action="<?= base_url('Auth/prosesLogin'); ?>" method="post" class="user mt-4">
                <div class="form-group">
                    <input type="number" name="nik" id="nik" class="form-control form-control-sm form-control-user" placeholder="Masukan NIK" autocomplete="off" autofocus required>
                    <div class="invalid-feedback invalid-nik"></div>
                    <div class="valid-feedback valid-nik"></div>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control form-control-sm form-control-user" placeholder="Masukan password" autocomplete="off" required>
                    <div class="invalid-feedback invalid-password"></div>
                </div>
                <div class="form-group pb-3">
                    <input type="checkbox" name="check" id="show" style="margin: 0;"><span style="font-size: small; margin-left:10px;" id="textShow">Tampilkan Password</span>
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" name="masuk" class="btn btn-primary btn-block btn-user">
                        <i class="fa fa-fw fa-security"></i>
                        Masuk
                    </button>
                </div>
                <a href="register" style="font-size: 13px;" class="text-center d-block"> Saya Pengguna baru </a>
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
                            $('#nama').addClass('is-invalid')
                            $('.invalid-nama').text(data.errors.nama)
                        }
                        if (data.errors.password) {
                            $('#password').addClass('is-invalid')
                            $('.invalid-password').text(data.errors.password)
                        }
                    }
                    if (data.errorNik) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.errorNik,
                        })
                        $('#nik').addClass('is-invalid')
                        $('.invalid-nik').text(data.errorNik)
                    }
                    if (data.errorPass) {
                        $('#password').addClass('is-invalid')
                        $('.invalid-password').text(data.errorPass)
                    }
                    if (data.sukses) {
                        document.location = "<?= base_url('Home'); ?>";
                    }
                }
            });
        })
        resetError()

        // Cari Nik 
        $("#nik").keyup(function() {
            var isi = $("#nik").val()
            $.ajax({
                type: "post",
                url: "Auth/prosesCariNik_L",
                data: {
                    nik: isi
                },
                success: function(response) {
                    console.log(response)
                    if (response == 'ada') {
                        $("#nik").removeClass('is-invalid')
                        $("#nik").addClass('is-valid')
                        $(".valid-nik").text("Nik terdaftar")
                    }
                    if (response == 'tidakAda') {
                        $("#nik").removeClass('is-valid')
                        $("#nik").addClass('is-invalid')
                        $(".invalid-nik").text("Nik tidak terdaftar")
                    }

                }
            });
        })

    })
</script>
<?= $this->endSection(); ?>