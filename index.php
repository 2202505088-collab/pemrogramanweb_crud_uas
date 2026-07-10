<?php 
include_once("config.php"); 
$result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC"); 
?> 
 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8">
    <title>Sim Rs - Data Alat</title> 
    <style> 
        /* Gaya Latar Belakang (Background Tema Hijau Lembut) */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            margin: 0;
            padding: 30px;
            min-height: 100vh;
        } 

        /* Kontainer Utama */
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            margin: 0 auto;
            position: relative;
        }

        /* Atas: Header & Karakter Admin */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #a5d6a7;
            padding-bottom: 15px;
        }

        .title-section h2 {
            margin: 0;
            color: #2e7d32;
        }

        /* Karakter/Avatar di Pojok Kanan Atas */
        .admin-character {
            display: flex;
            align-items: center;
            background-color: #e8f5e9;
            padding: 8px 15px;
            border-radius: 50px;
            border: 1px solid #81c784;
        }

        .avatar {
            font-size: 24px;
            margin-right: 10px;
        }

        .admin-info {
            font-size: 14px;
            color: #1b5e20;
            font-weight: bold;
        }

        /* Tombol Tambah Data */
        .btn-tambah {
            display: inline-block;
            background-color: #2e7d32;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s;
            margin-bottom: 20px;
        }
        .btn-tambah:hover {
            background-color: #1b5e20;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
        }

        /* Desain Tabel Hijau */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        } 
        
        /* Header Tabel Warna Hijau */
        th { 
            background-color: #4caf50; 
            color: white; 
            padding: 14px;
            text-align: left;
            font-size: 16px;
        } 
        
        td { 
            border-bottom: 1px solid #e0e0e0; 
            padding: 12px 14px; 
            color: #333;
            font-size: 15px;
        } 

        /* Efek Baris Belang-Belang Hijau Muda */
        tr:nth-child(even) {
            background-color: #f9fdf9;
        }
        tr:hover {
            background-color: #f1fbf1;
        }

        /* Desain Tombol Aksi */
        .action-links a {
            text-decoration: none;
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .btn-edit { color: #1976d2; }
        .btn-edit:hover { background-color: #e3f2fd; }
        .btn-delete { color: #d32f2f; }
        .btn-delete:hover { background-color: #ffebee; }
    </style> 
</head> 
<body> 

    <div class="container">
        <div class="top-bar">
            <div class="title-section">
                <h2>Sim Rs - Manajemen Data Alat</h2>
            </div>
            <div class="admin-character">
                <span class="avatar">👤</span>
                <div class="admin-info">Admin Specialist</div>
            </div>
        </div>

        <a href="add.php" class="btn-tambah">+ Tambah Alat Baru</a> 

        <table> 
            <thead>
                <tr> 
                    <th>Nama Alat</th>
                    <th>Tahun</th>
                    <th>Merek</th>
                    <th>Lokasi</th>
                    <th>Aksi</th> 
                </tr> 
            </thead>
            <tbody>
                <?php 
                while($user_data = mysqli_fetch_array($result)) { 
                    echo "<tr>"; 
                    echo "<td>".$user_data['nama_alat']."</td>"; 
                    echo "<td>".$user_data['tahun']."</td>"; 
                    echo "<td>".$user_data['merek']."</td>"; 
                    echo "<td>".$user_data['lokasi']."</td>"; 
                    echo "<td class='action-links'>
                            <a href='edit.php?id=$user_data[id]' class='btn-edit'>Edit</a> | 
                            <a href='delete.php?id=$user_data[id]' class='btn-delete' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Delete</a>
                          </td>";
                    echo "</tr>"; 
                } 
                ?> 
            </tbody>
        </table> 
    <div style="text-align: center; margin-top: 25px; font-weight: bold; color: #333; font-size: 14px;">
            UAS PEMROGRAMAN WEB : HIKMAWAN_2202505088
        </div>

    </div> </body> 
</html>