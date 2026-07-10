<?php 
include_once("config.php"); 

// Tambahan: Validasi apakah koneksi database ($mysqli) berhasil
if (!$mysqli) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mengambil data dari tabel 'alat'
$result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC"); 

// Tambahan: Jika query error, tampilkan error-nya apa
if (!$result) {
    die("Query Error: " . mysqli_error($mysqli));
}
?> 
 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8">
    <title>Sim Rs - Data Alat</title> 
    <style> 
        .header { background-color: orange; color: white; } 
        table { width: 80%; border-collapse: collapse; margin-top: 10px; } 
        th, td { border: 1px solid black; padding: 8px; text-align: left; } 
    </style> 
</head> 
<body> 

    <a href="add.php" style="padding: 5px 10px; background-color: green; color: white; text-decoration: none; border-radius: 3px;">+ Tambah Alat</a>
    <br><br>

    <table> 
        <tr class="header"> 
            <th>Nama Alat</th>
            <th>Tahun</th>
            <th>Merek</th>
            <th>Lokasi</th>
            <th>Aksi</th> 
        </tr> 
        <?php 
        // Cek apakah ada baris data yang ditemukan
        if (mysqli_num_rows($result) > 0) {
            while($user_data = mysqli_fetch_array($result)) { 
                echo "<tr>"; 
                // CATATAN: Pastikan tulisan 'nama_alat', 'tahun', dll. sama persis dengan kolom di phpMyAdmin
                echo "<td>".$user_data['nama_alat']."</td>"; 
                echo "<td>".$user_data['tahun']."</td>"; 
                echo "<td>".$user_data['merek']."</td>"; 
                echo "<td>".$user_data['lokasi']."</td>"; 
                echo "<td>
                        <a href='edit.php?id=".$user_data['id']."'>Edit</a> | 
                        <a href='delete.php?id=".$user_data['id']."' onclick='return confirm(\"Yakin hapus?\")'>Delete</a>
                      </td>";
                echo "</tr>"; 
            } 
        } else {
            // Jika tabel di database masih kosong, tampilkan pesan ini
            echo "<tr><td colspan='5' style='text-align:center; color: red;'>Data kosong! Silakan klik tombol 'Tambah Alat' di atas untuk mengisi data.</td></tr>";
        }
        ?> 
    </table> 
</body> 
</html>