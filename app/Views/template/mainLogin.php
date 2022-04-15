<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $judul; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url("assets"); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

    <!-- Custom styles for this template-->
    <link href="<?= base_url("assets"); ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="<?= base_url("assets"); ?>/js/jquery.js"></script>

</head>

<body>

    <div class="container-fluid">

        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin-top: 8%;">
            <div class="col-lg-6 col-md-6">
                <div class="w3-content w3-section mt-2">
                    <img class="mySlides" src="<?= base_url("assets"); ?>/img/bg4.jpg" style="width:100%">
                    <img class="mySlides" src="<?= base_url("assets"); ?>/img/bgLoginSiswa.jpg" style="width:100%">
                    <img class="mySlides" src="<?= base_url("assets"); ?>/img/bgRegister.jpg" style="width:100%">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <?= $this->renderSection('card'); ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url("assets"); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url("assets"); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url("assets"); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- sweetalert -->
    <script src="<?= base_url("assets"); ?>/js/sweetalert2.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url("assets"); ?>/js/sb-admin-2.min.js"></script>
    <?= $this->renderSection('script'); ?>
    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            // console.log(myIndex)
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 3000); // Change image every 2 seconds
        }
        $(document).ready(function() {

            $('#show').click(function() {
                if ($(this).is(':checked')) {
                    $('#password').attr('type', 'text')
                    $('#konfirmasi').attr('type', 'text')
                } else {
                    $('#password').attr('type', 'password')
                    $('#konfirmasi').attr('type', 'password')

                }
            })
        })
    </script>
</body>

</html>