<div class="col-12">
            <div class="card">
            
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>PROJECT STATUS</th>
                      <th>TOTAL PROJECT</th>
                      <th>NILAI PROJECT</th>
                    </tr>
                  </thead>
                  <?php 
                  $nilaidata = 0;
                  foreach ($dataresult as $key => $value) {
                    $nilaidata =$nilaidata+ $value["nilai"];
                    ?>
                    <tr>
                      <th><?=$value["project_status"]?></th>
                      <th><?=$value["Count"]?></th>
                      <th><?=rupiah($value["nilai"])?></th>
                    </tr>
                    <?php
                  }

                  ?>
                  <tr>
                    <th colspan=2></th>
                    <th>  
                <?php
                echo rupiah($nilaidata);
                ?>
                </th>
                  </tr>
                  <tbody>
                  </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>