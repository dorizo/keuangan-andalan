<div class="col-12">
<div class="card card-warning">
<div class="col-12">
<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">FORM INPUT</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post">
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <input type="hidden" name="suratpesananCode" value="<?=$suratpesananCode?>" />
                     
                        <div class="form-group">
                          <label>Status Project</label>
                          <select name="project_status" class="custom-select">
                            <?php
                            foreach ($datajob as $key => $value) {
                              if($value["job_name"] !="PAID"){
                            ?>
                              <option value="<?=$value["job_name"]?>"><?=$value["job_name"]?></option>
                              <?php
                              }
                            }
                              ?>
                          </select>
                          
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

</div>
</div>
</div>

<table id="example" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>NO CODE</th>
                      <th>Witel</th>
                      <th>NAMA SURAT PESANAN</th>
                      <th>NILAI SURAT PESANAN</th>
                      <th>STATUS PROJECT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($dataresult as $key => $value) { 
                    ?>
                    <tr class="odd">
                      <td><?=$value["witel"]?></td>
                      <td><?php print_r($value["project_code"])?></td>
                      <td><?=$value["project_status"]?></td>
                      <td><?=$value["nilai_project"]?></td>
                      <td><?=$value["project_status"]?></td>
                    </td>

                    <?php } ?>

                    </body>
                    </table>