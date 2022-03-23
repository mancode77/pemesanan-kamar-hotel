<?php
usleep(500000);

require_once '../config/config.php';

function search($db_name)
{
    global $db;

    $sql = "SELECT * FROM $db_name LIMIT 0, 1";

    $stmt = $db->prepare($sql);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $keyword = $_GET['keyword'];

    $rows = [];

    foreach ($result as $key => $value) {
        $sql1 = "SELECT * FROM $db_name WHERE $key LIKE '%$keyword%';";
        $stmt1 = $db->prepare($sql1);

        $stmt1->execute();
        $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

        if ($result1 > 0) {
            $rows[] = $result1;
        }
    }

    return $rows;
}

if (isset($_GET['keyword'])) {
    $record = search($_GET['param']);
}
?>

<table class="table table-striped  mt-2">
    <thead>
        <tr>
            <?php foreach ($record as $row) : ?>
                <th scope="col">no</th>
                <?php foreach ($row as $key => $value) : ?>
                    <th scope="col"><?= str_replace("_", " ", $key); ?></th>
                <?php endforeach; ?>
                <th scope="col">edit</th>
                <th scope="col">hapus</th>
                <?php break; ?>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($record as $row) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <?php foreach ($row as $key => $value) : ?>
                    <td><?= $value ?></td>
                <?php endforeach; ?>
                <td>
                    <button type="button" class="btn btn-warning">
                        <svg style="width: 16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z" />
                        </svg>
                        <a href="ubah.php?id=<?= $row["id_pelanggan"]; ?>" style="text-decoration: none; color: black;">edit</a>
                    </button>
                </td>
                <td>
                    <button type=" button" class="btn btn-danger">
                        <svg style="width: 16px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z" />
                        </svg>
                        <a href="hapus.php?id=<?= $row["id_kamar"]; ?>" style="text-decoration: none; color: white;">hapus</a>
                    </button>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>