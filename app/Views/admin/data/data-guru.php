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
               <?php if (session()->getFlashdata('msg')) : ?>
                  <div class="pb-2 px-3">
                     <div class="alert alert-<?= session()->getFlashdata('error') == true ? 'danger' : 'success'  ?> ">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <i class="material-icons">close</i>
                        </button>
                        <?= session()->getFlashdata('msg') ?>
                     </div>
                  </div>
               <?php endif; ?>
               <div class="row">
                  <div class="col-12 col-xl-12">
                     <div class="card">
                        <div class="card-header card-header-tabs card-header-success">
                           <div class="nav-tabs-navigation">
                              <div class="row">
                                 <div class="col-md-4 col-lg-5">
                                    <h4 class="card-title"><b>Daftar Guru</b></h4>
                                    <p class="card-category">Angkatan <?= $generalSettings->school_year; ?></p>
                                    <input type="text" id="searchInput" onkeyup="searchData()" placeholder="Cari guru..." class="form-control" style="color: white;">
                                    <style>
                                       #searchInput::placeholder {
                                          color: white;
                                       }
                                    </style>
                                 </div>
                                 <div class="ml-md-auto col-auto row">
                                    <div class="col-12 col-sm-auto nav nav-tabs">
                                       <div class="nav-item">
                                          <a class="nav-link" id="tabBtn" onclick="removeHover()" href="<?= base_url('admin/guru/create'); ?>">
                                             <i class="material-icons">add</i> Tambah data guru
                                             <div class="ripple-container"></div>
                                          </a>
                                       </div>
                                    </div>
                                    <div class="col-12 col-sm-auto nav nav-tabs">
                                       <div class="nav-item">
                                          <a class="nav-link" id="refreshBtn" onclick="getDataGuru()" href="#" data-toggle="tab">
                                             <i class="material-icons">refresh</i> Refresh
                                             <div class="ripple-container"></div>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="dataGuru">
                           <p class="text-center mt-3">Daftar guru muncul disini</p>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   <?php endif; ?>
</div>
<script>
   getDataGuru();

   function getDataGuru() {
      jQuery.ajax({
         url: "<?= base_url('/admin/guru'); ?>",
         type: 'post',
         data: {},
         success: function(response, status, xhr) {
            $('#dataGuru').html(response);
            $('html, body').animate({
               scrollTop: $("#dataGuru").offset().top
            }, 500);
            $('#refreshBtn').removeClass('active show');
         },
         error: function(xhr, status, thrown) {
            console.log(thrown);
            $('#dataGuru').html(thrown);
            $('#refreshBtn').removeClass('active show');
         }
      });
   }

   function searchData() {
      const input = document.getElementById('searchInput');
      const filter = input.value.toLowerCase();
      const dataGuruDiv = document.getElementById('dataGuru');
      const guruList = dataGuruDiv.getElementsByTagName('tr'); // Adjust this if your list structure is different

      for (let i = 0; i < guruList.length; i++) {
         const name = guruList[i].textContent || guruList[i].innerText;
         if (name.toLowerCase().indexOf(filter) > -1) {
            guruList[i].style.display = "";
         } else {
            guruList[i].style.display = "none";
         }
      }
   }

   function removeHover() {
      setTimeout(() => {
         $('#tabBtn').removeClass('active show');
      }, 250);
   }
</script>
<?= $this->endSection() ?>