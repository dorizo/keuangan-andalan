<div class="col-12">
           
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
               
               <div class="card p-4">
                <form method="GET">
                <div class="row">
                 
                
                <div class="col-3"><br />Tanggal Mulai Project</div>
                <div class="col-4"><br /><input type="date" class="form-control" value="<?=$this->input->get("project_start");?>" name="project_start" /></div>
                <div class="col-1 text-center"><br />s/d</div>
                <div class="col-4"><br /><input type="date" class="form-control" value="<?=$this->input->get("project_done");?>"  name="project_done" /></div>
                
                  <div class="col-4"><br /><input type="submit" class="btn btn-success" value="Search" /></div>
                  <div class="col-4"><br />
                  <?php $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                  ?>
                  <a target="_BLANK" href="<?=str_replace("excelexport/transaksi?","excelexport/exporttransaksi?",$actual_link)?>" class="btn btn-success">Export</a><p><small>Fungsi ini Berfungsi setelah tombol serach di tekan</small></p></div>

                  
                </div>
                  </form>
               </div>
                <table id="" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>APPROVEL DATE</th>
                      <th>AKUN TRANSAKSI</th>
                      <th>WITEL</th>
                      <th>CATEGORY</th>
                      <th>PROJECT CODE</th>
                      <th>DESCRIPTION</th>
                      <th>AMAUNT</th>
                      <th>AKUN BANK</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($dataresult as $key => $value) { 
                      $spnum = $this->db->query("SELECT * FROM `suratpesanan` a JOIN suratpesanandetail b ON a.suratpesananCode=b.suratpesananCode  WHERE b.project_id=".$value["project_id"])->row();
                      if($spnum){
                        $spnum = $spnum->NoSuratpesanan;
                      }
                    ?>
                    <tr class="odd">
                      <td><?=tanggal($value["transaksiDate"])?></td>
                      <td><?=$value["akunbankName"]?></td>
                      <td><?=$value["witel_name"]?></td>
                      <td><?=$value["cat_name"]?></td>
                      <td><?=$value["project_code"]?></td>
                      <td><?=$value["transaksiNote"]?></td>
                      <td><?=$value["transaksiJumlah"]?></td>
                      <td><?=$value["bank_name"]?></td>
                     
                    </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 <tfoot>
                  <tr>
                  
                  <th>APPROVEL DATE</th>
                      <th>AKUN TRANSAKSI</th>
                      <th>WITEL</th>
                      <th>CATEGORY</th>
                      <th>PROJECT CODE</th>
                      <th>DESCRIPTION</th>
                      <th>AMAUNT</th>
                      <th>AKUN BANK</th>
                    </tr>
                 </tfoot>
                </table>
               </div>
              <!-- /.card-body -->
            </div>
          </div>
          
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  });
  </script>