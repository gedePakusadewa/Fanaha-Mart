<?php
    
    $infoPage = pathinfo( __FILE__ );
    $page = $infoPage['filename'];  

    include('../index_function.php');

    if (isset($_GET['out'])) {
        deleteSessionOrder();
    }

    if(!isset($_SESSION['user']) || $_SESSION['user']['username_log'] !== 'admin'){
        header('Location: ../index.php');
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
        <link rel="stylesheet" href="../css/css_home_page.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    </head>
    
    <body class="w3-small" style="background-color:#cccccc;">

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <div class="w3-bar w3-white w3-medium w3-padding w3-card">
                <a href="../index.php#home"><img src="../gambar/aksesoris_page/logo.jpg" alt="logo" 
                    style="width:100%;max-width:180px" /></a>
                <!-- Float links to the right. Hide them on small screens -->
                <div class="w3-right">
                    <?php
                        if(isset($_SESSION['user'])){
                            echo "<a href=\"admin.php\" class=\"w3-bar-item w3-button w3-border-right w3-hide-small\">".$_SESSION['user']['username_log']."</a>
                                <a href=\"daftar_produk.php?out=true\" class=\"w3-bar-item w3-button w3-hide-small\">Log Out</a>";
                        }else{
                            echo"<a onclick=\"login()\" 
                            class=\"w3-bar-item w3-button w3-hide-small\">Masuk | Daftar</a>";
                        }
                    ?>
                    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right 
                    w3-hide-large w3-hide-medium" onclick="myFunction()"><i id="openMenu" class="fas fa-bars"></i></a>
                </div>

                <div id="demo" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium">
                    <a href="admin.php" class="w3-bar-item w3-button">Daftar Produk Lengkap</a>
                    <a href="daftar_produk.php" class="w3-bar-item w3-button">Daftar Produk Lengkap</a>
                    <a href="data_pelanggan.php" class="w3-bar-item w3-button">Data Pelanggan</a>
                    <?php
                        if(isset($_SESSION['user'])){
                            echo "<a href=\"admin.php\" class=\"w3-bar-item w3-button w3-border-right\">".$_SESSION['user']."</a>
                                <a href=\"daftar_produk.php?out='1'\" class=\"w3-bar-item w3-button\">Log Out</a>";
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
                            <a href="admin.php" class="w3-bar-item w3-button w3-hide-small">Daftar Produk Lengkap</a>
                        </div>
                        <div class="w3-center w3-container w3-quarter">
                            <a href="daftar_produk.php" class="w3-bar-item w3-button w3-hide-small">Daftar Produk</a>
                        </div>
                        <div class="w3-center w3-container w3-quarter">
                            <a href="data_pelanggan.php" class="w3-bar-item w3-button w3-hide-small">Data Pelanggan</a>
                        </div>
                    </div>  
                </div>
                <div class="w3-col  w3-container" style="width:20%"></div>
            </div>

        </div>  

        <!-- Page content -->
        <div class="w3-content marginKhusus1 w3-padding" style="max-width:1564px">
            <div>
            </div>
            <div class="w3-container w3-white w3-topbar w3-bottombar w3-leftbar w3-rightbar w3-round-large">
                <?php
                    if(isset($_GET['edit_daftar_produk'])){
                        if(isset($_SESSION['data_produk'])){
                            echo"                
                                <div class=\"w3-row\">
                                    <div class=\"w3-container w3-third w3-rightbar\">
                                        <img src=\"../".$_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['gbr']."\" alt=\"venue\" style=\"width:100%;max-width:400px\" />
                                    </div>                    
                                    <div class=\"w3-container w3-twothird\">
                                        <div class=\"w3-row\">
                                            <div class=\"w3-half w3-container\">
                                                <div class=\"w3-container w3-padding w3-border-bottom w3-margin-top\">
                                                    <h6>Data sebelum disunting.</h6></div>
                                                <h4>".$_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['nama']."</h4>";
                                                if($_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['diskon'] > 0){                                              
                                                    echo "<span class=\"fontHargaPromo\"><strike>Rp. ".number_format($_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['harga'],0,",",".").
                                                            "</strike></span>
                                                        <span class=\"w3-tag w3-round bgcolorOrange w3-center\">".
                                                        $_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['diskon']."%</span></h4>
                                                        <h4>Rp. ".number_format(hasilHargaDisko($_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['harga'], 
                                                        $_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['diskon']),0,",",".");                                                           
                                                    
                                                }else{
                                                    echo "<h4>Rp. ".number_format($_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['harga'],0,",",".")."</h4>";
                                                }
                                            
                                            echo"
                                                <h5>Keterangan 1:</h5><p>".$_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['lain1']."</p>
                                                <h5>Keterangan 2:</h5><p>".$_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['lain2']."</p>
                                                <h5>Keterangan 3:</h5><p>".$_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['lain3']."</p>
                                            </div>
                                            <div class=\"w3-half w3-container\">
                                                <div class=\"w3-container w3-padding w3-border-bottom w3-margin-top\"><h6>Data yang akan di sunting.</h6></div>
                                                <form class=\"w3-margin-top\" action=\"daftar_produk.php?editBoleh_FORM=true&kodeEdit_FORM=".$_GET['kodeEdit_daftar_produk']."\" method=\"post\">
                                                    
                                                    <label>Kode</label>
                                                    <input type=\"text\" class=\"w3-input w3-border\" name=\"kode_edit_FORM\" value=\"".$_GET['kodeEdit_daftar_produk']."\" disabled/>
                                                    
                                                    <br /><label>Nama Produk :</label>
                                                    <textarea class=\"w3-input w3-border\" name=\"nama_edit_FORM\" rows=\"2\" cols=\"40\">".$_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['nama']."</textarea>
                                                    
                                                    <br /><label>Harga (min = 100, max = 500.000) :</label>
                                                    <input type=\"number\" class=\"w3-input w3-border\" name=\"harga_edit_FORM\" value=".$_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['harga']." min=\"100\" max=\"500000\" />
                                                    
                                                    <br /><label>Diskon (min = 0, max = 100) :</label>
                                                    <input type=\"number\" class=\"w3-input w3-border\" name=\"diskon_edit_FORM\" value=".$_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['diskon']." min=\"0\" max=\"100\" />
                                                    
                                                    <br /><label>Keterangan satu:</label>
                                                    <textarea class=\"w3-input w3-border\" name=\"lain1_edit_FORM\" rows=\"5\" cols=\"40\">".$_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['lain1']."</textarea>
                                                    
                                                    <br /><label>Keterangan dua:</label>
                                                    <textarea class=\"w3-input w3-border\" name=\"lain2_edit_FORM\" rows=\"1\" cols=\"40\">".$_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['lain2']."</textarea>
                                                    
                                                    <br /><label>Keterangan tiga:</label>
                                                    <textarea class=\"w3-input w3-border\" name=\"lain3_edit_FORM\" rows=\"5\" cols=\"40\">".$_SESSION['data_produk'][$_GET['kodeEdit_daftar_produk']]['lain3']."</textarea>
                                                    
                                                    <br /><input class=\"w3-button bgcolorIjo w3-text-white w3-round w3-padding-large w3-margin-bottom\" type=\"submit\" value=\"Simpan\" \>
                                                    <br />                                     
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }else{
                            echo "<div style=\"text-align:center;\">Tidak Ada Data</div>";
                        }
                    }else{
                        echo "<div style=\"text-align:center;\">Tidak Ada Data</div>";
                    }              
                ?>               
            </div>

        <!-- End page content -->
        </div>

        <!-- Footer -->
        <footer class="w3-center w3-white w3-padding w3-border">
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
