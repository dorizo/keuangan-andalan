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
                    foreach ($project as $key => $value) { 
                      $chekkkk = $value["project_code"] == $resultdata->project_code?"checked":"";
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
