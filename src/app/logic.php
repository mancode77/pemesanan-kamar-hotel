<?php
require_once '../config/config.php';

function tambah_data_kamar_hotel($data)
{
    global $db;

    $id_kamar = htmlspecialchars($data["id_kamar"]);
    $nama_kamar = htmlspecialchars($data["nama_kamar"]);
    $biaya_sewa = (int) htmlspecialchars($data["biaya_sewa"]);

    $sql = "INSERT INTO kamar 
            (id_kamar, nama_kamar, biaya_sewa)
			VALUES 
            (:id_kamar, :nama_kamar, :biaya_sewa);";

    // bind parameter ke query
    $params = [
        ":id_kamar" => $id_kamar,
        ":nama_kamar" => $nama_kamar,
        ":biaya_sewa" => $biaya_sewa
    ];

    $stmt = $db->prepare($sql);

    $stmt->execute($params);

    if (!$stmt) {
        return 0;
    }

    return 1;
}

function tambah_data_pelanggan($data)
{
    global $db;

    $id_pelanggan = htmlspecialchars($data["id_pelanggan"]);
    $nama_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
    $jenis_kelamin = strtolower(htmlspecialchars($data["jenis_kelamin"]));
    $usia = htmlspecialchars($data["usia"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $pekerjaan = htmlspecialchars($data["pekerjaan"]);
    $contact_person = (int) htmlspecialchars($data["contact_person"]);

    $sql = "INSERT INTO pelanggan 
            (id_pelanggan, nama_pelanggan, jenis_kelamin, usia, alamat, pekerjaan, contact_person)
			VALUES
			(:id_pelanggan, :nama_pelanggan, :jenis_kelamin, :usia, :alamat, :pekerjaan, :contact_person);";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = [
        ":id_pelanggan" => $id_pelanggan,
        ":nama_pelanggan" => $nama_pelanggan,
        ":jenis_kelamin" => $jenis_kelamin,
        ":usia" => $usia,
        ":alamat" => $alamat,
        ":pekerjaan" => $pekerjaan,
        ":contact_person" => $contact_person
    ];

    $stmt->execute($params);

    if (!$stmt) {
        return 0;
    }

    return 1;
}

function tambah_data_admin($data)
{
    global $db;

    $username = htmlspecialchars($data["username"]);
    $status = htmlspecialchars($data["status"]);

    $sql = "INSERT INTO admin 
            (username, status)
			VALUES
			(:username, :status);";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = [
        ":username" => $username,
        ":status" => $status
    ];

    $stmt->execute($params);

    if (!$stmt) {
        return 0;
    }

    return 1;
}

function tambah_data_sewa_kamar($data)
{
    global $db;
 
    $id_transaksi = htmlspecialchars($data["id_transaksi"]);
    $id_pelanggan = htmlspecialchars($data["id_pelanggan"]);
    $id_kamar = htmlspecialchars($data["id_kamar"]);
    $tanggal_transaksi = htmlspecialchars($data["tanggal_transaksi"]);
    $tanggal_checkout = htmlspecialchars($data["tanggal_checkout"]);
    $total_biaya_sewa = htmlspecialchars($data["total_biaya_sewa"]);

    $sql = "INSERT INTO transaksi 
            (id_transaksi, id_pelanggan, id_kamar, tanggal_transaksi, tanggal_checkout, total_biaya_sewa)
			VALUES
			(:id_transaksi, :id_pelanggan, :id_kamar, :tanggal_transaksi, :tanggal_checkout, :total_biaya_sewa);";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = [
        ":id_transaksi" => $id_transaksi,
        ":id_pelanggan" => $id_pelanggan,
        ":id_kamar" => $id_kamar,
        ":tanggal_transaksi" => $tanggal_transaksi,
        ":tanggal_checkout" => $tanggal_checkout,
        ":total_biaya_sewa" => $total_biaya_sewa
    ];

    $stmt->execute($params);

    if (!$stmt) {
        return 0;
    }

    return 1;
}

function tampilkan_data($data, $db_name, $id_field)
{
    global $db;

    $result_record = (int) htmlspecialchars($data["result_record"]);
    $limit = 10;

    $sql = null;

    if ($result_record <= $limit) {
        $offset = 0;
        $sql = "SELECT * FROM $db_name ORDER BY $id_field ASC LIMIT $offset, $result_record";

    } else {
        if ($result_record > 20) {
            $result_record -= $limit;

            $sql = "SELECT * FROM $db_name ORDER BY $id_field ASC LIMIT $result_record, $limit";
        } else {
            $result_record -= $limit;

            $sql = "SELECT * FROM $db_name ORDER BY $id_field ASC LIMIT $limit, $result_record";
        }
    }

    $stmt = $db->prepare($sql);

    $stmt->execute();

    $results = [];

    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $results[] = $result;
    }

    return $results;
}

function hapus($id, $db_name, $field_name)
{
    global $db;

    $id = htmlspecialchars($id);

    $sql = "DELETE FROM $db_name WHERE $field_name = '$id'";

    $stmt = $db->prepare($sql);

    if (!$stmt->execute()) {
        return 0;
    }

    return 1;
}

function ubah($data, $db_name, $field_name,  $id_field)
{
    global $db;

    $sql = "SELECT * FROM $db_name LIMIT 0, 1";

    $stmt = $db->prepare($sql);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    foreach ($result as $key => $value) {
        $sql = "UPDATE $db_name SET 
            $key = '$data[$key]' 
            WHERE $field_name = '$id_field'";

        $stmt = $db->prepare($sql);

        if (!$stmt->execute()) {
            return 0;
        }
    }

    return 1;
}
