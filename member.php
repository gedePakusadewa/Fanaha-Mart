<?php
    
    $infoPage = pathinfo( __FILE__ );
    $page = $infoPage['filename'];  

    include('index_function.php');

    if (isset($_GET['out'])) {
        deleteSessionOrder();
    }

    if(!isset($_SESSION['user'])){
        header('Location: index.php');
        exit();
    }  

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Fanaha Mart Official Website</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
        <link rel="stylesheet" href="css/css_home_page.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    </head>
    
    <body class="w3-small" style="background-color:#cccccc;">

        <!-- Navbar (sit on top) -->
        <div class="">
            <div class="w3-bar w3-white w3-medium w3-padding w3-card">
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
                                <a href=\"index.php?out=true\" class=\"w3-bar-item w3-button w3-hide-small\">Log Out</a>";
                        }else{
                            echo"<a onclick=\"login()\" 
                            class=\"w3-bar-item w3-button w3-hide-small\">Masuk | Daftar</a>";
                        }
                    ?>
                    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right 
                    w3-hide-large w3-hide-medium" onclick="myFunction()"><i id="openMenu" class="fas fa-bars"></i></a>
                </div>

                <div id="demo" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium">
                    <a href="member.php" class="w3-bar-item w3-button">Member</a>
                    <a href="profil.php" class="w3-bar-item w3-button">Profil</a>
                    <?php
                        if(isset($_SESSION['user'])){
                            echo "<a href=\"member.php\" class=\"w3-bar-item w3-button w3-border-right\">".$_SESSION['user']."</a>
                                <a href=\"index.php?out='1'\" class=\"w3-bar-item w3-button\">Log Out</a>";
                        }else{
                            echo"<a onclick=\"login()\" 
                            class=\"w3-bar-item w3-button\">Masuk | Daftar</a>";
                        }
                    ?>
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"></a>
                </div>
            
            </div>
            <div class="w3-row w3-padding w3-hide-small w3-white border-upMenuBar ">
                <div class="w3-col w3-container" style="width:20%"></div>
                <div class="w3-col  w3-container" style="width:60%">
                    <div class="w3-row">
                        <div class="w3-center w3-container w3-quarter">
                            <a href="makanan.php" class="w3-bar-item w3-button w3-hide-small"></a>
                        </div>
                        <div class="w3-center w3-container w3-quarter">
                            <a href="member.php" class="w3-bar-item w3-button w3-hide-small">Member</a>
                        </div>
                        <div class="w3-center w3-container w3-quarter">
                            <a href="profil.php" class="w3-bar-item w3-button w3-hide-small">Profil</a>
                        </div>
                        <div class="w3-center w3-container w3-quarter">
                            <a href="pakaian.php" class="w3-bar-item w3-button w3-hide-small"></a>
                        </div>
                    </div>  
                </div>
                <div class="w3-col  w3-container" style="width:20%"></div>
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
                        <input class="w3-input w3-section w3-border" type="text" placeholder="Nomor Gawai" required name="nohp" />
                        <input class="w3-input w3-section w3-border" type="password" placeholder="Password" required name="password" />
                        <button class="w3-button bgcolorOrange w3-text-white w3-section" name="regis_btn" type="submit">Daftar</button>
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
                <div class="w3-row-padding">
                    <div class="w3-center w3-container w3-padding">
                        <h3>Daftar Pesanan Anda</h3>
                    </div>                      
                    <div class="w3-right w3-padding-16">
                        <a href="member.php?hapusSemuaOrder=true"
                            class="w3-button bgcolorIjo w3-text-white" style="width:100%;" >Batalkan Pesanan</a>                           
                    </div>
                    <div class="w3-padding-16">
                        <?php

                            if(isset($_SESSION["order_produk"])){
                                $total_quantity = 0;
                                $total_price = 0;
                                $_SESSION["total_harga_semi_final"] = 0;
                                echo "
                                    <table class=\"w3-table-all\" cellpadding=\"10\" cellspacing=\"1\">
                                        <thead>			
                                            <tr class=\"w3-red w3-text-white\">
                                                <th style=\"text-align:left;\">Produk</th>                                            
                                                <th style=\"text-align:center;\" width=\"5%\">Kuantitas</th>
                                                <th style=\"text-align:center;\" width=\"10%\">Harga Satuan</th>
                                                <th style=\"text-align:center;\" width=\"10%\">Total Harga</th>
                                                <th style=\"text-align:center;\" width=\"10%\">Status Pesanan</th>
                                                <th style=\"text-align:center;\" width=\"10%\">Hapus</th>
                                            </tr>
                                        </thead>";	
                                foreach ($_SESSION["order_produk"] as $item){

                                    $item_price = 0;
                                    $hargaSatuan = 0;
                                    $hargaAwal = "";

                                    if($item['diskon'] > 0){
                                        $hargaSatuan = (int)$item["harga"] - (((int)$item["harga"] * (int)$item['diskon'])/100); 
                                        $item_price = (int)$item["kuantitas"] * $hargaSatuan;
                                        $hargaAwal = "<span class=\"fontHargaPromo\"><strike>Rp. 
                                            ".number_format($item['harga'],0,",",".")."</strike></span><br />";
                                    }else{
                                        $hargaSatuan = (int)$item["harga"];
                                        $item_price = (int)$item["kuantitas"] * $hargaSatuan;
                                        $hargaAwal = "";
                                    }

                                    echo"
                                        <tr>
                                            <td> <a href=\"produk_desc.php?kodeProduk=".$item['kode']."&produk=".$item['tipe_produk']."\" 
                                                class=\"selengkapny\" ><img src=\"".$item["gbr"]."\" style=\"width:5%;max-width:100px; text-align:center;\" 
                                                    />".$item["nama"];

                                            if($item['diskon'] > 0){
                                                echo "
                                                    <span class=\"w3-tag w3-round bgcolorOrange w3-center\">".$item['diskon']."%</span>"; 
                                            }

                                            echo "</a></td>
                                            <td style=\"text-align:center;\">".$item["kuantitas"]."</td>
                                            <td style=\"text-align:center;\">".$hargaAwal."Rp. ".number_format($hargaSatuan,0,",",".")."</td>
                                            <td style=\"text-align:center;\">Rp. ".number_format($item_price,0,",",".")."</td>
                                            <td style=\"text-align:center;\"> Tunggu </td>
                                            <td style=\"text-align:center;\"><a href=\"member.php?delete=true&kodeHapus=".$item['kode']."\"><i class=\"fas fa-trash-alt\" style=\"font-size:16px; color:red; \"></i></a></td>
                                        </tr>";
                                        
                                            $total_quantity += $item["kuantitas"];
                                            $total_price += ($hargaSatuan * $item["kuantitas"]);
                                            $_SESSION["total_harga_semi_final"] = $total_price;                                            
                                }
                                    echo"
                                        <tr>
                                            <td colspan=\"1\" style=\"text-align:right;\">Total:</td>
                                            <td style=\"text-align:center;\">".$total_quantity."</td>
                                            <td style=\"text-align:right;\" colspan=\"2\"><strong>Rp. "
                                                .number_format($total_price,0,",",".")."</strong></td>
                                            <td></td>
                                        </tr>				
                                </table>";	

                            } else {
                                echo "
                                    <table class=\"w3-table-all\" cellpadding=\"10\" cellspacing=\"1\">
                                        <thead>			
                                            <tr class=\"w3-red w3-text-white\">
                                                <th style=\"text-align:left;\">Produk</th>
                                                <th style=\"text-align:center;\" width=\"10%\">Kode</th>
                                                <th style=\"text-align:center;\" width=\"5%\">Kuantitas</th>
                                                <th style=\"text-align:center;\" width=\"10%\">Harga Satuan</th>
                                                <th style=\"text-align:center;\" width=\"10%\">Total Harga</th>
                                                <th style=\"text-align:center;\" width=\"10%\">Status Pesanan</th>
                                            </tr>
                                        </thead>
                                            <tr>
                                                <td colspan=\"2\" style=\"text-align:center;\">
                                                    Silahkan memilih produk yang akan dipesan.
                                                </td>
                                            </tr>
                                    </table>";
                                //echo "<div class=\"no-records\">Silahkan memilih roti yang akan dipesan</div>";
                            
                            }
                        ?>
                    </div>
                    <div class="w3-right w3-padding-16">
                        <?php
                            $pesanCheckout = "
                                <a class=\"w3-button bgcolorOrange w3-text-white\" style=\"width:100%;\" disabled>
                                        <b>Pesan Sekarang</b></a>  ";
                            if(isset($_SESSION["total_harga_semi_final"])){
                                if((int)$_SESSION["total_harga_semi_final"] > 0){
                                    echo "
                                    <a onclick=\"document.getElementById('checkout_modal').style.display='block'\"
                                        class=\"w3-button bgcolorOrange w3-text-white\" style=\"width:100%;\" >
                                            <b>Pesan Sekarang</b></a>  ";
                                }else{
                                    echo $pesanCheckout;
                                }
                            } else{
                                echo $pesanCheckout;
                            }
                                                  
                        ?>                         
                    </div>
                </div>
                
            </div>

        <!-- End page content -->
        </div>
        
        <!-- checkout klo ditaruh dibawah logi ama register $session total harga bakal dianggap undefined -->
        <div id="checkout_modal" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
                <header class="w3-container w3-text-white bgcolorIjo w3-center"> 
                    <span onclick="document.getElementById('checkout_modal').style.display='none'" 
                        class="w3-button w3-display-topright"><i class="fas fa-times" style="font-size:25px;"></i></span>
                    <h2>Check Out</h2>
                </header>
                <div class="w3-container w3-padding">
                    <p>Total Pembayaran Awal adalah Rp. <b>
                        <?php echo number_format($_SESSION["total_harga_semi_final"],0,",","."); ?></b>.
                        Silahkah pilih metode pembayaran yang kami sediakan dan masukkan alamat tujuan pengiriman.</p>
                    <div class="w3-row">                        
                        <form action="" method="post">
                            <div class="w3-half w3-container">
                                <input class="w3-radio"  type="radio" name="payment" value="dana" checked /> Dana<br />
                                <input class="w3-radio"  type="radio" name="payment" value="bca" /> BCA KlikPay<br />
                                <input class="w3-radio"  type="radio" name="payment" value="ovo" /> OVO <br />
                                <input class="w3-radio"  type="radio" name="payment" value="linkAja" /> linkAja!<br />
                                <input class="w3-radio"  type="radio" name="payment" value="gopay" /> Gopay<br />
                                <input class="w3-radio"  type="radio" name="payment" value="cod" /> Bayar ditempat <br /><br />
                            </div>

                            <div class="w3-half w3-container">
                                <input class="w3-input" name="jalan" type="text" placeholder="Nama jalan" /><br />
                                <input class="w3-input" name="noHP" type="text" placeholder="No Handphone" /><br />
                                <br />
                                <input type="submit" value="Kirim" />
                            </div>
                        </form> 
                        <div class="w3-container">
                            <p><b style="color:red">***</b>Isi data alamat sesuai keinginan anda dan ketika sudah pasti klik tombol Kirim.
                            Jika pembayran sudah diterima, maka no Handphone akan ditelpon atau sms sebelum pesanan anda dikirim oleh 
                                pegawai kami.</p>
                        </div>                                                
                    </div> 
                </div>
                <footer class="w3-container w3-text-white bgcolorOrange">
                    <p>Terima kasih telah menggunakan layanan KAMI</p>
                </footer>
            </div>
        </div>

        <!-- Footer -->
        <footer class="w3-center w3-white w3-padding w3-border">
            <div class="w3-row">
                <div class="w3-container w3-center w3-white footerBar w3-third ">
                    <div class="w3-container w3-border w3-round-large">
                        <p><b>Dapatkan informasi terbaru dan promo menarik!!!</b></p>
                        <form action="email_confirm.php" method="post">
                            <input class="w3-input w3-section w3-border" type="text" placeholder="Email" required name="Email">
                            <button class="w3-button bgcolorIjo w3-text-white w3-block w3-section" type="submit">KIRIM</button>
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

            
            function checkout(){
                document.getElementById('checkout_modal').style.display='block';
            }
            
        </script>

    </body>
</html>
