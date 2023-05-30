<div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-10">
                    <h3 class="card-title">TABLE <?=$titlepage?></h3>
                  </div>
                  <div class="col-2">
                  <a class="btn btn-danger" href="<?=base_url("project/add")?>">Tambah</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
               
               <div class="card p-4">
                <form method="GET">
                <div class="row">
                  <div class="col-3">Witel : 
                    <select class="form-control select2" multiple="multiple" name="witel_id[]">
                    <option value="">ALL DATA</option>
                    <?php
                    foreach ($witelresult as $key => $value) {
                      // print_r();
                      $seleced = "";
                      $sos =  array_search($value["witel_id"],$this->input->get("witel_id") ?? []);
                      if(!empty($sos) or $sos ===0){
                        $seleced = "selected";
                      }
                      ?>
                    <option   <?=$seleced?>   value="<?=$value['witel_id']?>"><?php print_r($value["witel_name"])?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                  <div class="col-3">Project Status : 
                    <select  class="form-control select2" multiple="multiple"  name="project_status[]">
                    <option value="">ALL DATA</option>
                    <?php
                    foreach ($datajob as $key => $value) {
                      $seleced = "";
                      $sos =  array_search($value["job_name"],$this->input->get("project_status") ?? []);
                      if(!empty($sos) or $sos ===0){
                        $seleced = "selected";
                      }
                      ?>
                    <option   <?=$seleced?>    <?=$this->input->get("project_status")==$value["job_name"]?"selected":""?>  value="<?=$value['job_name']?>"><?php print_r($value["job_name"])?></option>
                      <?php
                      }
                      ?>
                  </select>
                </div>
                  <div class="col-3">Project Kategori : 
                  <select  class="form-control select2" multiple="multiple"  name="cat_name[]">
                    <option value="">ALL DATA</option>
                    <?php
                    foreach ($Projectcat as $key => $value) {
                      $seleced = "";
                      $sos =  array_search($value["cat_name"],$this->input->get("cat_name") ?? []);
                      if(!empty($sos) or $sos ===0){
                        $seleced = "selected";
                      }
                      ?>
                    <option <?=$seleced?>  <?=$this->input->get("cat_name")==$value["cat_name"]?"selected":""?> value="<?=$value["cat_name"]?>"><?php print_r($value["cat_name"])?></option>
                      <?php
                      }
                      ?>
                  </select>
                </div>
                
                  <div class="col-2"><br /><input type="submit" class="btn btn-success" value="Search" /></div>
                </div>
                  </form>
               </div>
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>Witel</th>
                      <th>KATEGORI</th>
                      <th>PROJECT CODE</th>
                      <th>PROJECT NAME</th>
                      <th>NO SP</th>
                      <th>PROJECT STATUS</th>
                      <th>ESTIMASI PROJECT DONE</th>
                      <th>PROJECT START</th>
                      <th>CATATAN PROJECT</th>
                      <th>MODE</th>
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
                      <td class="sorting_1 dtr-control"><?=$value["project_id"]?></td>
                      <td><?=$value["witel"]?></td>
                      <td><?=$value["cat_name"]?></td>
                      
                      <td><?=$value["project_code"]?></td>
                      <td><?=$value["project_name"]?></td>
                      <td><?=$spnum?></td>
                      <td><?=$value["project_status"]?></td>
                      <td><?=$value["project_done"]?></td>
                      <td><?=$value["project_date"]?></td>
                      <td><?=$value["project_note"]?></td>
                      <td>
                      <div class="btn-group dropleft">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu">
                          <!-- Dropdown menu links -->
                          <a class="dropdown-item" href="<?=base_url("project/detail/".$value["project_id"])?>"><i class="fas fa-search fa-fw"></i> Detail</a>
                          <?=projectmenu("CPRO",base_url("pengajuan/setting/".$value["project_id"]) , "fa-money-bill" , "Pengajuan")?>
                          <?=projectmenu("KEUW",base_url("project/generate/".$value["project_id"]) , "fa-money-bill" , "Generate COST CENTER")?>
                          <?=projectmenu("UPRO",base_url("project/edit/".$value["project_id"]) , "fa-money-bill" , "Edit")?>
                          <?=projectmenu("SETPRO",base_url("project/setting/".$value["project_id"]) , "fa-money-bill" , "Setting Project")?>
                          <?=projectmenu("PMSET",base_url("pmsetting/setting/".$value["project_id"]) , "fa-money-bill" , "Setting Status")?>

                          <?php if($value["project_status"]=="pemberkasan"){ echo projectmenu("BOQFI",base_url("project/boqfinal/".$value["project_id"]) , "fa-money-bill" , "SETTING BOQ FINAL");}?>
                          
                          <?=projectmenu("KEUW",base_url("transaksi/setting/".$value["project_id"]) , "fa-money-bill" , "Pembayaran Vendor")?>
                          <?=projectmenu("KEUW",base_url("project/done/".$value["project_id"]) , "fa-money-bill" , "Penyelesaian Project")?>
                          <!-- <a class="dropdown-item" href="<?=base_url("project/setting/".$value["project_id"])?>"><i class="fas fa-money-bill"></i> </a>
                          <a class="dropdown-item" href="<?=base_url("transaksi/setting/".$value["project_id"])?>"><i class="fas fa-money-bill"></i> </a>
                          <a class="dropdown-item" href="<?=base_url("project/done/".$value["project_id"])?>"><i class="fas fa-user fa-fw"></i> </a> -->
                    
                        </div>
                      </div>
                      
                    </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 <tfoot>
                  <tr>
                  <th>NO</th>
                      <th>Witel</th>
                      <th>KATEGORI</th>
                      <th>PROJECT CODE</th>
                      <th>PROJECT NAME</th>
                      <th>NO SP</th>
                      <th>PROJECT STATUS</th>
                      <th>ESTIMASI PROJECT DONE</th>
                      <th>PROJECT START</th>
                      <th>CATATAN PROJECT</th>
                      <th>MODE</th>
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