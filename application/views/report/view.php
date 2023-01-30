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
                  foreach ($dataresult as $key => $value) {
                    ?>
                    <tr>
                      <th><?=$value["project_status"]?></th>
                      <th><?=$value["Count"]?></th>
                      <th><?=rupiah($value["nilai"])?></th>
                    </tr>
                    <?php
                  }

                  ?>
                  <tbody>
                  </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>