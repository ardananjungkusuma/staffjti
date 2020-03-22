<div class="container mt-3">
    <div class="row">
        <div class="col-lg-12">
            <h2>Daftar Barang</h2>
            <table class="table table-striped table-bordered" id="listBarang">
                <thead style="background-color: #67c7c5;color:white">
                    <tr>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Merk</th>
                        <th scope="col">Jumlah Barang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($barang as $br) :
                    ?>
                        <tr>
                            <td><?= $br['nama_barang'] ?></td>
                            <td><?= $br['merk'] ?></td>
                            <td><?= $br['jumlah_barang'] ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>