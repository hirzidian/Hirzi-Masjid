<?php

$conn = mysqli_connect("localhost", "root", "", "db");

if(isset($_POST["click"])) {
    $nama_donatur = $_POST["nama_donatur"];
    $id_donatur = $_POST["id_donatur"];
    // $paket = $_POST["paket"];
    $jenis_barang = $_POST["jenis_barang"];
    $jumlah_barang = $_POST["jumlah_barang"];

    // Lakukan proses penyimpanan data ke database atau ke tempat lainnya
    // Misalnya dengan menggunakan fungsi tambahData()

    if(tambahData($_POST) > 0) {
        echo "
        <script>
            alert('Data berhasil disimpan');
            window.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal disimpan');
            window.location.href = 'index.php';
        </script>
        ";
    }
}


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $kotaks = [];
    while ($kotak = mysqli_fetch_assoc($result)) {
        $kotaks[] = $kotak;
    }
    return $kotaks;
    // mengambil data dari database menjadi array asosiatif
}

function tambahData($data)
{
    global $conn;
    $nama_donatur = htmlspecialchars($data["nama_donatur"]);
    $id_donatur = htmlspecialchars($data["id_donatur"]);
    // $paket = htmlspecialchars($data["paket"]);
    $jenis_barang = htmlspecialchars($data["jenis_barang"]);
    $jumlah_barang = htmlspecialchars($data["jumlah_barang"]);

    $query = "INSERT INTO `masjid` (nama_donatur, id_donatur, jenis_barang, jumlah_barang)
    VALUES ('$nama_donatur', '$id_donatur', '$jenis_barang', '$jumlah_barang')";

    mysqli_query($conn, $query);

    // apakah ada perubahan dalam database
    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM masjid WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubahdata($data)
{
    global $conn;
    $id = $data["id"];
    $nama_barang = htmlspecialchars($data["nama_donatur"]);
    $id_donatur = htmlspecialchars($data["id_donatur"]);
    $paket = htmlspecialchars($data["paket"]);
    $jenis_barang = htmlspecialchars($data["jenis_barang"]);
    $jumlah_barang = htmlspecialchars($data["jumlah_barang"]);

    $query = "UPDATE students SET
             nama_donatur = '$nama_donatur',
             id_donatur = '$id_donatur',
             paket = '$paket',
             jenis_barang = '$jenis_barang',
             jumlah_barang = '$jumlah_barang'
             WHERE id = $id
             ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

class Prosses
{
    protected $host = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $database = "db";
    public $targetDana = 40000000;
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal: " . mysqli_connect_error();
        }
    }

    public function target()
    {
        return $this->targetDana;
    }

    public function totalNominal()
    {
        $sql = $this->conn->prepare("SELECT SUM(jumlah_barang) AS jumlah FROM masjid");
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    

    public function totalDonatur()
    {
        $stmt = $this->conn->prepare("SELECT * FROM masjid");
        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->num_rows;
        return $total;
    }

    public function persentase()
    {
        $tnom = $this->totalNominal();
        $persen = ($tnom['jumlah'] / $this->targetDana) * 100;
        return $persen;
    }
}

?>


