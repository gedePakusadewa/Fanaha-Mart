<?php

    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception; 

    require 'C:\xampp\composer\vendor\autoload.php';  

    session_start();   

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "fanaha_mart";

    //$kodeTes;

    $db = new mysqli($servername, $username, $password, $dbname);

    if ($db->connect_error) {
        die("Koneksi Gagal: " . $db->connect_error);
    }

    if(isset($page)){
        global $page;

        if($page === "index"){     
            getDataBrand();
            getDataBrandMini();
            getBigDataProduk();            
        }

        if($page === "profil"){       
            getDataHistori();
        }

        if($page === "data_pelanggan"){       
            getDataPelanggan();
        }
        
    }

    function getBigDataProduk(){
        unset($_SESSION['data_produk']);

        $data_id = getDataBaris("SELECT id FROM data_produk");
        
        for($i = 0; $i < count($data_id); $i++){
            $id = $data_id[$i];

            $data_satuan = runQuery("SELECT id, nama, kode, harga, diskon, lain1, lain2, lain3, gbr, tipe_produk
                FROM data_produk WHERE id = '$id' ");
        
            $array_data_satuan = array(
                $data_satuan[0]['kode']
                    =>array('id'=>$data_satuan[0]['id'],
                            'nama'=>$data_satuan[0]['nama'], 
                            'kode'=>$data_satuan[0]['kode'],
                            'harga'=>$data_satuan[0]['harga'],                             
                            'diskon'=>$data_satuan[0]['diskon'],
                            'lain1'=>$data_satuan[0]['lain1'],
                            'lain2'=>$data_satuan[0]['lain2'], 
                            'lain3'=>$data_satuan[0]['lain3'],
                            'tipe_produk'=>$data_satuan[0]['tipe_produk'],
                            'gbr'=>$data_satuan[0]['gbr']
                    )
            );

            if(!isset($_SESSION['data_produk'])){
                $_SESSION['data_produk'] = $array_data_satuan;
            }else{
                $_SESSION['data_produk'] = array_merge($_SESSION['data_produk'] 
                    , $array_data_satuan);
            }
        }
    }

    function hasilHargaDisko($harga, $diskon){
        return $harga - (($harga*$diskon)/100);
    }

    function getDataBrand(){
        unset($_SESSION['brand']);

        $data_id = getDataBaris("SELECT id FROM brand");
        
        for($i = 0; $i < count($data_id); $i++){
            $id = $data_id[$i];
            $data_satuan = runQuery("SELECT id, nama, kode, gbr
                FROM brand WHERE id = '$id' ");
        
            $array_data_satuan = array(
                $data_satuan[0]['kode']
                    =>array('id'=>$data_satuan[0]['id'],
                            'nama'=>$data_satuan[0]['nama'], 
                            'kode'=>$data_satuan[0]['kode'],
                            'gbr'=>$data_satuan[0]['gbr']
                    )
            );

            if(!isset($_SESSION['brand'])){
                $_SESSION['brand'] = $array_data_satuan;
            }else{
                $_SESSION['brand'] = array_merge($_SESSION['brand'] 
                    , $array_data_satuan);
            }
        }
    }

    function getDataBrandMini(){
        unset($_SESSION['brand_mini']);

        $data_id = getDataBaris("SELECT id FROM brand_mini");
        
        for($i = 0; $i < count($data_id); $i++){
            $id = $data_id[$i];
            $data_satuan = runQuery("SELECT id, nama
                FROM brand_mini WHERE id = '$id' ");
        
            $array_data_satuan = array(
                $data_satuan[0]['nama']
                    =>array('id'=>$data_satuan[0]['id'],
                            'nama'=>$data_satuan[0]['nama']
                    )
            );

            if(!isset($_SESSION['brand_mini'])){
                $_SESSION['brand_mini'] = $array_data_satuan;
            }else{
                $_SESSION['brand_mini'] = array_merge($_SESSION['brand_mini'] 
                    , $array_data_satuan);
            }
        }
    }

    //bisa dipakek ngambil semua data dalam satu kolom aja
    function getDataBaris($sql_query){
        global $db;

        $result = $db->query($sql_query);
        $array_list = [];
        $incre = 0;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $array_list[$incre] =  $row['id'];
                    $incre = $incre + 1;
            }
        }
        return $array_list;
    }

    //bisa dipakek buat ngambil semua data dalam sau baris aja
    function runQuery($query) {
        global $db;
        $result = mysqli_query($db,$query);
        
		while($row = mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
        }
        		
		if(!empty($resultset)){
            return $resultset;
        }            
    }

    function deleteSessionOrder(){
        global $page;

        unset($_SESSION['user']);
        unset($_SESSION['order_produk']);
        unset($_SESSION['total_order']);

        header("Location: ".$page.".php");
        exit();
    }

    if(isset($_GET['hapusSemuaOrder'])){
        unset($_SESSION['order_produk']);
        unset($_SESSION['total_order']);
    }

    if(isset($_POST['username'])){
        login();
    }

    if(isset($_POST['usernameReg'])){
        $_SESSION['kode_email'] = rand(10000000,99999999);
        $data_email = "http://localhost:8080/fanaha_mart/verify_page.php?kode_aktivasi=".$_SESSION['kode_email'];
        emailVerify($data_email, $_POST['emailReg']);
        registerTEMP();
    } 

    /*
    if(isset($_POST['usernameReg'])){
        $_SESSION['kode_email'] = rand(100000,999999);
        //$_SESSION['kode_email'] = 111111;
        $data_email = "http://localhost:8080/fanaha_mart/verify_page.php?kode=".$_SESSION['kode_email'];
        emailVerify($data_email,$_POST['emailReg']);
        registerToSession();
        $_SESSION['stateVerifyKode'] = true;
        header('Location: verify_page.php');
        exit();
    } 
    */

    function registerToSession(){
        $arrayFinal['username'][$_POST['usernameReg']];
        $arrayFinal['email'][$_POST['emailReg']];
        $arrayFinal['password'][$_POST['passwordReg1']];
        $arrayFinal['alamat'][$_POST['alamatReg']];
        
        $_SESSION['registerToSession'] = $arrayFinal;
    }

    if(!empty($kodeTes)){
        if((int)$_SESSION['kode_email'] === (int)$kodeTes){
            echo var_dump($_SESSION['kode_email'])."<br />";
            echo var_dump($kodeTes)."<br />";
            register();
            header('Location: index.php');
            exit();
        }else{
            echo "asdaskjdlasdi alksdjalskd ";
            header('Location: verify_page.php');
            exit();
        }
    }
    
    if(isset($_GET['kode_aktivasi'])){
        
        $kode = $_GET['kode_aktivasi'];

        $data_id = getDataBaris("SELECT id FROM data_user_temp WHERE kode_aktivasi='$kode'");
        
        if($data_id !== null){
            $id = $data_id[0];
            $data_satuan = runQuery("SELECT id, username_log, 
                password_log, email_log, alamat, tipe_user
                FROM data_user_temp WHERE id = '$id' ");
        
            //var_dump($data_satuan);
            register_final($data_satuan);            
        }
        
    }
    /*
    if(isset($_POST['kode1'])){
        echo var_dump($_POST['kode1']);
        $kode = $_POST['kode1'] + $_POST['kode2'] + $_POST['kode3'] + $_POST['kode4'] 
                + $_POST['kode5'] + $_POST['kode6'];
                echo "pass1 = ".$kode."<br />";
                echo "pass1 = ".$_SESSION['kode_email']."<br />";
        if((int)$_SESSION['kode_email'] === (int)$kode){
            register();
            echo "asdasdasads";
            header('Location: index.php');
            exit();
        }else{
            header('Location: verify_page.php');
            exit();
        }
    }else{
        echo "pass2 = ".$_SESSION['kode_email']."<br />";
    }
    */

    /*
    function register(){
        $data = $_SESSION['registerToSession'];          
        unset($_SESSION['kode_email']);
        unset($_SESSION['stateVerifyKode']);

        global $db, $errors, $username, $email;

        $username    =  e($data['usernameReg']);
        $username    =  stripslashes($username);

        $email       =  e($data['emailReg']);
        $email       =  stripslashes($email);

        $alamat      =  e($data['alamatReg']);

        $password_1  =  e($data['passwordReg1']);

        $password = ($password_1);
    
        $dat1 = $username;
        $dat2 = $password;
        $dat3 = $email;        
        $dat4 = $alamat;
        $dat5 = "normal";

        $stmt_register = $db->prepare("INSERT INTO data_user (username_log, 
        password_log, email_log, alamat, tipe_user) VALUES (?, ?, ?, ?, ?)");
        $stmt_register->bind_param("sssss", $dat1, $dat2, $dat3, $dat4, $dat5);           

        if($stmt_register->execute()){
        }

        $stmt_register->close();
        
    }
    */

    function register_final($data_2){
                  
        $data = $data_2;          

        global $db, $errors, $username, $email;

        $username    =  e($data[0]['username_log']);
        $username    =  stripslashes($username);

        $email       =  e($data[0]['email_log']);
        $email       =  stripslashes($email);

        $alamat      =  e($data[0]['alamat']);

        $password_1  =  e($data[0]['password_log']);

        $password = ($password_1);
    
        $dat1 = $username;
        $dat2 = $password;
        $dat3 = $email;        
        $dat4 = $alamat;
        $dat5 = "normal";

        $stmt_register = $db->prepare("INSERT INTO data_user (username_log, 
        password_log, email_log, alamat, tipe_user) VALUES (?, ?, ?, ?, ?)");
        $stmt_register->bind_param("sssss", $dat1, $dat2, $dat3, $dat4, $dat5);           

        if($stmt_register->execute()){
        }

        $stmt_register->close();


        $id =  $data[0]['id'];

        $sql = "DELETE FROM data_user_temp WHERE id= '$id' ";

        if ($db->query($sql) === TRUE) {
            $_SESSION['state_aktivasi_final'] = true;
        } else {
            $_SESSION['state_aktivasi_final'] = false;
        }
        
        unset($_SESSION['kode_email']);
    }

    function registerTEMP(){

        global $db, $errors, $username, $email;

        $username    =  e($_POST['usernameReg']);
        $username    =  stripslashes($username);

        $email       =  e($_POST['emailReg']);
        $email       =  stripslashes($email);

        $alamat      =  e($_POST['alamatReg']);

        $password_1  =  e($_POST['passwordReg1']);

        $password = ($password_1);
    
        $dat1 = $username;
        $dat2 = $password;
        $dat3 = $email;        
        $dat4 = $alamat;
        $dat5 = "normal";
        $dat6 = $_SESSION['kode_email'];

        $stmt_register = $db->prepare("INSERT INTO data_user_temp (username_log, 
        password_log, email_log, alamat, tipe_user, kode_aktivasi) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_register->bind_param("ssssss", $dat1, $dat2, $dat3, $dat4, $dat5, $dat6);           

        if($stmt_register->execute()){
        }

        $stmt_register->close();
        
    }

    function login(){
        global $page, $error;

        $username  = e($_POST['username']);

        $password  = e($_POST['password']);

        $data_login = runQuery("SELECT id, username_log, email_log, password_log, 
        alamat, tipe_user FROM data_user WHERE username_log = '$username' AND 
        password_log = '$password ' LIMIT 1");

        $data_login_2 = 
            array(
                'id'=>$data_login[0]['id'],
                'username_log'=>$data_login[0]['username_log'], 
                'email_log'=>$data_login[0]['email_log'],
                'password_log'=>$data_login[0]['password_log'],
                'alamat'=>$data_login[0]['alamat'],
                'tipe_user'=>$data_login[0]['tipe_user']               
        );

        if($data_login_2['tipe_user'] === 'admin'){
            $_SESSION['user'] = $data_login_2;
            header('Location: admin/admin.php');
            exit();
        }else{
            $_SESSION['user'] = $data_login_2;
            header('Location: '.$page.'.php');
            exit();
        }    

        /*
        if(!isset($_SESSION['brand'])){
            $_SESSION['brand'] = $array_data_satuan;
        }else{
            $_SESSION['brand'] = array_merge($_SESSION['brand'] 
                , $array_data_satuan);
        }

        if($stmt_login = $db->prepare("SELECT * FROM data_user WHERE username_log = ? AND 
            password_log = ? LIMIT 1")){

            $stmt_login->bind_param("dd", $username, $password);

            $stmt_login->execute();
    
            $hasil_login = $stmt_login->get_result();

            if (($hasil_login->num_rows) == 1) {
                
                $logged_in_user = $hasil_login->fetch_assoc();

                if ($logged_in_user['tipe_user'] == 'admin') {

                }else if ($logged_in_user['tipe_user'] == 'normal'){
                    
                    $_SESSION['user'] = $logged_in_user;
                    header('Location: '.$page.'.php');
                    exit();
                }
            }

            $stmt_login->close();
        }    
           */     
    }

    function e($val){
        global $db;
        return mysqli_real_escape_string($db, trim($val));
    }

    //jika teken tombol beli bukan lewat page produk desc
    if(isset($_GET['kodeProdukBeli'])){
        global $page;
        if(isset($_SESSION['user'])){
            addProdukOrder($_GET['kodeProdukBeli'], 1);
        }else{
            header('Location: '.$page.'.php');
            exit();
        }        
    }

    //add order lewat produk desc
    function addProdukOrder($kode_produk, $kuantitasBeli){

        $kode = str_replace(" ", "", $kode_produk);
        $kuantitas = (int)str_replace(" ", "", $kuantitasBeli);

        /*
        $data_satuan = runQuery("SELECT id, nama, kode, harga, diskon, lain1, lain2, lain3, gbr, tipe_produk
                FROM data_produk WHERE kode = '$id' ");

        
        $array_data_satuan = array(
            $_SESSION['data_produk'][$id_produk]
                =>array('id'=>$_SESSION['data_produk'][$id_produk]['id'],
                        'nama'=>$_SESSION['data_produk'][$id_produk]['nama'], 
                        'kode'=>$_SESSION['data_produk'][$id_produk]['kode'],
                        'harga'=>$_SESSION['data_produk'][$id_produk]['harga'], 
                        'lain1'=>$_SESSION['data_produk'][$id_produk]['lain1'],
                        'lain2'=>$_SESSION['data_produk'][$id_produk]['lain2'], 
                        'lain3'=>$_SESSION['data_produk'][$id_produk]['lain3'],
                        'tipe_produk'=>$_SESSION['data_produk'][$id_produk]['tipe_produk'],
                        'diskon'=>$_SESSION['data_produk'][$id_produk]['diskon'],
                        'kuantitas'=>1,
                        'gbr'=>$_SESSION['data_produk'][$id_produk]['gbr']
                )
        );
        */

        $array_data_satuan[$kode]['id'] = $_SESSION['data_produk'][$kode]['id'];
        $array_data_satuan[$kode]['nama'] = $_SESSION['data_produk'][$kode]['nama'];
        $array_data_satuan[$kode]['kode'] = $_SESSION['data_produk'][$kode]['kode'];
        $array_data_satuan[$kode]['harga'] = $_SESSION['data_produk'][$kode]['harga'];
        $array_data_satuan[$kode]['lain1'] = $_SESSION['data_produk'][$kode]['lain1'];
        $array_data_satuan[$kode]['lain2'] = $_SESSION['data_produk'][$kode]['lain2'];
        $array_data_satuan[$kode]['lain3'] = $_SESSION['data_produk'][$kode]['lain3'];
        $array_data_satuan[$kode]['tipe_produk'] = $_SESSION['data_produk'][$kode]['tipe_produk'];
        $array_data_satuan[$kode]['diskon'] = $_SESSION['data_produk'][$kode]['diskon'];
        $array_data_satuan[$kode]['kuantitas'] = $kuantitas;
        $array_data_satuan[$kode]['gbr'] = $_SESSION['data_produk'][$kode]['gbr'];

        if(!empty($_SESSION['order_produk'])){
            if(cekProdukDalamArray($kode , $_SESSION['order_produk']) == TRUE ){
                
                $_SESSION['order_produk'][$kode]['kuantitas'] += $kuantitas;

            }else{
                
                //hati2 saat menggunakan array_merge, kalo key tiap assosiative arraynya int maka
                //tiap kali akses fungsi ini maka arraynya akan direset. coba bukak link
                //https://www.w3schools.com/php/func_array_merge.asp => example 2
                $_SESSION['order_produk'] = array_merge($_SESSION['order_produk'], $array_data_satuan);

            }
        }else{//kalo pertama kali item dipesan maka masu logika ini
            $_SESSION['order_produk'] = $array_data_satuan;

        }
        $_SESSION['total_order'] = kuantitasCounter($_SESSION['order_produk']);                         
    }

    function kuantitasCounter($data){
        $incre = 0;
        foreach($data as $item){
            $incre  = $item['kuantitas'] + $incre;
        }
        return $incre;
    }

    //buat nyari suatu data dalam associative array
    function cekProdukDalamArray($keywords, $dataArray){
        //bisa makek fungsi array php => in_array
        //cari aja gimana fungsinya

        $kunci= $keywords;
        $status = false;
        
        $dataArrayKey = array_keys($dataArray);
        
        foreach($dataArrayKey as $value){
            if($value === $kunci){
                $status = true;
                break;
            }
        }

        return $status;
    }

    //buat pembelian produk lewat page produk_desc
    if(isset($_GET['kode'])){
        if(isset($_POST['quantity_produk_desc'])){
            if(isset($_SESSION['user']) && ((int)$_POST['quantity_produk_desc'] > 0)){
                addProdukOrder($_GET['kode'], $_POST['quantity_produk_desc']);
                header('Location: produk_desc.php?kodeProduk='.$_GET['kode'].'&produk=makanan');
                exit();
            }else{
                header('Location: index.php');         
                exit();       
            }            
        } 
    }

    function totalOrder(){
        if(isset($_SESSION['total_order'])){
            return $_SESSION['total_order'];
        }else{
            return 0;
        }
    }

    //hapus produk yang diorder, penghapusan lewat page member
    if(isset($_GET['delete'])){
        if(isset($_SESSION['order_produk'])){
            $_SESSION['total_order'] -= $_SESSION['order_produk'][$_GET['kodeHapus']]['kuantitas'];
            unset($_SESSION['order_produk'][$_GET['kodeHapus']]); 
            unset($_SESSION['total_harga_semi_final']); 
        }
    }

    //memasukkan data produk yg diorder ke database
    if(isset($_POST['jalan']) && isset($_POST['noHP'])){
        global $db, $id_user, $id_produk, $jumlah_produk, $alamat, $diskon, $total_harga, $metode_bayar, 
            $tanggal_bayar, $no_gawai, $nama_produk, $harga_satuan;

        $id_user    =  e($_SESSION['user']['id']);                
        $alamat     =  e($_POST['jalan']);
        $no_gawai   =  e($_POST['noHP']);        
        $total_harga   =  e($_SESSION['total_harga_semi_final']);
        $metode_bayar  =  e($_POST['payment']);
        $tanggal_bayar =  e(date("Y-m-d"));

        foreach($_SESSION['order_produk'] as $item){
        
            $id_produk  =  e($item['id']);
            $diskon     =  e($item['diskon']);
            $jumlah_produk = e($item['kuantitas']);
            $nama_produk = e($item['nama']);
            $harga_satuan = e($item['harga']);
        
            $dat1 = $id_user;
            $dat2 = $id_produk;
            $dat3 = $jumlah_produk;     
            $dat4 = $alamat; 
            $dat5 = $no_gawai;
            $dat6 = $diskon;
            $dat7 = $total_harga;
            $dat8 = $metode_bayar;
            $dat9 = $tanggal_bayar;
            $dat10 = $nama_produk;
            $dat11 = $harga_satuan;

            $stmt_register = $db->prepare("INSERT INTO history_order (id_user, id_produk, 
                jumlah_produk, alamat, no_handphone, diskon, total_harga, metode_bayar, 
                    tanggal_bayar, nama_produk, harga_satuan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_register->bind_param("sssssssssss", $dat1, $dat2, $dat3, $dat4, $dat5, $dat6, $dat7, 
                $dat8, $dat9, $dat10, $dat11 ); 
            
            $stmt_register->execute();
        } 

        $stmt_register->close();
    
        unset($_SESSION["order_produk"]);
        unset($_SESSION['total_order']);      
    }    

    //ngambil data histori pembelian pelanggan sesuai username ke page profil
    function getDataHistori(){

        $id_user = $_SESSION["user"]["id"];

        unset($_SESSION['data_histori']);

        $data_id = getDataBaris("SELECT id FROM history_order WHERE id_user='$id_user' 
            ORDER BY tanggal_bayar DESC");
        
        for($i = 0; $i < count($data_id); $i++){
            $id = $data_id[$i];
            $data_satuan = runQuery("SELECT id, id_produk, jumlah_produk, alamat, no_handphone, 
                diskon, total_harga, metode_bayar, tanggal_bayar, nama_produk, harga_satuan
                FROM history_order WHERE id = '$id' ");
        
            $array_data_satuan = array(
                $data_satuan[0]['id']
                    =>array('id_produk'=>$data_satuan[0]['id_produk'],
                            'jumlah_produk'=>$data_satuan[0]['jumlah_produk'], 
                            'alamat'=>$data_satuan[0]['alamat'],
                            'no_handphone'=>$data_satuan[0]['no_handphone'], 
                            'diskon'=>$data_satuan[0]['diskon'],
                            'total_harga'=>$data_satuan[0]['total_harga'], 
                            'metode_bayar'=>$data_satuan[0]['metode_bayar'],
                            'tanggal_bayar'=>$data_satuan[0]['tanggal_bayar'],
                            'nama_produk'=>$data_satuan[0]['nama_produk'],
                            'harga_satuan'=>$data_satuan[0]['harga_satuan']
                    )
            );

            if(!isset($_SESSION['data_histori'])){
                $_SESSION['data_histori'] = $array_data_satuan;
            }else{
                $_SESSION['data_histori'] = array_merge($_SESSION['data_histori'] 
                    , $array_data_satuan);
            }
        }
    }   
    
    function getDataPelanggan(){

        unset($_SESSION['data_pelanggan_admin']);

        $data_id = getDataBaris("SELECT id FROM data_user");
        
        for($i = 0; $i < count($data_id); $i++){
            $id = $data_id[$i];
            $data_satuan = runQuery("SELECT id, username_log, email_log, password_log, alamat, tipe_user
                FROM data_user WHERE id = '$id' ");
        
            $array_data_satuan = array(
                $data_satuan[0]['id']
                    =>array('id'=>$data_satuan[0]['id'],
                            'username_log'=>$data_satuan[0]['username_log'], 
                            'email_log'=>$data_satuan[0]['email_log'],
                            'password_log'=>$data_satuan[0]['password_log'], 
                            'alamat'=>$data_satuan[0]['alamat'],
                            'tipe_user'=>$data_satuan[0]['tipe_user']
                    )
            );

            if(!isset($_SESSION['data_pelanggan_admin'])){
                $_SESSION['data_pelanggan_admin'] = $array_data_satuan;
            }else{
                $_SESSION['data_pelanggan_admin'] = array_merge($_SESSION['data_pelanggan_admin'] 
                    , $array_data_satuan);
            }
        }
        //var_dump($_SESSION['data_pelanggan_admin']);
    } 

    if(isset($_GET['editBoleh_FORM'])){

        global $db;

        $nama    =  $_POST['nama_edit_FORM'];
        $kode    =  $_GET['kodeEdit_FORM'];
        $harga   =  $_POST['harga_edit_FORM'];
        $diskon   =  $_POST['diskon_edit_FORM'];
        $lain1   =  $_POST['lain1_edit_FORM'];
        $lain2   =  $_POST['lain2_edit_FORM'];
        $lain3   =  $_POST['lain3_edit_FORM'];

        /*
        $dat1 = $nama;
        $dat2 = $kode;

        $stmt_register = $db->prepare("UPDATE data_produk SET nama=? WHERE kode=? ");
        $stmt_register->bind_param("ss", $dat1, $dat2);           

        if($stmt_register->execute()){
            header('Location: daftar_produk.php');
        }

        $stmt_register->close();
    
        exit();
            
        */

        $sql = "UPDATE data_produk SET nama='$nama', harga='$harga', diskon='$diskon',
            lain1='$lain1', lain2='$lain2', lain3='$lain3'  WHERE kode= '$kode' ";

        if ($db->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $db->error;
        }

        getBigDataProduk();
    }

    if(isset($_GET['delete_data_pelanggan'])){
        global $db;

        $id =  $_GET['kodeHapus_data_pelanggan'];

        $sql = "DELETE FROM data_user WHERE id= '$id' ";

        if ($db->query($sql) === TRUE) {
            echo "Record delete successfully";
        } else {
            echo "Error updating record: " . $db->error;
        }

        getDataPelanggan();
    }  

    function emailVerify($kode, $email){
        $mail = new PHPMailer(TRUE);  
        try {       
            $mail->setFrom('fanahamartonline@gmail.com', 'Fanaha Mart');    
            $mail->addAddress($email, 'Emperor');    
            $mail->Subject = 'Jangan Dibalas; Berikut ini kode verifikasi register:';    
            $mail->Body = $kode.' \n Silahkan masukkan kode diatas untuk register';        
            
            /* SMTP parameters. */        
            
            /* Tells PHPMailer to use SMTP. */    
            $mail->isSMTP();        /* SMTP server address. */    
            $mail->Host = 'smtp.gmail.com';     /* Use SMTP authentication. */    
            $mail->SMTPAuth = TRUE;        /* Set the encryption system. */    
            $mail->SMTPSecure = 'tls';        /* SMTP authentication username. */ 
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );   
            $mail->Username = 'fanahamartonline@gmail.com';        /* SMTP authentication password. */    
            //$mail->Password = 'fadhilmoegi';        /* Set the SMTP port. */   
            $mail->Password = 'zijxaefcofvfdwgr';  
            $mail->Port = 587;        /* Finally send the mail. */    
            $mail->send(); 
        } catch (Exception $e) {    
            echo $e->errorMessage(); 
        } catch (\Exception $e) {    
            echo $e->getMessage(); 
        }
    }
  
    $db->close();
?>