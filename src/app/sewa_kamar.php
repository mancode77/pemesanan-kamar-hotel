<?php require_once '../templates/header.php'; ?>

<div class="container mt-3 d-flex justify-content-between">
    <h2>selamat datang</h2>
    <p><svg style="
    width: 16px; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
            <!--! Font Awesome Pro 6.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z" />
        </svg>beranda > <?= $_GET['param']; ?></p>
</div>

<div class="container mt-3">
    <form action="" method="post">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            tambah data
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">tambah data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="store.php" method="store.php">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="text" name="tanggal_check_in" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="tanggal check in" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="pelanggan" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="pelanggan" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="nama_kamar" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="nama kamar" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="tanggal_check_out" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="tanggal check in" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="total_biaya_sewa" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="total biaya sewa" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" name="submit" class="btn btn-primary">tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container mt-3 border-top border-primary border-3">
    <div class="container d-flex justify-content-between mt-3 height-entries">
        <form action="" class="d-flex">
            <p>show</p>
            <input type="number" class="form-control w-25" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="10">
            <p>entries</p>
        </form>
        <form class="d-flex w-">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        </form>
    </div>

    <table class="table table-striped  mt-2">
        <thead>
            <tr>
                <th scope="col">no</th>
                <th scope="col">tanggal check in</th>
                <th scope="col">pelanggan</th>
                <th scope="col">nama kamar</th>
                <th scope="col">tanggal check out</th>
                <th scope="col">total biaya sewa</th>
                <th scope="col">edit</th>
                <th scope="col">delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@mdo</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
                <td>@mdo</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
            </tr>
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