<?= $this->extend('template/main'); ?>

<?= $this->section('container'); ?>
<div class="row justify-content-center mb-5">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="text-uppercase h5 font-weight-bold text-dark">Isi Catatan</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url('Catatan/isiCatatan'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="tanggal">Tanggal *</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                        <div class=" invalid-feedback invalid-tanggal"></div>
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam *</label>
                        <input type="time" name="jam" id="jam" class="form-control">
                        <div class="invalid-feedback invalid-jam"></div>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi *</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Tujuan">
                        <div class="invalid-feedback invalid-lokasi"></div>
                    </div>
                    <div class="form-group">
                        <label for="suhu">Suhu Tubuh *</label>
                        <input type="text" name="suhu" id="suhu" class="form-control" placeholder="Suhu Tubuh">
                        <div class="invalid-feedback invalid-suhu"></div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan *</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="simpan" class="btn btn-block btn-primary">
                            <i class="fa fa-fw fa-save"></i>
                            Simpan </button>
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
        $('form').on('submit', function(e) {
            e.preventDefault()

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                dataType: "JSON",
                data: $(this).serialize(),
                success: function(data) {
                    // console.log(data)
                    if (data.error) {
                        if (data.error.tanggal) {
                            $('#tanggal').addClass('is-invalid')
                            $('.invalid-tanggal').text(data.error.tanggal)
                        }
                        if (data.error.jam) {
                            $('#jam').addClass('is-invalid')
                            $('.invalid-jam').text(data.error.jam)
                        }
                        if (data.error.suhu) {
                            $('#suhu').addClass('is-invalid')
                            $('.invalid-suhu').text(data.error.suhu)
                        }
                        if (data.error.lokasi) {
                            $('#lokasi').addClass('is-invalid')
                            $('.invalid-lokasi').text(data.error.lokasi)
                        }
                    }
                    if (data.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil Menyimpan Catatan',
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            denyButtonText: `Don't save`,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                // Swal.fire('Saved!', '', 'success')
                                document.location = `<?= base_url('Catatan'); ?>`
                                // alert("OK")
                            } else if (result.isDenied) {
                                Swal.fire('Changes are not saved', '', 'info')
                            }
                        })
                    }
                }
            });
        })
    })
</script>
<?= $this->endSection(); ?>