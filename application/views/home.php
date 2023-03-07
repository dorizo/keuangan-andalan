<div class="col-lg-12">
<div class="card p-2">
              
              <div class="card-body table-responsive p-0">
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
                <table id="example1" class="table table-striped table-valign-middle" style="font-size:12px">
                  <thead>
                  <tr>
                    <th>Project</th>
                    <th>Estimasi Project Selesai</th>
                    <th>Real Project</th>
                    <th>Nilai Project</th>
                    <th>Project Status</th>
                    <th>User</th>
                    <th>Detail</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($dataresult as $key => $value) {
                      $now = time(); // or your date as well
                      $your_date = strtotime($value["project_done"]);
                      $datediff = $your_date - $now;
                    ?>
                  <tr>
                    <td>
                      
                      Witel : <?=$value["witel"]?><hr />
                      Kategori : <?=$value["cat_name"]?><hr />
                      project Code : <?=$value["project_code"]?>
                    </td>
                    <td>
                      Estimasi Mulai : <?=tanggalindo($value["project_start"])?><br />
                      Estimasi Selesai : <?=tanggalindo($value["project_done"])?><br />
                      Hitung Hari : <?=$value["project_paid"]?"Project Selesai":round($datediff / (60 * 60 * 24))." hari";?> 
                    </td>
                    
                    <td>
                      Project Mulai : <?=tanggalindo($value["project_date"])?><br />
                      Project Paid : <?=$value["project_paid"]?tanggalindo($value["project_paid"]):"project Belum Selesai"?><br />
                      Project Berjalan : <?=countday($value["project_date"],$value["project_paid"]);?> hari <br />
                    
              
                    </td>
                    <td>
                       Pembagian Hasil :  <?=$value["sharing_vendor"];?>/<?=$value["sharing_owner"];?><br />
                       Nilai Project : <?=rupiah($value["nilai_project"])?><br />
                       Bunga Berjalan : <?=rupiah($value["totalbungaseluruh"]);?> <br />
                       Pembayaran Vendor :  <?=rupiah($value["paymentvendor"]);?>
                       <?php if($value["sharing_vendor"] != 0) : ?><br />
                       Sisa Pembayaran Vendor :  <?=rupiah((($value["nilai_project"]*$value["sharing_vendor"])/100)-$value["paymentvendor"]);?>
                      <?php endif ?>
                    </td>
                    <td>
                    Status Project  : <?=$value["project_status"]?><br />
                    <?php
                    // echo $value["paymentvendor"]+$value["pembayaranAPI"];
                    if( $value["paymentvendor"]+$value["pembayaranAPI"] == 0){
                    $point=0;
                    }else{
                     $point =  @(round((((($value["nilai_project"] * $value["sharing_owner"])/100)/($value["paymentvendor"]+$value["pembayaranAPI"]+$value["totalbungaseluruh"]))*100),2));
                    }
                    if($point <= 0){
                      $background = "bg-primary";
                    }elseif($point < 25){
                      $background = "bg-danger";
                    }elseif($point < 35){
                      $background = "bg-warning";
                    }elseif($point < 30000){
                      $background = "bg-success";
                    }
                    ?>
                    <card class="<?=$background?>">
                    Persentase Profit  :<?=$point?>%<br />
                    </card>
                  
                    </td>
                    <td>
                    VENDOR : <?=$value["vendor"]?><hr />
                    <?php
                    $m = $this->db->query("select * from project_user a JOIN user b on a.userCode=b.userCode JOIN role_user c ON c.userCode=b.userCode JOIN role d ON d.roleCode=c.roleCode where a.deleteAt IS NULL AND project_id=".$value["project_id"])->result_array();
                    foreach ($m as $keym => $valm) {
                    echo str_replace("Technician","Waspang ",$valm["role"])." : ".$valm["name"]."<hr />";
                    ?>
                    <?php
                      # code...
                    }
                    ?>

                    </td>
                    <td>
                      <a href="<?=base_url("project/detail/".$value["project_id"])?>"  class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <?php
                     # code...
                    }
                  ?>
                  <!-- <tr>
                    <td>
                      <img src="<?=base_url()?>asset/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Another Product
                    </td>
                    <td>$29 USD</td>
                    <td>
                      <small class="text-warning mr-1">
                        <i class="fas fa-arrow-down"></i>
                        0.5%
                      </small>
                      123,234 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="<?=base_url()?>asset/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Amazing Product
                    </td>
                    <td>$1,230 USD</td>
                    <td>
                      <small class="text-danger mr-1">
                        <i class="fas fa-arrow-down"></i>
                        3%
                      </small>
                      198 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="<?=base_url()?>asset/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Perfect Item
                      <span class="badge bg-danger">NEW</span>
                    </td>
                    <td>$199 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        63%
                      </small>
                      87 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
</div>
   
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  });
  </script>