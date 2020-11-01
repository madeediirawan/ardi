<?php
$con->auth();
$conn=$con->koneksi();
switch (@$_GET['page']){
    case 'add':
        $produk="select * from produk";
        $produk=$conn->query($produk);
        $sql="select * from produk";
        $produk=$conn->query($sql);
        $content="views/produk/tambah.php";
        include_once 'views/template.php';
    break;
    case 'save':
        if($_SERVER['REQUEST_METHOD']=="POST"){
            //validasi
            if(empty($_POST['nama'])){
                $err['nama']="Nama produk Wajib";
            }
            if(empty($_POST['jenis'])){
                $err['jenis']="Jenis Produk Wajib Terisi";
            }
            if(!is_numeric($_POST['harga'])){
                $err['harga']="Harga Wajib diisi";
            }
            //validasi file
			if(!empty($_FILES['photos']['name'])){
            $target_dir = "../media/";
            $photos=basename($_FILES["photos"]["name"]);
            $target_file = $target_dir . $photos;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["photos"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["photos"]["size"] > 500000000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($_FILES["photos"]["tmp_name"], $target_file)) {
                //echo "The file ". htmlspecialchars( basename( $_FILES["photos"]["name"])). " has been uploaded.";
                $_POST['photos']=$photos;
                if(isset($_POST['photos_old']) && $_POST['photos_old']!=''){
                    unlink($target_dir.$_POST['photos_old']);
                }else{
                    echo "Succses";
                }
            } else {
                //echo "Sorry, there was an error uploading your file.";
                $err["photos"]="Sorry";
            }
            }
            }
            if(!isset($err)){
                $id_pegawai=$_SESSION['login']['id'];
                if(!empty($_POST['id_produk'])){
                    //update
                    if(isset($_POST['photos'])){
                    $sql="UPDATE produk SET nama='$_POST[nama]', jenis='$_POST[jenis]', harga='$_POST[harga]' photos='$_POST[photos]' WHERE id_produk='$_POST[id_produk]'";

                    }else{ 
                    $sql="UPDATE produk SET nama='$_POST[nama]', jenis='$_POST[jenis]', harga='$_POST[harga]' WHERE id_produk='$_POST[id_produk]'";
                    }
                }else{
                    //save
                    if(isset($_POST['photos'])){
                    $sql = "INSERT INTO produk (nama, jenis, harga,photos) 
                    VALUES ('$_POST[nama]','$_POST[jenis]','$_POST[harga]','$_POST[photos]')";
                    }else{
                    $sql = "INSERT INTO produk (nama, jenis, harga) 
                    VALUES ('$_POST[nama]','$_POST[jenis]','$_POST[harga]')";  
                    }
                }
                    if ($conn->query($sql) === TRUE) {
                        header('Location: '.$con->site_url().'/admin/index.php?mod=produk');
                    } else {
                        $err['msg']= "Error: " . $sql . "<br>" . $conn->error;
                    }
            }
        }else{
            $err['msg']="tidak diijinkan";
        }
        if(isset($err)){
            $content="views/produk/tambah.php";
            include_once 'views/template.php';
        }
    break;
    case 'edit':
        $produk="select * from produk where id_produk='$_GET[id]'";
        $produk=$conn->query($produk);
        $_POST=$produk->fetch_assoc();
        $_POST['id_produk']=$_POST['id_produk'];
        //var_dump($dokter);
        $produk
        ="select*from produk";
        $produk=$conn->query($produk);
        $content="views/produk/tambah.php";
        include_once 'views/template.php';
    break;
    case 'delete';
        $produk="DELETE FROM produk WHERE id_produk='$_GET[id]'";
        $produk=$conn->query($produk);
        header('Location: '.$con->site_url().'/admin/index.php?mod=produk');
    break;
    default:
        $sql="select*from produk";
        $produk=$conn->query($sql);
        $conn->close();
        $content="views/produk/tampil.php";
        include_once 'views/template.php';
}
?>