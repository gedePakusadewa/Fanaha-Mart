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
                                <a href=\"admin.php?out=true\" class=\"w3-bar-item w3-button w3-hide-small\">Log Out</a>";
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
                                <a href=\"admin.php?out='1'\" class=\"w3-bar-item w3-button\">Log Out</a>";
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
            <div class="w3-container w3-white w3-topbar w3-bottombar w3-leftbar w3-rightbar w3-round-large w3-padding">
                
                <h3>Tabel lengkap semua produk Fanaha Mart</h3>

                <?php
                    if(isset($_SESSION["data_produk"])){
                        echo "
                            <table class=\"w3-table-all\" cellpadding=\"10\" cellspacing=\"1\">
                                <thead>			
                                    <tr class=\"w3-red w3-text-white\">
                                        <th style=\"text-align:left;\">id</th>                                            
                                        <th style=\"text-align:center;\" >nama</th>
                                        <th style=\"text-align:center;\" >kode</th>
                                        <th style=\"text-align:center;\" >harga</th>
                                        <th style=\"text-align:center;\" >Keterangan 1</th>
                                        <th style=\"text-align:center;\" >Keterangan 2</th>
                                        <th style=\"text-align:center;\" >Keterangan 3</th>
                                        <th style=\"text-align:center;\" >tipe produk</th>
                                    </tr>
                                </thead>";	
                        foreach ($_SESSION["data_produk"] as $item){

                            $item_price = 0;
                            $hargaSatuan = 0;
                            $hargaAwal = "";

                            if($item['diskon'] > 0){
                                $hargaSatuan = (int)$item["harga"] - (((int)$item["harga"] * 
                                    (int)$item['diskon'])/100); 
                                $hargaAwal = "<span class=\"fontHargaPromo\"><strike>Rp. 
                                    ".number_format($item['harga'],0,",",".")."</strike></span><br />";
                            }else{
                                $hargaSatuan = (int)$item['harga'];
                                $hargaAwal = "";
                            }

                            echo"
                                <tr>
                                    <td style=\"text-align:center;\">".$item["id"]."</td>
                                    <td> <a href=\"../produk_desc.php?kodeProduk=".$item['kode']."&produk=".$item['tipe_produk']."\" 
                                        class=\"selengkapny\" ><img src=\"../".$item["gbr"]."\" style=\"width:40%;max-width:100px; text-align:center;\" 
                                            />".$item["nama"];

                                    if($item['diskon'] > 0){
                                        echo "
                                            <span class=\"w3-tag w3-round bgcolorOrange w3-center\">".$item['diskon']."%</span>"; 
                                    }

                                    echo "</a></td>
                                    <td style=\"text-align:center;\">".$item["kode"]."</td>
                                    <td style=\"text-align:center;\">".$hargaAwal."Rp. ".number_format($hargaSatuan,0,",",".")."</td>
                                    <td style=\"text-align:center;\">".$item["lain1"]."</td>
                                    <td style=\"text-align:center;\">".$item["lain2"]."</td>
                                    <td style=\"text-align:center;\">".$item["lain3"]."</td>
                                    <td style=\"text-align:center;\">".$item["tipe_produk"]."</td>
                                </tr>";                                        
                        }
                            echo"			
                        </table>";	
                        

                    } else {
                        echo "
                            <table class=\"w3-table-all\" cellpadding=\"10\" cellspacing=\"1\">
                                <thead>			
                                    <tr class=\"w3-red w3-text-white\">
                                        <th style=\"text-align:left;\">ID produk</th>                                            
                                        <th style=\"text-align:center;\" >nama</th>
                                        <th style=\"text-align:center;\" >kode</th>
                                        <th style=\"text-align:center;\" >harga</th>
                                        <th style=\"text-align:center;\" >Keterangan 1</th>
                                        <th style=\"text-align:center;\" >Keterangan 2</th>
                                        <th style=\"text-align:center;\" >Keterangan 3</th>
                                        <th style=\"text-align:center;\" >tipe produk</th>
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
