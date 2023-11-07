<?php
//fungsi konek database
function connectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "dataontest";

    $con = new mysqli($servername, $username, $password, $database);
    return $con;
}

//koneski database
$con = connectDB();

//menambahkan database
$result = $con->query("insert into produk (harga, id_kain, id_kualitas) values('".$_POST['harga']."','".$_POST['kain']."','".$_POST['kualitas']."')") ;

//kondisi ketika database sudah dimasukkan
if ($result) {
    header("location: index.php");

} else {
    echo mysqli_error($con);
}
