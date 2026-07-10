<?php 
include_once("config.php"); 

// 1. Logika Fitur Pencarian
$keyword = "";
if (isset($_GET['cari'])) {
    $keyword = mysqli_real_escape_string($mysqli, $_GET['cari']);
    // Mencari data yang cocok di kolom nama_alat, merek, atau lokasi
    $query = "SELECT * FROM alat WHERE 
              nama_alat LIKE '%$keyword%' OR 
              merek LIKE '%$keyword%' OR 
              lokasi LIKE '%$keyword%' 
              ORDER BY id DESC";
} else {
    // Jika tidak ada pencarian, tampilkan semua data
    $query = "SELECT * FROM alat ORDER BY id DESC";
}

$result = mysqli_query($mysqli, $query); 
?> 
 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8">
    <title>Sim Rs - Data Alat</title> 
    <style> 
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            margin: 0;
            padding: 30px;
            min-height: 100vh;
        } 

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            margin: 0 auto;
        }

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

        .admin-character {
            display: flex;
            align-items: center;
            background-color: #e8f5e9;
            padding: 8px 15px;
            border-radius: 50px;
            border: 1px solid #81c784;
        }

        .avatar { margin-right: 10px; font-size: 20px; }
        .admin-info { font-size: 14px; color: #1b5e20; font-weight: bold; }

        /* Pembungkus Tombol & Form Cari agar Sejajar */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn-tambah {
            display: inline-block;
            background-color: #2e7d32;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-tambah:hover {
            background-color: #1b5e20;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
        }

        /* Desain Form Pencarian Tema Hijau */
        .search-form {
            display: flex;
            gap: 5px;
        }
        .search-input {
            padding: 10px 15px;
            border: 2px solid #a5d6a7;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            width: 250px;
            transition: 0.3s;
        }
        .search-input:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 5px rgba(46, 125, 50, 0.3);
        }
        .btn-cari {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-cari:hover { background-color: #2e7d32; }
        .btn-reset {
            background-color: #f44336;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .btn-reset:hover { background-color: #b71c1c; }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        } 
        
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

        tr:nth-child(even) { background-color: #f9fdf9; }
        tr:hover { background-color: #f1fbf1; }

        .action-links a { text-decoration: none; font-weight: bold; padding: 4px 8px; border-radius: 4px; }
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

        <div class="action-bar">
            <a href="add.php" class="btn-tambah">+ Tambah Alat Baru</a> 
            
            <form action="index.php" method="GET" class="search-form">
                <input type="text" name="cari" class="search-input" placeholder="Cari nama alat, merek, lokasi..." value="<?php echo htmlspecialchars($keyword); ?>">
                <button type="submit" class="btn-cari">Cari</button>
                <?php if ($keyword != ""): ?>
                    <a href="index.php" class="btn-reset">Reset</a>
                <?php endif; ?>
            </form>
        </div>

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
                if (mysqli_num_rows($result) > 0) {
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
                } else {
                    echo "<tr><td colspan='5' style='text-align:center; color: #777; padding: 20px;'>Data tidak ditemukan atau masih kosong.</td></tr>";
                }
                ?> 
            </tbody>
        </table> 

        <div style="text-align: center; margin-top: 25px; font-weight: bold; color: #333; font-size: 14px;">
            UAS PEMROGRAMAN WEB : HIKMAWAN_2202505088
        </div>
    </div>

</body> 
</html>