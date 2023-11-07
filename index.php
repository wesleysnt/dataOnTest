<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataOn Test</title>
    <style>
        th{ padding: 8px;}
        td{ padding: 8px;}
    </style>
</head>

<body>
    <?php
    function conncectDB()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "dataontest";

        $con = new mysqli($servername, $username, $password, $database);

        return $con;
    }

    $con  = conncectDB();
    $produk = $con->query("SELECT jenis_kain.id idJenis, jenis_kain.nama jenis, kain.id idKain, kain.nama nama, produk.harga, kualitas.id, kualitas.nama kualitas FROM jenis_kain, kain, produk, kualitas WHERE jenis_kain.id = kain.id_jenis_kain AND produk.id_kain = kain.id AND kualitas.id = produk.id_kualitas ORDER BY jenis_kain.nama, kain.nama, kualitas.id;");
    $kain = $con->query("SELECT kain.id, kain.nama, jenis_kain.nama jenis from kain, jenis_kain WHERE kain.id_jenis_kain = jenis_kain.id");
    $kualitas = $con->query("SELECT * from kualitas");
    ?>

    <form action="tambahProduk.php" method="post">
        <h3>Tambah Data Produk</h3>

        <label for="kain">Kain: </label>
        <select name="kain" id="kain">
            <?php
            foreach ($kain as $row){
                echo "<option value=".$row['id'].">".$row['nama']."</option>";
            }
            ?>
        </select>
        <label for="kain">Kualitas: </label>
        <select name="kualitas" id="kualitas">
            <?php
            foreach ($kualitas as $row){
                echo "<option value=".$row['id'].">".$row['nama']."</option>";
            }
            ?>
        </select>
        <label for="harga">Harga: </label>
        <input type="text" name="harga" id="harga">
        <input type="submit" value="Submit" name="submit">
    </form>
    <a href="tambahKainPage.php">Tambah Kain</a>

    <br>

    <table>
        <tr>
            <th>Jenis Kain</th>
            <th>Nama Kain</th>
            <th>Kualitas</th>
            <th>Nama Kualitas</th>
            <th>Harga</th>
        </tr>

        <?php
        
$previousRow = null;

foreach ($produk as $row) {
    if ($previousRow === null) {
        $previousRow = $row;
    } elseif ($previousRow["idJenis"] === $row["idJenis"] && $previousRow["idKain"] === $row["idKain"]) {
        // Combine the cells as needed.
        $row["jenis"] = ''; // Set to an empty string to "colspan."
        $row["nama"] = ''; // Set to an empty string to "colspan."
         // Set to an empty string to "colspan."
        $previousRow = $row;
    } else {
        $previousRow = $row;
    }
    
    // Output the row to your display.
    echo '<tr><td>' . $row["jenis"] . '</td><td>' . $row["nama"] . '</td><td>' . $row["id"] . '</td><td>' . $row["kualitas"] . '</td><td>' . $row["harga"] . '</td></tr>';
} ?>
    </table>
</body>

</html>