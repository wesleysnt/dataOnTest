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
$result = $con->query("insert into kain (id_jenis_kain, nama) values('".$_POST['jenis']."','".$_POST['nama']."')") ;

//kondisi ketika database sudah dimasukkan
if ($result) {
    header("location: tambahKainPage.php");

} else {
    echo mysqli_error($con);
}
