<?php
session_start();

require_once 'logic.php';

if (!isset($_SESSION['key'])) {
    header("Location: login.php");
    exit;
}

require_once '../templates/header.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // cek apakah data berhasil di tambahkan atau tidak
    if (tambah_data_pelanggan($_POST) > 0) {
        echo "
			<script>
				alert('data berhasil ditambahkan!');
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal ditambahkan!');
			</script>
		";
    }
}

if (isset($_POST['show_entries'])) {
    // cek apakah data berhasil di tambahkan atau tidak
    if (tampilkan_data($_POST, 'admin', 'id_admin') > 0) {
        echo "
			<script>
				alert('data berhasil ditambahkan!');
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal ditambahkan!');
			</script>
		";
    }
}

require_once '../templates/header.php';
?>

<div class="container mt-3">
    <form action="" method="post">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            tambah data
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">tambah data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="username" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="status" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="status" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="submit" class="btn btn-primary">tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container mt-3 border-top border-primary border-3">
    <div class="container d-flex justify-content-between mt-3" style="display: flex; align-items: center; height: 40px;">
        <form action="" method="post" class="d-flex">
            <input type="number" name="result_record" class="form-control w-50" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="10" min="1" max="10">
            <button type="button" name="show_entries" class="btn btn-primary ms-3 w-75">show entries</button>
        </form>
        <form class="d-flex w-">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        </form>
    </div>

    <table class="table table-striped  mt-2">
        <thead>
            <tr>
                <th scope="col">no</th>
                <th scope="col">username</th>
                <th scope="col">status</th>
                <th scope="col">edit</th>
                <th scope="col">delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td>
                        <?= $row["username"]; ?>
                    </td>
                    <td>
                        <?= $row["status"]; ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning">
                            <svg style="width: 16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <!--! Font Awesome Pro 6.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z" />
                            </svg>
                            <a href="ubah.php?id=<?= $row["id_admin"]; ?>" style="text-decoration: none;">edit</a>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger">
                            <svg style="width: 16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <!--! Font Awesome Pro 6.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z" />
                            </svg>
                            <a href="hapus.php?id=<?= $row["id_admin"]; ?>" style="text-decoration: none;">hapus</a>
                        </button>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</div>

<?php require_once '../templates/footer.php'; ?>