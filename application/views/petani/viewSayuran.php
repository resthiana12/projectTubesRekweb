<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <?= $this->session->flashdata('message'); ?>
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>
            <!-- Tampilkan pesan error -->


            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambah
                sayuran</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jenis sayur</th>
                        <th scope="col">Nama sayur</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Query -->
                    <?php
                    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                    $id_petani = $user['id'];
                    // var_dump($id_petani);
                    // die;
                    $queryTampilSesuaiId = "SELECT *
                                            FROM `sayuran` JOIN `user`
                                            ON `sayuran`.`id_petani` = `user`.`id`
                                            WHERE `sayuran`.`id_petani` = $id_petani";
                    $sayuran2 = $this->db->query($queryTampilSesuaiId)->result_array();
                    ?>

                    <!-- Akhir Query -->
                    <?php $i = 1; ?>
                    <?php foreach ($sayuran2 as $s) : ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $s['jenis_sayur']; ?></td>
                        <td><?= $s['nama_sayur']; ?></td>
                        <td><?= $s['deskripsi']; ?></td>
                        <td><?= $s['harga']; ?></td>
                        <td><img src="<?= base_url('assets/img/gambar-sayur') . "/" . $s['gambar_sayur']; ?>" alt=""
                                width="60" height="60">
                        </td>
                        <td>
                            <a href="<?= base_url(); ?>menu/ubahSubMenu/<?= $s['id']; ?>"
                                class="badge badge-success">edit</a>
                            <a href="<?= base_url(); ?>menu/deleteSubMenu/<?= $s['id']; ?>" class="badge badge-danger"
                                onclick="return confirm('yakin ? ');">delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Tambah sayuran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url(); ?>petani/tambahSayuran2" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="jenis-sayur" name="jenis-sayur"
                            placeholder="Jenis sayur">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama-sayur" name="nama-sayur"
                            placeholder="Nama sayur">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi"
                            rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tanggal-rilis" name="tanggal-rilis"
                            placeholder="Tanggal rilis">
                    </div>
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <br>
                        <input type="file" id="gambar" name="gambar">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>