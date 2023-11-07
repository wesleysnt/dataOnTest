<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataOn Test</title>
    <style>
        th {
            padding: 8px;
        }

        td {
            padding: 8px;
        }
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
    $kain = $con->query("SELECT kain.id, kain.nama, jenis_kain.nama jenis, jenis_kain.id idJenis from kain, jenis_kain WHERE kain.id_jenis_kain = jenis_kain.id ORDER BY jenis_kain.nama");
    $jenis = $con->query("SELECT * FROM jenis_kain");
    ?>

    <form action="tambahKain.php" method="post">
        <h3>Tambah Data Produk</h3>
        <select name="jenis" id="jenis">
            <?php
            foreach ($jenis as $row) {
                echo "<option value=" . $row['id'] . ">" . $row['nama'] . "</option>";
            }
            ?>
        </select>
        <label for="nama">Nama Kain: </label>
        <input type="text" name="nama" id="nama">
        <input type="submit" value="Submit" name="submit">


    </form>
    <a href="index.php">kembali</a>

    <br>

    <table>
        <tr>
            <th>Jenis Kain</th>
            <th>Nama Kain</th>
        </tr>

        <?php

        $previousRow = null;

        foreach ($kain as $row) {
            if ($previousRow === null) {
                $previousRow = $row;
            } elseif ($previousRow["idJenis"] === $row["idJenis"]) {
                // Combine the cells as needed.
                $row["jenis"] = ''; // Set to an empty string to "colspan."
                // Set to an empty string to "colspan."
                $previousRow = $row;
            } else {
                $previousRow = $row;
            }

            // Output the row to your display.
            echo '<tr><td>' . $row["jenis"] . '</td><td>' . $row["nama"];
        } ?>
    </table>
</body>

</html>