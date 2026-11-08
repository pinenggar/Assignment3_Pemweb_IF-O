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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data mahaiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2>Data mahasiswa</h2>
    <a href="tambah.php">Tambah data</a>
    <br><br>

    <form action="" method="GET">
        <input type="text" name="keyword" placeholder="Cari Nama Mahasigma">
        <button type="submit">Cari</button>
        <a href="index.php">Reset</a>
    </form>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jenis kelamin</th>
            <th>Created at</th>
            <th>Aksi</th>
        </tr>

        <?php
            if(mysqli_num_rows($query) > 0 ){
            while($data = mysqli_fetch_assoc($query)){
        ?>

        <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['nim']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['jenis_kelamin']; ?></td>
            <td><?php echo $data['created_at']; ?></td>
            <td>
                <a href="update.php?id=<?php echo $data['id']; ?>">
                    Edit
                </a>
                <button type="button" class="btn btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#modalHapus<?php echo $data['id']; ?>">
                    Hapus
                </button>
            </td>
        </tr>

        <?php    
            } 
            } else {
                echo "<tr><td colspan='6'>Tidak ada data!</td></tr>";
            }
        ?>

    </table>

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
                            Data :
                            <b><?php echo $data['nama']; ?></b> mau dihapus? yakin dek??
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