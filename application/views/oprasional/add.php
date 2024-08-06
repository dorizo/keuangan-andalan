<div class="col-lg-12">
        <div class="card card-primary">
            <form method="post">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Tanggal</label>
                <input type="date" name="tanggal" id="inputName" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Akun</label>
                <select  name="kode_akun"  class="form-control select2">
                            <option value="">Pilih</option>
                            <?php
                              foreach ($akun as $key => $value) {
                              echo "<option value='".$value["kode_akun"]."'>".$value["nama_akun"]."</option>";
                              }
                            ?>
                </select>
              </div>

              <div class="form-group">
                <label for="inputName">Kategori</label>
                <select name="kategori" class="form-control select2">
                            <option value="">Pilih</option>
                            <option value="Oprasional">Oprasional</option>
                            <option value="Capex">Capex</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="inputName">Witel</label>
                <select name="witel_id" class="form-control select2">
                            <option value="">Pilih</option>
                            <?php
                              foreach ($witel as $key => $value) {
                              echo "<option value='".$value["witelhoID"]."'>".$value["witelhoName"]."</option>";
                              }
                            ?>
                </select>
              </div>
              
              <div class="form-group">
                <label for="inputName">STO</label>
                <select  name="stoCode" class="form-control select2">
                            <option value="">Pilih</option>
                            <?php
                              foreach ($sto as $key => $value) {
                              echo "<option value='".$value["stoCode"]."'>".$value["stoName"]."</option>";
                              }
                            ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputName">Pekerjaan</label>
                <select  name="pekerjaanCode" class="form-control select2">
                            <option value="">Pilih</option>
                            <?php
                              foreach ($Pekerjaan as $key => $value) {
                              echo "<option value='".$value["pekerjaanCode"]."'>".$value["pekerjaanName"]."</option>";
                              }
                            ?>
                </select>
              </div>
              
              <div class="form-group">
                <label for="inputName">Kode Project</label>
                <input type="text" name="kode_project" id="inputName" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="inputName">Keterangan</label>
                <input type="text" name="keterangan" id="inputName" class="form-control">
              </div>
            
            <div class="form-group">
                <label for="inputName">Kategori Pengeluaran</label>
                <select name="kategoriakutansi" id="kategoriakutansi" class="form-control select2">
                            <option value="">Pilih</option>
                            <option value="debit">debit</option>
                            <option value="kredit">kredit</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="inputName">debit</label>
                <input type="tel" name="debit" id="debit" value="0" class="form-control" readonly>
              </div>
            <div class="form-group">
                <label for="inputName">kredit</label>
                <input type="tel" name="kredit" id="kredit" value="0" class="form-control" readonly>
              </div>
              
              <div class="form-group">
                <label for="inputName">Diterima Oleh</label>
                <input type="text" name="diterimaoleh" id="inputName" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="inputName">Dikirim Oleh</label>
                <input type="text" name="dikirimoleh" id="inputName" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="inputName">mandor</label>
                <input type="text" name="mandor" id="inputName" class="form-control">
              </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <a href="<?=base_url("master/user")?>" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create new Project" class="btn btn-success float-right">
            </div>
            </form>
       </div>
          <!-- /.card -->
      
<script>
  document.getElementById('kategoriakutansi').onchange = function() {
    console.log(this.value);
    document.getElementById('kredit').removeAttribute('readonly');
    document.getElementById('debit').removeAttribute('readonly');
    if(this.value=="kredit"){

      document.getElementById('kredit').removeAttribute('readonly');
      document.getElementById('debit').readOnly = true; 
    }else if(this.value=="debit"){

      document.getElementById('debit').removeAttribute('readonly');
      document.getElementById('kredit').readOnly = true; 
    }
};
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  });
  
var tanpa_rupiah = document.getElementById('debit');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value);
    });
    
var tanpa_rupiah2 = document.getElementById('kredit');
    tanpa_rupiah2.addEventListener('keyup', function(e)
    {
        tanpa_rupiah2.value = formatRupiah(this.value);
    });
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
  </script>