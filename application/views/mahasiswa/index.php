<div class="container mt-3">
    <?php if ($this->session->flashdata('hasil')) : ?>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $this->session->flashdata('hasil'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="row mt-4">
            <div class="col-md-6">
                <a href="<?= base_url(); ?>mahasiswa/tambah" class="btn btn-primary">Tambah Data Mahasiswa</a>
            </div>
        </div>
        <div class="col-lg-12">
            <h2>Daftar Mahasiswa</h2>
            <table class="table table-striped table-bordered" id="listMahasiswa">
                <thead style="background-color: #73326b;color:white">
                    <tr>
                        <th scope="col">Nama Mahasiswa</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nomer HP</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($mahasiswa as $mhs) :
                    ?>
                        <tr>
                            <td><?= $mhs['nama'] ?></td>
                            <td><?= $mhs['nim'] ?></td>
                            <td><?= $mhs['no_hp'] ?></td>
                            <td><?= $mhs['alamat'] ?></td>
                            <td><a href="<?= base_url() ?>mahasiswa/edit/<?= $mhs['id_mahasiswa'] ?>" class="btn btn-success">Edit</a>
                                <a href="<?= base_url() ?>mahasiswa/hapus/<?= $mhs['id_mahasiswa'] ?>" onclick="return confirm('Apakah Anda Ingin Menghapus <?= $mhs['nama'] ?>?');" class="btn btn-danger">Hapus</a></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>