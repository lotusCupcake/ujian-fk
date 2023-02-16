<?= $this->extend('layout/templateHome'); ?>

<?= $this->section('content'); ?>
<!-- Wrapper Start -->
<?= view('layout/templateSidebar', ['menus' => $menu]); ?>

<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><?= $title ?></h3>
                    <p class="text-subtitle text-muted">
                        Halaman ini menampilan <?= $title ?>.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><?= $breadcrumb[0]; ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?= $breadcrumb[1]; ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <?php if ($validation->hasError('userEmail')) : ?>
            <?= view('layout/templateAlert', ['msg' => ['danger', "<strong>Gagal!</strong>", $validation->getError('userEmail')]]); ?>
        <?php endif; ?>
        <?php if ($validation->hasError('userName')) : ?>
            <?= view('layout/templateAlert', ['msg' => ['danger', "<strong>Gagal!</strong>", $validation->getError('userName')]]); ?>
        <?php endif; ?>
        <?php if ($validation->hasError('userRole')) : ?>
            <?= view('layout/templateAlert', ['msg' => ['danger', "<strong>Gagal!</strong>", $validation->getError('userRole')]]); ?>
        <?php endif; ?>
        <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <?= view('layout/templateAlert', ['msg' => ['success', '<strong>Sukses!</strong>', session()->getFlashdata('success')]]); ?>
        <?php endif; ?>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-4" style="float: right">
                        <div class="input-group">
                            <input type="text" class="form-control cari" placeholder="Search..." name="keyword" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : "" ?>" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <button class="btn btn-primary" type="button" id="button-addon1">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align:center" scope="col">No.</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th style="text-align:center">Status</th>
                                    <th width="20%" style="text-align:center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($manajemenAkun)) : ?>
                                    <?php
                                    $no = 1 + ($numberPage * ($currentPage - 1));
                                    foreach ($manajemenAkun as $user) : ?>
                                        <tr>
                                            <td style="text-align:center" scope="row"><?= $no++; ?></td>
                                            <td><?= $user->email; ?></td>
                                            <td><?= $user->username; ?></td>
                                            <td><?= $user->description; ?></td>
                                            <td style="text-align:center"><span class="badge <?= $user->active == 1 ? "bg-success" : "bg-danger"; ?>"><?= $user->active == 1 ? "Aktif" : "Tidak Aktif"; ?></span></td>
                                            <td style="text-align:center">
                                                <button type="button" class="btn icon btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit<?= $user->user_id; ?>" <?= ($user->user_id == user()->id) ? 'disabled' : ''; ?>><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <?= view('layout/templateEmpty', ['jumlahSpan' => 6]); ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                        <?= $pager->links('manajemenAkun', 'pager') ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- modal edit -->
    <?php foreach ($manajemenAkun as $edit) : ?>
        <?php if ($edit->user_id != user()->id) : ?>
            <div class="modal fade" id="edit<?= $edit->user_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">
                                Edit <?= $title ?>
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="/manajemenAkun/ubah/<?= $edit->user_id; ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="userEmail" type="text" class="form-control" value="<?= $edit->email; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="userName" type="text" class="form-control" value="<?= $edit->username; ?>">
                                </div>
                                <!-- hapus background-color di template\assets\extensions\choices.js\public\assets\styles\choices.css -->
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="userRole" class="choices form-select">
                                        <option value="">Pilih Role</option>
                                        <?php foreach ($authGroups as $groups) : ?>
                                            <option value="<?= $groups->id; ?>" <?= ($groups->id == $edit->id) ? "selected" : "" ?>><?= $groups->description; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input name="userActive" class="form-check-input" type="checkbox" <?= ($edit->active == 1) ? "checked" : ""; ?> value="<?= $edit->active; ?>">
                                        <label class="form-check-label">Aktif</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"><i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1"><i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Save Changes</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif ?>
    <?php endforeach ?>

    <?= view('layout/templateFooter'); ?>
</div>

<?= $this->endSection(); ?>