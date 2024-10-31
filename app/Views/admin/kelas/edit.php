<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<?php
$context = $ctx ?? 'dashboard';
switch ($context) {
  case 'absen-siswa':
  case 'siswa':
  case 'kelas':
    $sidebarColor = 'purple';
    break;
  case 'absen-guru':
  case 'guru':
    $sidebarColor = 'green';
    break;

  case 'qr':
    $sidebarColor = 'danger';
    break;

  default:
    $sidebarColor = 'azure';
    break;
}
?>
<div class="content">
  <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title"><b>Form Edit Kelas</b></h4>
            </div>
            <div class="card-body mx-5 my-3">

              <form action="<?= base_url('admin/kelas/editKelasPost'); ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($kelas->id_kelas); ?>">
                <input type="hidden" name="back_url" value="<?= currentFullURL(); ?>">

                <div class="form-group mt-4">
                  <label for="kelas">Kelas / Tingkat</label>
                  <input type="text" id="kelas" class="form-control <?= invalidFeedback('kelas') ? 'is-invalid' : ''; ?>" name="kelas" placeholder="'X', 'XI', '11'" , value="<?= old('kelas') ?? $kelas->kelas  ?? '' ?>" required>
                  <div class="invalid-feedback">
                    <?= invalidFeedback('kelas'); ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <label for="id_jurusan">Jurusan</label>
                    <select class="custom-select <?= invalidFeedback('id_jurusan') ? 'is-invalid' : ''; ?>" id="id_jurusan" name="id_jurusan">
                      <option value="">--Pilih Jurusan--</option>
                      <?php foreach ($jurusan as $value) : ?>
                        <option value="<?= $value['id']; ?>" <?= $kelas->id_jurusan == $value['id'] ? 'selected' : ''; ?>>
                          <?= $value['jurusan']; ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                      <?= invalidFeedback('id_jurusan'); ?>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Simpan</button>
              </form>

              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
<?= $this->endSection() ?>