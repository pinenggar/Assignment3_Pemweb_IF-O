<?php
    include "config/koneksi.php";

    $id = $_GET['id'];

    $stmt_select = mysqli_prepare($connect, "select * from mahasiswa where id = ?");

    mysqli_stmt_bind_param($stmt_select, "i", $id);

    mysqli_stmt_execute($stmt_select);

    $query = mysqli_stmt_get_result($stmt_select);

    $data = mysqli_fetch_assoc($query);

    if(isset($_POST['update'])){
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];

        $stmt = mysqli_prepare($connect, "update mahasiswa set
            nim = ?, 
            nama = ?, 
            jenis_kelamin = ?
            where id = ?
        ");

        mysqli_stmt_bind_param($stmt, "sssi", $nim, $nama, $jenis_kelamin, $id);

        $query_update = mysqli_stmt_execute($stmt);

        if($query_update){
            header("Location: index.php");
            exit();
        } else {
            echo "gagal mengupdate data!";
        }
    }

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="site-navbar">
        <div class="navbar-inner">
            <a class="brand" href="index.php">
                <img src="assets/speda-logo.png" alt="">
                <span>Speda</span>
            </a>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a class="active" href="tambah.php">Tambah Mahasiswa</a>
            </div>
        </div>
    </nav>

    <main class="content-container">
        <h1>Update Mahasiswa</h1>
        <form action="" method="POST" class="student-form">
            <div class="field">
                <label for="nim">NIM:</label>
                <input class="form-control" id="nim" type="text" name="nim" value="<?php echo htmlspecialchars($data['nim']); ?>" required>
            </div>
            <div class="field">
                <label for="nama">Nama:</label>
                <input class="form-control" id="nama" type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
            </div>
            <fieldset class="gender-field">
                <legend>Jenis Kelamin</legend>
                <label class="radio-option">
                    <input type="radio" name="jenis_kelamin" value="laki laki" required <?php if($data['jenis_kelamin'] == 'laki laki') echo 'checked'; ?>>
                    <span>Laki-laki</span>
                </label>
                <label class="radio-option">
                    <input type="radio" name="jenis_kelamin" value="perempuan" <?php if($data['jenis_kelamin'] == 'perempuan') echo 'checked'; ?>>
                    <span>Perempuan</span>
                </label>
            </fieldset>
            <button class="button button-primary" type="submit" name="update">Update Mahasiswa</button>
        </form>
    </main>
</body>
</html>