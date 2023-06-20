<?php 
    require 'function.php';
    $students = query("SELECT * FROM masjid");

    if(isset($_POST["search"]) ) {
        $students = search($_POST["keyword"]);
    }


    if (isset($_POST["click"])) {
       
      if (tambahData($_POST) > 0 ) {
          echo "
          <script>
              alert('data berhasil di simpan');
              window.location.href = 'index.php';
          </script>
          ";
      } else {
          echo "
          <script>
              alert('data gagal di simpan');
              window.location.href = 'index.php'; 
          </script>
          ";
      }
  }

  $donatur = new Prosses();
  $tnom = new Prosses();
  $tdon = new Prosses();
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infaq</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Modal -->
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="donasiModalLabel">Donatur Masjid Wikrama</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="#" method="post">
                <div class="mb-3">
                    <label for="nama_donatur" class="form-label">Masukkan Nama Donatur</label>
                    <input type="text" class="form-control" id="nama_donatur" name="nama_donatur" required>
                </div>

                <div class="mb-3">
                    <label for="id_donatur" class="form-label">Masukkan ID Donatur</label>
                    <input type="number" class="form-control" id="id_donatur" name="id_donatur" required>
                </div>

                <div class="mb-3">
                    <label for="paket" class="form-label">Pilih Paket</label>
                    <select name="jenis_barang" class="form-select" id="paket" name="paket" required>
                        <option selected disabled>Pilih paket</option>
                        <option value="paket 1">Paket 1</option>
                        <option value="paket 2">Paket 2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Pilih Kategori</label>
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option selected disabled>Pilih kategori</option>
                        <option value="emas">Emas</option>
                        <option value="uang">Uang</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah_barang" class="form-label">Jumlah Nominal</label>
                    <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" required>
                </div>

                <div class="modal-footer">
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="click" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>