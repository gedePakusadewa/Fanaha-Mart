<?php
    
    $infoPage = pathinfo( __FILE__ );
    $page = $infoPage['filename'];  

    include('index_function.php');

    if (isset($_GET['out'])) {
        deleteSessionOrder();
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Fanaha Mart Official Website</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <link rel="stylesheet" href="css/css_home_page.css" />
    </head>
    <body class="w3-small" style="background-color:#cccccc;">

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <div id="menu1" class="w3-bar w3-white w3-medium w3-padding w3-card">
                <a href="index.php#home"><img src="gambar/aksesoris_page/logo.jpg" alt="logo" 
                    style="width:100%;max-width:180px" /></a>
            <!-- Float links to the right. Hide them on small screens -->
            <div class="w3-right">
                <?php
                    if(isset($_SESSION['total_order'])){                            
                        echo "<a href=\"member.php\" class=\"w3-bar-item w3-button w3-hide-small w3-border w3-round-xlarge\">
                        <i class=\"fas fa-cart-plus\" style=\"color:#009c4d; font-size:24px\">
                            ".totalOrder()."</i></a>";
                    }else{
                        echo "<a href=\"member.php\" class=\"w3-bar-item w3-button w3-hide-small w3-border w3-round-xlarge\">
                        <i class=\"fas fa-cart-plus\" style=\"color:#009c4d; font-size:24px\"> 0</i></a>";
                    }                   
                ?>
                <a href="about.php" class="w3-bar-item w3-button w3-hide-small">Tentang Kami</a>
                <?php
                    if(isset($_SESSION['user'])){
                        echo "<a href=\"member.php\" class=\"w3-bar-item w3-button w3-border-right w3-hide-small\">".$_SESSION['user']['username_log']."</a>
                            <a href=\"about.php?out=true\" class=\"w3-bar-item w3-button w3-hide-small\">Log Out</a>";
                    }else{
                        echo"<a onclick=\"login()\" 
                        class=\"w3-bar-item w3-button w3-hide-small\">Masuk | Daftar</a>";
                    }
                ?>
                <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right 
                w3-hide-large w3-hide-medium" onclick="myFunction()"><i id="openMenu" class="fas fa-bars"></i></a>
            </div>

            <div id="demo" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium">
                <a href="about.php" class="w3-bar-item w3-button">Tentang Kami</a>
                <?php
                    if(isset($_SESSION['user'])){
                        echo "<a href=\"member.php\" class=\"w3-bar-item w3-button w3-border-right w3-hide-small\">".$_SESSION['user']['username_log']."</a>
                            <a href=\"about.php?out=true\" class=\"w3-bar-item w3-button w3-hide-small\">Log Out</a>";
                    }else{
                        echo"<a onclick=\"login()\" 
                        class=\"w3-bar-item w3-button w3-hide-small\">Masuk | Daftar</a>";
                    }
                ?>
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"></a>
            </div>
            </div>
        </div>

        <div id="login_modal" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
                <header class="w3-container bgcolorIjo w3-text-white w3-center"> 
                    <span onclick="document.getElementById('login_modal').style.display='none'" 
                        class="w3-button w3-display-topright"><i class="fas fa-times" style="font-size:25px;"></i></span>
                    <h2>Login</h2>
                </header>
                <div class="w3-container w3-padding">
                    <form action="" method="post" id ="form1">
                        <input class="w3-input w3-border" id="username1" type="text" placeholder="Username" name="username" />
                        <input class="w3-input w3-section w3-border" id="password1" type="password" placeholder="Password" name="password" />
                        <button class="w3-button w3-text-white bgcolorIjo w3-section" name="login_btn" type="submit">Masuk</button>
                    </form>
                </div>
                <footer class="w3-container w3-black">
                    <p>Belum punya akun? Silahkan <a onclick="register()" class="registerLink w3-text-blue"><b>register</b></a> dulu.</p>
                </footer>
            </div>
        </div>

        <div id="register_modal" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
                <header class="w3-container bgcolorOrange w3-text-white w3-center"> 
                    <span onclick="document.getElementById('register_modal').style.display='none'" 
                        class="w3-button w3-display-topright"><i class="fas fa-times" style="font-size:25px;"></i></span>
                    <h2>Register</h2>
                </header>
                <div class="w3-container w3-padding">
                    <form action="" method="post">
                        <input class="w3-input w3-border" type="text" placeholder="Username" required name="username" />
                        <input class="w3-input w3-section w3-border" type="text" placeholder="Email" required name="email" />
                        <input class="w3-input w3-section w3-border" type="password" placeholder="Password" required name="password" />
                        <input class="w3-button bgcolorOrange w3-text-white w3-section" type="submit" name="register_btn" value="Daftar" />
                    </form>
                </div>
                <footer class="w3-container w3-black">
                    <p>Sudah punya akun? Silahkan <a onclick="login()" class="registerLink w3-text-blue"><b>Log In</b></a> dulu.</p>
                </footer>
            </div>
        </div>
        
        <!-- Page content -->
        <div class="w3-content marginKhusus1 w3-padding" style="max-width:1564px">

            <div class="w3-container w3-white w3-topbar w3-bottombar w3-leftbar w3-rightbar w3-round-large">
                <div class="w3-row">
                    <div class="w3-half w3-container">
                        <h3 style="text-align:left;"><b>Tentang Klik Fanaha mart</b></h3>
                    </div>
                </div> 
                <div class="w3-padding">
                    <h6>Toko Online Fanaha mart</h6>
                    <p>Klik Fanaha mart adalah toko online Fanaha mart atau tempat belanja online 
                    Fanaha mart; salah satu inovasi dari Fanaha mart berupa rencana one stop online store 
                    yang menyediakan berbagai macam produk dalam satu situs untuk memenuhi semua 
                    kebutuhan konsumen. Fanaha mart merupakan perusahaan retail yang sudah melayani 
                    konsumen selama lebih dari 10 tahun. </p>

                    <h6>A. Beragam Varian Produk</h6>
                    <p>Klik Fanaha mart.com menyediakan ribuan pilihan produk yang lengkap dengan 
                        harga terbaik dari sejumlah kebutuhan. Beragam produk serta promosi pilihan 
                        hadir untuk Anda, mulai dari kebutuhan sehari-hari  seperti grocery, makanan, 
                        minuman, kebutuhan bayi & ibu menyusui, dan produk kecantikan & kesehatan.</p>

                    <h6>B. Kemudahan dan Keamanan Bertransaksi Online</h6>
                    <p>Kemudahan dan Keamanan dalam bertransaksi online merupakan nilai lebih Kami 
                        kepada Anda sebagai situs belanja online ‘One Stop Online Shop’ Klik Fanaha 
                        mart.com. Anda dapat memilih berbagai metode pembayaran, seperti transfer 
                        antar ATM, bayar ditempat atau Cash On Delivery/COD, (segera) internet banking 
                        (BCA Klikpay, Mandiri Clickpay, Cimb Niaga), dan (segera) pembayaran uang elektronik 
                        (Rekening Ponsel, t-Cash).</p>

                    <h6>C. Luasnya Jangkauan Area Coverage Pengiriman</h6>
                    <p>Barang-barang pesanan yang Anda beli dapat juga dikirimkan dari Warehouse
                        ke seluruh area di TulungAgung melalui jasa pengiriman kurir JNE dan Indo Paket. 
                        Beragam pilihan pengiriman menjadi nilai lebih bagi kami untuk terus 
                        memberikan penawaran terbaik bagi Anda dalam situs belanja online Klik Fanaha mart.com.</p>

                    <h6>D. Added Value to Customer</h6>
                    <p>Nilai lebih yang kami berikan kepada konsumen antara lain:<br />
                        One Stop Online Shop<br />
                        Gratis Biaya Pengiriman*<br />
                        Secure e-Payment<br />
                        </p>

                    <h6>E. Tagline</h6>
                    <p>Tagline Klik Fanaha mart adalah Easy & Safe Online Shopping, kami selalu berusaha memberikan 
                        kemudahan dan keamanan dengan harga terbaik.<br />Kini belanja online di Klik Fanaha mart 
                        semakin aman, mudah dan hemat!</p>
                </div>

                <div class="w3-col w3-container m6 l6 w3-padding">
                <p>Ada pertanyaan, silahkan <i>tanya</i> kami lewat:</p>
                <div class="w3-row">
                    <div class="w3-col w3-container m1 l1">
                    <a href="https://www.google.com/maps/place/Fanaha+Mart/@-8.0673539,111.9049945,17z/data=!3m1!4b1!4m5!3m4!1s0x2e78e31e5e0d8a01:0x60052725b2170f7d!8m2!3d-8.0673539!4d111.9071832"
                        ><span class='fas fa-map-marked-alt' style="font-size:25px;"></span></a>
                    </div>
                    <div class="w3-col w3-container m11 l11">
                    <a href="https://www.google.com/maps/place/Fanaha+Mart/@-8.0673539,111.9049945,17z/data=!3m1!4b1!4m5!3m4!1s0x2e78e31e5e0d8a01:0x60052725b2170f7d!8m2!3d-8.0673539!4d111.9071832"
                        class="selengkapny">
                        <span>Jl. I Gusti Ngurah Rai No.18, Bago, Kec. Tulungagung, Kabupaten Tulungagung, Jawa Timur 66218</span></a>
                    </div>
                </div>

                <div class="w3-row">
                    <div class="w3-col w3-container m1 l1">
                    <span class='fas fa-phone-square-alt' style="font-size:25px;"></span>
                    </div>
                    <div class="w3-col w3-container m11 l11">
                    <span>0361-000-678-123</span>
                    </div>
                </div>

                <div class="w3-row">
                    <div class="w3-col w3-container m1 l1">
                    <span class='fab fa-whatsapp-square' style="font-size:25px; color:#25D366;"></span>
                    </div>
                    <div class="w3-col w3-container m11 l11">
                    <span>0812-3442-2671 (Mbak Nana)</span>
                    </div>
                </div>
            
                </div> 
            </div>

        <!-- End page content -->
        </div>


        <!-- Footer -->
        <footer class="w3-center w3-white w3-padding w3-border">
            <div class="w3-row">
                <div class="w3-container w3-center w3-white footerBar w3-third ">
                    <div class="w3-container w3-border w3-round-large">
                        <p><b>Dapatkan informasi terbaru dan promo menarik!!!</b></p>
                        <form action="email_confirm.php" method="post">
                            <input class="w3-input w3-section w3-border" type="text" placeholder="Email" required name="Email">
                            <button class="w3-button bgcolorIjo w3-block w3-text-white w3-section" type="submit">KIRIM</button>
                        </form>
                    </div>
                    <p>Temui Kami di Sosial Media Anda</p>
                    <div>                
                        <a href="http://www.instagram.com"><span class='fab fa-instagram' style="font-size:25px;"></span></a>
                        <a href="http://www.facebook.com"><span class='fab fa-facebook-square' style="font-size:25px; 
                            color:#3b5998;"></span></a>
                    </div>
                </div>
                <div class="w3-container w3-white footerBar w3-third">
                    <div class="w3-row">
                        <div class="w3-half w3-container">
                            <p style="text-align:left;">Menerima Pembayaran</p>
                        </div>
                    </div> 
                    <img src="gambar/aksesoris_page/pembayaran.jpg" alt="venue" style="width:100%" />
                </div>
                <div class="w3-container w3-center w3-white w3-third">
                    <div class="w3-row">
                        <div class="w3-container">
                            <p style="text-align:left;">Jasa Pengiriman dilakukan oleh para pegawai kami.
                                 Jadwal pengiriman dari jam 08.00 WIB - 21.00 WIB. Pengiriman dilakukan setiap hari
                                    kecuali hari libur nasional atau mengikuti jadwal buka tutup toko Fanaha Mart.</p>
                        </div>
                    </div> 
                    <img src="gambar/aksesoris_page/trust.jpg" alt="venue" style="width:60%" />
                </div>
            </div>
            <p><span class='fa fa-copyright'> 2010 - 2019. Fanaha Mart</span></p>
        </footer>

        <script>
            function myFunction() {
                var x = document.getElementById("demo");
                var y = document.getElementById('openMenu');
                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";
                    y.className = "fas fa-times";
                } else { 
                    x.className = x.className.replace("w3-show", "");
                    y.className = "fas fa-bars";
                }
            }

            function closeNav() {
                var x = document.getElementById("demo");
                x.className = x.className.replace("w3-show", "");
            } 

            function login(){
                document.getElementById('login_modal').style.display='block';
                document.getElementById('register_modal').style.display='none';
            }

            function register(){
                document.getElementById('login_modal').style.display='none';
                document.getElementById('register_modal').style.display='block';

            }
        </script>

    </body>
</html>
