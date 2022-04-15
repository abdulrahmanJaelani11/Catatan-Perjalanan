<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url("assets"); ?>/css/sb-admin-2.min.css">
    <link href="<?= base_url("assets"); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="<?= base_url("assets"); ?>/js/jquery.js"></script>
    <title>Welcome</title>
    <link rel="stylesheet" href="<?= base_url("assets"); ?>/css/welcomePage.css">
    <style>
        #ul a {
            margin: 7px 0;
            text-decoration: none;
            color: #090979;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="nav fixed-top bg-primary d-flex justify-content-between" style="padding: 5px 0;  background: rgb(2,0,36); background: linear-gradient(163deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 41%, rgba(0,212,255,1) 86%);">
        <h4 class="mt-2 ml-2 text-light nav-brand text-uppercase">Catatan Perjalanan</h4>
        <div class="row" style="width: 250px; margin-top: 5px; line-height: normal; margin-right: 10px;">
            <div class="col-6">
                <button type="submit" name="login" id="btn" class="btn text-light btn-block btn-outline-primary"> <i class="fa fa-fw fa-user"></i> Masuk </button>
                <div style="display: none; width: 100px; padding: 10px; background-color: white;" id="ul">
                    <a href="<?= base_url('AuthAdmin'); ?>">Admin</a>
                    <a href="<?= base_url("Auth"); ?>">Pengguna</a>
                </div>
            </div>
            <div class="col-6">
                <a href="register.php" style="color: white;" class="btn btn-block btn-outline-primary">
                    <i class="fa fa-fw fa-clipboard-list"></i>
                    Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- <div style="position: absolute; top: 0; bottom: 0; right: 0; left: 0; background-color: black; z-index: 99; color: red; line-height: 800px; text-align: center; font-size: 50px;">Abdurahman Merusak Website mu WKWKW</div> -->
        <div class=" row" style="margin-top: 65px;">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body h3 text-center" style="color: #090979;">
                        <h4 class="h2 font-weight-bold">SELAMAT DATANG</h4>
                        <h3 class=" font-weight-bold">WEBSITE CATATAN PERJALANAN</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-around" style="font-family: cursive;">
            <div class="col-lg-5 mt-5">
                <div class="w3-content w3-section mt-2">
                    <img class="mySlides" src="<?= base_url("assets"); ?>/img/20220319_235802.png" style="width:100%">
                    <img class="mySlides" src="<?= base_url("assets"); ?>/img/20220319_235847.png" style="width:100%">
                    <img class="mySlides" src="<?= base_url("assets"); ?>/img/20220320_000008.png" style="width:100%">
                    <img class="mySlides" src="<?= base_url("assets"); ?>/img/20220320_000130.png" style="width:100%">
                    <img class="mySlides" src="<?= base_url("assets"); ?>/img/20220320_074513.png" style="width:100%">
                </div>
            </div>
        </div>
    </div>

    <footer class="sticky-footer fixed-bottom bg-white" style="z-index: 1;">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; PEDULI DIRI <?= date("Y") ?> By Abdul Rahman Jaelani</span>
            </div>
        </div>
    </footer>
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

        function caption() {
            let i = Math.floor(Math.random() * 10);
            if (i <= 3) {
                $('.caption').text('Yang Terpenting Bukan Apa Yang Kita Ketahui, Tetapi Apa Yang Kita Pelajari')
            } else if (i > 3 && i <= 6) {
                $('.caption').text('Keberhasilan yang paling manis adalah ketika kita mencapai sesuatu yang menurut orang lain tidak mungkin')
            } else if (i <= 10 && i > 6) {
                $('.caption').text('Sukses itu tidak didapat dari malas malasan tetapi dari kerja keras yang dilakukan')
            }
            console.log(i);
        }
        $(document).ready(function() {
            caption()
            $('#btn').click(function() {
                $("#ul").slideToggle(300);
                // $('#ul').slideToggle(500);
                // alert("OK")
            });

            $('li a').hover(function() {
                $(this).css('color', 'orange')
            })

            $('li a').mouseleave(function() {
                $(this).css('color', 'rgb(32, 132, 240)')
            })
        });
    </script>
</body>

</html>