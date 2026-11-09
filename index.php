<?php
    include "config/koneksi.php";

    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];

        $stmt = mysqli_prepare($connect, "select * from mahasiswa where nama like ?");

        $search = "%$keyword%";

        mysqli_stmt_bind_param($stmt, "s", $search);

        mysqli_stmt_execute($stmt);

        $query = mysqli_stmt_get_result($stmt);

    } else {
        $query = mysqli_query($connect, "select * from mahasiswa");
    }

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <a class="active" href="index.php">Home</a>
                <a href="tambah.php">Tambah Mahasiswa</a>
            </div>
        </div>
    </nav>

    <main class="content-container">
        <h1>Daftar Mahasiswa</h1>
        <form class="search-form" action="" method="GET">
            <input class="search-input" type="text" name="keyword" placeholder="Cari mahasiswa" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
            <button class="button button-search" type="submit">Cari</button>
        </form>

        <div class="table-wrap">
            <table class="student-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

        <?php
            if(mysqli_num_rows($query) > 0 ){
            while($data = mysqli_fetch_assoc($query)){
        ?>

        <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['nim']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['jenis_kelamin']; ?></td>
            <td>
                <div class="actions">
                    <a class="button button-primary" href="update.php?id=<?php echo $data['id']; ?>">Update</a>
                    <button type="button" class="button button-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#modalHapus<?php echo $data['id']; ?>">
                        Delete
                    </button>
                </div>
            </td>
        </tr>

        <?php    
            } 
            } else {
                echo "<tr><td class='empty-state' colspan='5'>Tidak Ada Data !</td></tr>";
            }
        ?>

                </tbody>
            </table>
        </div>
    </main>

    <?php
        mysqli_data_seek($query, 0);

        while ($data = mysqli_fetch_assoc($query)) {  
    ?>

    <div class="modal fade" id="modalHapus<?php echo $data['id']; ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            Data mahasigma <b><?php echo $data['nama']; ?></b> akan dihapus, YAKIN DECK ?
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>

                            <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">
                                Yakin kack
                            </a>
                        </div>

                    </div>
                </div>

            </div>
    <?php
        }
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>