<div class="container mt-3">
    <div class="row">
        <div class="col-lg-12">
            <h2>Daftar Transaksi</h2>
            <table class="table table-striped table-bordered" id="listTransaksi">
                <thead style="background-color: #6e3158;color:white">
                    <tr>
                        <th scope="col">Nama Peminjam</th>
                        <th scope="col">Barang Dipinjam</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th scope="col">Tanggal Dikembalikan</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($transaksi as $tr) :
                    ?>
                        <tr>
                            <td><?= $tr['nama'] ?></td>
                            <td><?= $tr['nama_barang'] ?></td>
                            <td><?= $tr['tanggal_pinjam'] ?></td>
                            <td><?= $tr['tanggal_kembali'] ?></td>
                            <td><?= $tr['tanggal_dikembalikan'] ?></td>
                            <td><?= $tr['status'] ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>