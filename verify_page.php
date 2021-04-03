<?php

    //session_start();   

    $infoPage = pathinfo( __FILE__ );
    $page = $infoPage['filename'];     

    //$_SESSION['kode_fix'] = "";

    /*
    if(isset($_POST['kode1'])){
        $kode = $_POST['kode1']. $_POST['kode2'] . $_POST['kode3'] . $_POST['kode4'] 
                . $_POST['kode5'] . $_POST['kode6'];
        global $kodeTes;
        $kodeTes = $kode;
    }
    */

    include('index_function.php');
        
    if(!isset($_SESSION['state_aktivasi_final'])){
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
                <a href="index.php"><img src="gambar/aksesoris_page/logo.jpg" alt="logo" 
                    style="width:100%;max-width:180px" /></a>
                <!-- Float links to the right. Hide them on small screens -->
                <div class="w3-right">
                    <a href="about.php" class="w3-bar-item w3-button w3-hide-small">Tentang Kami</a>
                    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right 
                    w3-hide-large w3-hide-medium" onclick="myFunction()"><i id="openMenu" class="fas fa-bars"></i></a>
                </div>

                <div id="demo" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium">
                    <a href="about.php" class="w3-bar-item w3-button">Tentang Kami</a>
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"></a>
                </div>
            
            </div>

        </div>

        <div class="w3-content w3-padding" style="max-width:700px">
            <?php
                if(isset($_SESSION['state_aktivasi_final'])){
                    if($_SESSION['state_aktivasi_final'] === true){
                        echo "
                            <div class=\"w3-panel w3-green w3-round w3-padding\">
                                <h3>Selamat!</h3>
                                <p>Proses aktivasi anda berhasil. Silahkan Log In Kembali.</p>
                                <a href=\"index.php\" 
                                    class=\"w3-button bgcolorOrange w3-text-white\" style=\"width:25%;\" >Log In</a>
                            </div>";
                    }elseif($_SESSION['state_aktivasi_final'] === false){
                        echo "
                            <div class=\"w3-panel w3-red w3-round w3-padding\">
                                <h3>Aduh!</h3>
                                <p>Proses aktivasi anda gagal.</p>
                            </div>";
                    }
                    unset($_SESSION['state_aktivasi_final']);
                }else{
                    echo "
                        <div class=\"w3-panel w3-red w3-round w3-padding\">
                            <h3>Mohon Ulangi Proses Register!</h3>
                            <a href=\"index.php\" 
                                class=\"w3-button bgcolorOrange w3-text-white\" 
                                    style=\"width:25%;\" >Log In</a>
                        </div>";
                        
                }          
            
            ?>
        </div>

        <!-- Footer -->
        <footer class="w3-center w3-margin-top w3-white w3-padding w3-border">
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
            var alert3 = document.getElementById('alert3');
            alert3.style.display = 'none';

            function nameCheck(){
                var name = document.getElementById('nameID');              
                
                if(!(name.value === "") && (name.value.match(/^[0-9a-zA-Z]+$/))){               
                    return true;
                }else{
                    login();
                    return false;
                }
            }            

            function passCheck(){
                var pass = document.getElementById('passID');              
                
                if(!(pass.value === "") && (pass.value.match(/^[0-9a-zA-Z]+$/))){               
                    return true;
                }else{
                    login();
                    return false;
                }
            }

            function nameCheckReg(){
                var name = document.getElementById('nameIDreg');              
                
                if(!(name.value === "") && (name.value.match(/^[0-9a-zA-Z]+$/))){               
                    return true;
                }else{
                    register();
                    return false;
                }
            }

            function passCheckReg(){
                var pass = document.getElementById('passIDreg1');    
                var pass2 = document.getElementById('passIDreg2');           
                
                if(!(pass.value === "") && (pass.value.match(/^[0-9a-zA-Z]{8,255}$/)) && (pass.value === pass2.value)){               
                    return true;
                }else{
                    register();
                    return false;
                }
            }

            function emailCheckReg(){
                var mail = document.getElementById('emailIDreg');

                if(!(mail.value === "") && (mail.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/))){
                    return true;
                }else{
                    return false;
                }
            }

            function alamatCheckReg(){
                var alamat = document.getElementById('alamatIDreg');

                if(!(alamat.value === "") && (alamat.value.match(/^[0-9a-zA-Z .]+$/))){               
                    return true;
                }else{
                    register();
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
                
                if(!(kode1.value === "") && (kode1.value.match(/^[0-9]{1,1}$/))
                    && !(kode2.value === "") && (kode2.value.match(/^[0-9]{1,1}$/))
                    && !(kode3.value === "") && (kode3.value.match(/^[0-9]{1,1}$/))
                    && !(kode4.value === "") && (kode4.value.match(/^[0-9]{1,1}$/))
                    && !(kode5.value === "") && (kode5.value.match(/^[0-9]{1,1}$/))
                    && !(kode6.value === "") && (kode6.value.match(/^[0-9]{1,1}$/))){               
                    return true;
                }else{
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

            function verifyCheck(){               
                var kode = kodeCheck();

                if(kode === true){
                    document.getElementById('form3').submit();
                }else{
                    alert3.style.display = 'block';
                }
            }

        </script>

    </body>
</html>


<!--            <div id="verify_modal" class="">
                <div class="w3-white w3-margin-top w3-animate-top">
                    <header class="w3-container bgcolorIjo w3-text-white w3-center"> 
                        <h2>Verifikasi Akun Anda</h2>
                    </header>
                    <div class="w3-container w3-padding">
                        <div id="alert3" class="w3-panel w3-red w3-padding">
                            <strong>Format Kode Salah!</strong> Tolong masukkan format kode dengan benar.
                        </div>
                        <form id="form3" action="" method="post">
                            <div class="w3-center w3-large w3-margin-top">
                                <input id="kode1" class="" style="text-align:center;" type="text" placeholder="_" name="kode1" maxlength="1" size="1" />
                                <input id="kode2" class="" style="text-align:center;" type="text" placeholder="_" name="kode2" maxlength="1" size="1" />
                                <input id="kode3" class="" style="text-align:center;" type="text" placeholder="_" name="kode3" maxlength="1" size="1" />
                                <input id="kode4" class="" style="text-align:center;" type="text" placeholder="_" name="kode4" maxlength="1" size="1" />
                                <input id="kode5" class="" style="text-align:center;" type="text" placeholder="_" name="kode5" maxlength="1" size="1" />
                                <input id="kode6" class="" style="text-align:center;" type="text" placeholder="_" name="kode6" maxlength="1" size="1" /><br />
                                <input type="button" class="w3-button bgcolorIjo w3-text-white w3-margin" onclick="verifyCheck()" value="Submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->