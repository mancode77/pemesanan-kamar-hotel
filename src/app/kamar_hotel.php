<?php
session_start();

if (!isset($_SESSION['key'])) {
    header("Location: login.php");
    exit;
}

require_once 'logic/logic.php';

$command = null;

switch ($_COOKIE['r']) {
    case 'admin':
        require_once '../templates/header-admin/header.php';
        $command = 'tambah data';
        break;

    case 'guest':
        require_once '../templates/header-guest/header.php';
        $command = 'pesan';
        break;
}

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // cek apakah data berhasil di tambahkan atau tidak
    if (tambah_data_kamar_hotel($_POST) > 0) {
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

$result = null;

if (isset($_POST['show_entries'])) {
    // cek apakah data berhasil di tambahkan atau tidak
    $result = tampilkan_data($_POST, "kamar", "id_kamar");
}
?>

<div class="container mt-3 d-flex justify-content-between">
    <h2><?= $_GET['param']; ?></h2>
    <p><svg style="
    width: 16px; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
            <!--! Font Awesome Pro 6.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z" />
        </svg>beranda > <?= $_GET['param']; ?></p>
</div>

<div class="container mt-3">
    <form action="" method="post">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <?= $command; ?>
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
                            <input type="text" name="id_kamar" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="id kamar" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="nama_kamar" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="nama kamar" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" name="biaya_sewa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="biaya sewa" required min="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary">tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container mt-3 border-top border-primary border-3">
    <div class="container d-flex justify-content-between mt-3" style="display: flex; align-items: center; height: 40px;">
        <form action="" method="post" class="d-flex">
            <input type="number" name="result_record" class="form-control w-25" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="10" min="1">
            <button type="submit" name="show_entries" class="btn btn-primary ms-3 w-50">show entries</button>
        </form>
        <form class="d-flex w-25">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="keyword">
            <input style="position: absolute; right: -1000px; display: none;" type="text" id="hidden_input" value="<?= "kamar"; ?>">
        </form>
    </div>

    <div id="parent_box">
        <table class="table table-striped  mt-2">
            <thead>
                <tr>
                    <th scope="col">no</th>
                    <th scope="col">id kamar</th>
                    <th scope="col">kamar</th>
                    <th scope="col">biaya sewa</th>
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
                            <?= $row["id_kamar"]; ?>
                        </td>
                        <td>
                            <?= $row["nama_kamar"]; ?>
                        </td>
                        <td>
                            <?= $row["biaya_sewa"]; ?>
                        </td>

                        <td>
                            <button type="button" class="btn btn-warning">
                                <svg style="width: 16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <!--! Font Awesome Pro 6.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z" />
                                </svg>
                                <a href="ubah.php?id=<?= $row["id_kamar"]; ?>&param1=kamar&param2=id_kamar" style="text-decoration: none; color: black;">edit</a>
                            </button>
                        </td>
                        <td>
                            <button type=" button" class="btn btn-danger">
                                <svg style="width: 16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <!--! Font Awesome Pro 6.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z" />
                                </svg>
                                <a href="hapus.php?id=<?= $row["id_kamar"]; ?>&param1=kamar&param2=id_kamar" style="text-decoration: none; color: white;">hapus</a>
                            </button>
                        </td>

                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

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