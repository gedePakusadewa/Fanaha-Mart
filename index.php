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
        <link rel="stylesheet" href="css/css_home_page.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    </head>
    
    <body class="w3-small" style="background-color:#cccccc;">

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
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
                                <a href=\"index.php?out='1'\" class=\"w3-bar-item w3-button w3-hide-small\">Log Out</a>";
                        }else{
                            echo"<a onclick=\"login()\" 
                            class=\"w3-bar-item w3-button w3-hide-small\">Masuk | Daftar</a>";
                        }
                    ?>
                    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right 
                    w3-hide-large w3-hide-medium" onclick="myFunction()"><i id="openMenu" class="fas fa-bars"></i></a>
                </div>

                <div id="demo" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium">
                    <a href="makanan.php" class="w3-bar-item w3-button">Makanan</a>
                    <a href="minuman.php" class="w3-bar-item w3-button">Minuman</a>
                    <a href="aia.php" class="w3-bar-item w3-button">Ayah, Ibu, Anak</a>
                    <a href="kosmetik.php" class="w3-bar-item w3-button">Perawatan</a>
                    <a href="about.php" class="w3-bar-item w3-button">Tentang Kami</a>
                    <?php
                        if(isset($_SESSION['user'])){
                            echo "<a href=\"member/member.php\" class=\"w3-bar-item w3-button w3-border-right\">".$_SESSION['user']."</a>
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
                            <a href="makanan.php" class="w3-bar-item w3-button w3-hide-small">Makanan</a>
                        </div>
                        <div class="w3-center w3-container w3-quarter">
                            <a href="minuman.php" class="w3-bar-item w3-button w3-hide-small">Minuman</a>
                        </div>
                        <div class="w3-center w3-container w3-quarter">
                            <a href="aia.php" class="w3-bar-item w3-button w3-hide-small">Ayah, Ibu, Anak</a>
                        </div>
                        <div class="w3-center w3-container w3-quarter">
                            <a href="kosmetik.php" class="w3-bar-item w3-button">Perawatan</a>
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
                    <div id="alert1" class="w3-panel w3-red w3-padding">
                        <strong>Salat Input!</strong>
                    </div>
                    <div id="login_1" class="w3-panel w3-red w3-padding">
                        Tolong masukan username dengan benar.
                    </div>
                    <div id="login_2" class="w3-panel w3-red w3-padding">
                        Tolong masukan password dengan benar.
                    </div>
                    <form id="form1" action="" method="post">
                        <input id="nameID" class="w3-input w3-border" type="text" placeholder="Username" name="username" />
                        <input id="passID" class="w3-input w3-section w3-border" type="password" placeholder="Password" name="password" />
                        <!--<button class="w3-button w3-text-white bgcolorIjo w3-section" name="login_btn" onclick="finalCheck()" type="submit">Masuk</button>-->
                        <input type="button" class="w3-button bgcolorIjo w3-text-white" onclick="finalCheck()" value="Submit" />
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
                    <div id="alert2" class="w3-panel w3-red w3-padding">
                        <strong>Salat Input!</strong>
                    </div>
                    <div id="reg_1" class="w3-panel w3-red w3-padding">
                        Format username salah. Username terdiri dari karakter alphanumeric. 
                    </div>
                    <div id="reg_2" class="w3-panel w3-red w3-padding">
                        Format email salah. Pakailah format email ygn sudah umum seperti xxx@gmail.com. 
                    </div>
                    <div id="reg_3" class="w3-panel w3-red w3-padding">
                        Format password salah. Password terdiri dari karakter alphanumeric dan minimal 8 karakter. 
                    </div>
                    <div id="reg_4" class="w3-panel w3-red w3-padding">
                        Format alamat salah. Alamat terdiri dari karakter alphanumeric ditambah spasi dan titik. 
                    </div>
                    <form id="form2" action="" method="post">
                        <input id="nameIDreg" class="w3-input w3-border" type="text" placeholder="Username" name="usernameReg" />
                        <input id="emailIDreg" class="w3-input w3-section w3-border" type="text" placeholder="Email" name="emailReg" />
                        <input id="passIDreg1" class="w3-input w3-section w3-border" type="password" placeholder="Password" name="passwordReg1" />
                        <input id="passIDreg2" class="w3-input w3-section w3-border" type="password" placeholder="Password konfirmasi" name="passwordReg2" />
                        <input id="alamatIDreg" class="w3-input w3-section w3-border" type="text" placeholder="Alamat" name="alamatReg" />
                        <input type="button" class="w3-button bgcolorOrange w3-text-white" onclick="finalCheckReg()" value="Submit" />
                    </form>
                </div>
                <footer class="w3-container w3-black">
                    <p>Sudah punya akun? Silahkan <a onclick="login()" class="registerLink w3-text-blue"><b>Log In</b></a> dulu.</p>
                </footer>
            </div>
        </div>

        <div id="verify_modal" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
                <header class="w3-container bgcolorIjo w3-text-white w3-center"> 
                    <span onclick="document.getElementById('verify_modal').style.display='none'" 
                        class="w3-button w3-display-topright"><i class="fas fa-times" style="font-size:25px;"></i></span>
                    <h2>Verifikasi Akun Anda</h2>
                </header>
                <div class="w3-container w3-padding">
                    <div id="alert3" class="w3-panel w3-red w3-padding">
                        <strong>Format Kode Salah!</strong> Tolong masukkan format kode dengan benar.
                    </div>
                    <form id="form3" action="" method="post">
                        <div class="w3-center w3-large">
                            <input id="kode1" class="" style="text-align:center;" type="text" placeholder="_" name="kode1" maxlength="1" size="1" />
                            <input id="kode2" class="" style="text-align:center;" type="text" placeholder="_" name="kode2" maxlength="1" size="1" />
                            <input id="kode3" class="" style="text-align:center;" type="text" placeholder="_" name="kode3" maxlength="1" size="1"/>
                            <input id="kode4" class="" style="text-align:center;" type="text" placeholder="_" name="kode4" maxlength="1" size="1" />
                            <input id="kode5" class="" style="text-align:center;" type="text" placeholder="_" name="kode5" maxlength="1" size="1" />
                            <input id="kode6" class="" style="text-align:center;" type="text" placeholder="_" name="kode6" maxlength="1" size="1"/><br />
                            <input type="button" class="w3-button bgcolorIjo w3-text-white w3-margin" onclick="verifyCheck()" value="Submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>        

        <!-- Page content -->
        <div class="w3-content marginKhusus1 w3-padding" style="max-width:1564px">
            <div class="w3-row">
                <div class="w3-container w3-white w3-topbar w3-bottombar w3-leftbar w3-rightbar w3-round-large">
                    <div class="w3-row">
                        <div class="w3-half w3-container">
                            <p style="text-align:left;"><b>Official Store & Brand</b></p>
                        </div>
                        <div class="w3-half w3-container">
                            <p style="text-align:right; color:#f28439; "><a href="brand.php" class="selengkapny">Selengkapnya <i class='fas fa-angle-right'></i></a></p>
                        </div>
                    </div> 
                    <div class="w3-row">
                        <?php
                            if(isset($_SESSION['brand'])){
                                $incre = 0;
                                foreach($_SESSION['brand'] as $info_item){
                                    echo 
                                    "<div class=\"w3-col l2 m4 w3-container\">
                                        <div class=\"w3-display-container\">
                                        <img src=\"".$info_item['gbr']."\" alt=\"".$info_item['nama']."\" 
                                            style=\"width:100%; max-width:90px;\" />
                                        <p>".$info_item['nama']."</p>
                                        </div>
                                    </div>";
                                    if (++$incre == 6) break;                                       
                                }
                            }else{
                                echo "<div style=\"text-align:center;\">Tidak Ada Data</div>";
                            }
                        ?>

                    </div> 
                </div>
            </div> 

            <div class="w3-container w3-white w3-topbar w3-bottombar w3-leftbar w3-rightbar w3-round-large">
                <div class="w3-row">
                    <div class="w3-half w3-container">
                        <p style="text-align:left;"><b>Promo Hari Ini!!!</b></p>
                    </div>
                    <div class="w3-half w3-container">
                        <p style="text-align:right; color:#f28439; ">Selengkapnya <i class='fas fa-angle-right'></i></p>
                    </div>
                </div> 
                <div class="w3-row-padding">
                    <?php
                        if(isset($_SESSION['data_produk'])){
                            $i = 0;
                            foreach($_SESSION['data_produk'] as $info_item){

                                if($info_item['diskon'] > 0){
                                    echo 
                                    "<div class=\"w3-col l2 m4 w3-margin-bottom\">
                                        <div class=\"w3-display-container w3-border w3-round-large\">
                                        <a href=\"produk_desc.php?kodeProduk=".$info_item['kode']."&produk=".$info_item['tipe_produk']."\" >
                                            <img src=\"".$info_item['gbr']."\" alt=\"venue\" style=\"width:100%;max-width:200px\" 
                                            /></a>
                                            <div class=\"w3-padding\">
                                                <h6>".$info_item['nama']."</h6>
                                                <span class=\"fontHargaPromo\"><strike>Rp. ".number_format($info_item['harga'],0,",",".")."</strike></span>
                                                <span class=\"w3-tag w3-round bgcolorOrange w3-center\">".$info_item['diskon']."%</span>
                                                <br />
                                                <span class=\"w3-large\"> Rp. ".number_format(hasilHargaDisko($info_item['harga'], $info_item['diskon']),0,",",".")."</span>
                                                <div class=\"w3-center\">
                                                    <a href=\"index.php?kodeProdukBeli=".$info_item['kode']."\" 
                                                        class=\"w3-button bgcolorIjo w3-text-white\" style=\"width:65%;\" >Beli</a>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>";
                                    if (++$i == 6) break;   
                                }                                                                  
                            }
                        }else{
                            echo "<div style=\"text-align:center;\">Tidak Ada Data Produk</div>";
                        }
                    ?>
                </div>
                
            </div>

            <div class="w3-container w3-white w3-topbar w3-bottombar w3-leftbar w3-rightbar w3-round-large">
                <div class="w3-row">
                    <div class="w3-half w3-container">
                        <p style="text-align:left;"><b>Produk Makanan</b></p>
                    </div>
                    <div class="w3-half w3-container">
                        <p style="text-align:right; color:#f28439; "><a href="makanan.php" class="selengkapny">Selengkapnya 
                            <i class='fas fa-angle-right'></i></a></p>
                    </div>
                </div> 
                <div class="w3-row-padding sekerol">
                    <?php
                        if(isset($_SESSION['data_produk'])){
                            $i = 0;
                            foreach($_SESSION['data_produk'] as $info_item){
                                if($info_item['tipe_produk'] === 'makanan'){
                                    echo 
                                    "<div class=\"w3-col l2 m4 w3-margin-bottom\">
                                        <div class=\"w3-display-container w3-border\">
                                            <a href=\"produk_desc.php?kodeProduk=".$info_item['kode']."&produk=".$info_item['tipe_produk']."\" >
                                                <img src=\"".$info_item['gbr']."\" alt=\"venue\" style=\"width:100%;max-width:200px\" 
                                                    /></a>
                                            <div class=\"w3-padding\">

                                            <h6>".$info_item['nama']."</h6>";
                                            
                                            if($info_item['diskon'] > 0){
                                                echo"
                                                    <span class=\"fontHargaPromo\"><strike>Rp. ".number_format($info_item['harga'],0,",",".")."</strike></span>
                                                    <span class=\"w3-tag w3-round bgcolorOrange w3-center\">".$info_item['diskon']."%</span>
                                                    <br />
                                                    <span class=\"w3-large\"> Rp. ".number_format(hasilHargaDisko($info_item['harga'], $info_item['diskon']),0,",",".")."</span>";
                                            }else{
                                                echo "
                                                    <span>Rp. ".number_format($info_item['harga'],0,",",".")."</span>"; 
                                            }
                                            echo "                            
                                            <div class=\"w3-center w3-padding-16\">
                                                <a href=\"index.php?kodeProdukBeli=".$info_item['kode']."\" 
                                                    class=\"w3-button bgcolorIjo w3-text-white\" style=\"width:65%;\" >Beli</a>
                                            </div>
                            
                                            </div>
                                        </div>
                                    </div>";  
                                    if (++$i == 6) break; 
                                }                                    
                            }
                        }else{
                            echo "<div style=\"text-align:center;\">Tidak Ada Data</div>";
                        }
                    ?>
                </div>
            </div>

            <div class="w3-container w3-white w3-topbar w3-bottombar w3-leftbar w3-rightbar w3-round-large">
                <div class="w3-row">
                    <div class="w3-half w3-container">
                        <p style="text-align:left;"><b>Produk Minuman</b></p>
                    </div>
                    <div class="w3-half w3-container">
                        <p style="text-align:right; color:#f28439; "><a href="minuman.php" class="selengkapny">Selengkapnya</a> <i class='fas fa-angle-right'></i></p>
                    </div>
                </div> 
                <div class="w3-row-padding sekerol">
                    <?php
                        if(isset($_SESSION['data_produk'])){
                            $i = 0;
                            foreach($_SESSION['data_produk'] as $info_item){
                                if($info_item['tipe_produk'] === 'minuman'){
                                    echo 
                                    "<div class=\"w3-col l2 m4 w3-margin-bottom\">
                                        <div class=\"w3-display-container w3-border\">
                                            <a href=\"produk_desc.php?kodeProduk=".$info_item['kode']."&produk=".$info_item['tipe_produk']."\" >
                                                <img src=\"".$info_item['gbr']."\" alt=\"venue\" style=\"width:100%;max-width:200px\" 
                                                    /></a>
                                            <div class=\"w3-padding\">
                                            <h6>".$info_item['nama']."</h6>";

                                            if($info_item['diskon'] > 0){
                                                echo"
                                                    <span class=\"fontHargaPromo\"><strike>Rp. ".number_format($info_item['harga'],0,",",".")."</strike></span>
                                                    <span class=\"w3-tag w3-round bgcolorOrange w3-center\">".$info_item['diskon']."%</span>
                                                    <br />
                                                    <span class=\"w3-large\"> Rp. ".number_format(hasilHargaDisko($info_item['harga'], $info_item['diskon']),0,",",".")."</span>";
                                            }else{
                                                echo "
                                                    <span>Rp. ".number_format($info_item['harga'],0,",",".")."</span>"; 
                                            }

                                            echo "
                                            <div class=\"w3-center w3-padding-16\">
                                                <a href=\"index.php?kodeProdukBeli=".$info_item['kode']."\" 
                                                    class=\"w3-button bgcolorIjo w3-text-white\" style=\"width:65%;\" >Beli</a>
                                            </div>
                            
                                            </div>
                                        </div>
                                    </div>";  
                                    if (++$i == 6) break; 
                                }                                    
                            }
                        }else{
                            echo "<div style=\"text-align:center;\">Tidak Ada Data</div>";
                        }
                    ?>  
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
            var alert = document.getElementById('alert1');
            alert.style.display = 'none';
            var alert2 = document.getElementById('alert2');
            alert2.style.display = 'none';
            var alert3 = document.getElementById('alert3');
            alert3.style.display = 'none';
            var login_1 = document.getElementById('login_1');
            login_1.style.display = 'none';
            var login_2 = document.getElementById('login_2');
            login_2.style.display = 'none';
            var reg_1 = document.getElementById('reg_1');
            reg_1.style.display = 'none';
            var reg_2 = document.getElementById('reg_2');
            reg_2.style.display = 'none';
            var reg_3 = document.getElementById('reg_3');
            reg_3.style.display = 'none';
            var reg_4 = document.getElementById('reg_4');
            reg_4.style.display = 'none';
            var reg_5 = document.getElementById('reg_5');
            reg_5.style.display = 'none';
            

            function nameCheck(){
                var name = document.getElementById('nameID');              
                
                if(!(name.value === "") && (name.value.match(/^[0-9a-zA-Z]+$/))){       
                    login_1.style.display = 'none';        
                    return true;
                }else{
                    login();
                    login_1.style.display = 'block';
                    return false;
                }
            }            

            function passCheck(){
                var pass = document.getElementById('passID');              
                
                if(!(pass.value === "") && (pass.value.match(/^[0-9a-zA-Z]+$/))){                     
                    login_2.style.display = 'none';              
                    return true;
                }else{
                    login();                    
                    login_2.style.display = 'block';
                    return false;
                }
            }

            function nameCheckReg(){
                var name = document.getElementById('nameIDreg');              
                
                if(!(name.value === "") && (name.value.match(/^[0-9a-zA-Z]+$/))){ 
                    reg_1.style.display = 'none';              
                    return true;
                }else{
                    register();
                    reg_1.style.display = 'block';
                    return false;
                }
            }

            function passCheckReg(){
                var pass = document.getElementById('passIDreg1');    
                var pass2 = document.getElementById('passIDreg2');           
                
                if(!(pass.value === "") && (pass.value.match(/^[0-9a-zA-Z]{8,255}$/)) && (pass.value === pass2.value)){               
                    reg_3.style.display = 'none';
                    return true;
                }else{
                    register();
                    reg_3.style.display = 'block';
                    return false;
                }
            }

            function emailCheckReg(){
                var mail = document.getElementById('emailIDreg');

                if(!(mail.value === "") && (mail.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/))){
                    reg_2.style.display = 'none';
                    return true;
                }else{
                    reg_2.style.display = 'block';
                    return false;
                }
            }

            function alamatCheckReg(){
                var alamat = document.getElementById('alamatIDreg');

                if(!(alamat.value === "") && (alamat.value.match(/^[0-9a-zA-Z .]+$/))){               
                    reg_4.style.display = 'none';
                    return true;
                }else{
                    register();
                    reg_4.style.display = 'block';
                    return false;
                }
            }

            function kodeCheck(){
                var kode1 = document.getElementById('kode1');    
                var kode2 = document.getElementById('kode2');  
                var kode3 = document.getElementById('kode3');  
                var kode4 = document.getElementById('kode4');  
                var kode5 = document.getElementById('kode5');  
                var kode6 = document.getElementById('kode6');            
                
                if(!(kode1.value === "") && (kode1.value.match(/^[0-9]+$/))
                    && !(kode2.value === "") && (kode2.value.match(/^[0-9]+$/))
                    && !(kode3.value === "") && (kode3.value.match(/^[0-9]+$/))
                    && !(kode4.value === "") && (kode4.value.match(/^[0-9]+$/))
                    && !(kode5.value === "") && (kode5.value.match(/^[0-9]+$/))
                    && !(kode6.value === "") && (kode6.value.match(/^[0-9]+$/))){               
                    return true;
                }else{
                    verify_modal();
                    return false;
                }
            }

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
                document.getElementById('verify_modal').style.display='none';
            }
            
            function register(){
                document.getElementById('login_modal').style.display='none';
                document.getElementById('register_modal').style.display='block';
                document.getElementById('verify_modal').style.display='none';
            }

            function verify_modal(){
                document.getElementById('login_modal').style.display='none';
                document.getElementById('register_modal').style.display='none';
                document.getElementById('verify_modal').style.display='block';
            }

            function openCity(evt, cityName) {
                var i, x, tablinks;
                x = document.getElementsByClassName("city");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < x.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" bgcolorIjo", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " bgcolorIjo";
            }

            function finalCheck(){               
                var name = nameCheck();
                var pass = passCheck();

                if(name === true && pass === true){
                    document.getElementById('form1').submit();
                }else{
                    alert.style.display = 'block';
                }

            }

            function finalCheckReg(){               
                var name = nameCheckReg();
                var pass = passCheckReg();
                var email = emailCheckReg();
                var alamat = alamatCheckReg();

                if(name === true && pass === true && email === true && alamat === true ){
                    document.getElementById('form2').submit();
                }else{
                    alert2.style.display = 'block';
                }

            }

        </script>

    </body>
</html>
