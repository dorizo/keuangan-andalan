<table id="example1" class="table table-bordered table-hover">
<form method="post">
                      <thead>
                    <tr>
                      <th>NO</th>
                      <th>PROJECT CODE</th>
                      <th>PROJECT STATUS</th>
                      <th>Nilai Boq</th>
                      <th>MODE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $spkode = $resultdata->project_id;
                    foreach ($project as $key => $value) {
                      $cekadangakkodeproject = $this->db->query("select * from suratpesanandetail where suratpesananCode='$spkode' AND project_id=".$value["project_id"])->num_rows(); 
                      $chekkkk = "";
                      if($cekadangakkodeproject == 1){
                        $chekkkk = "checked";
                      } 
                    ?>
                    <tr class="odd">
                      <td class="sorting_1 dtr-control">
                      <input type="checkbox" name="bagi[<?=$key?>]" value="<?=$value["project_id"]?>" <?=$chekkkk?> />
                      </td>
                      <td><?=$value["project_code"]?></td>
                      <td><?=$value["project_status"]?></td>
                      <td><?=$value["project_done"]?></td>
                      <td><?=rupiah($value["nilai_project"])?></td>
                    </tr>
                      <?php
                        }
                        ?>
        <tr>
            <td colspan="4"></td>
            <td colspan="1"><input type="submit" class="btn btn-success" value="submit"></td>
        </tr>
                        
 </form>
                        </table>
