<div class="col-12">
            <div class="card">
            
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <h4>Total Keseluruhan</h4>
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
                <hr /><h4>Total PERWITEL</h4>
                
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>PROJECT STATUS</th>
                      <th>jaktim</th>
                      <th>jakbar</th>
                      <th>jaksel</th>
                      <th>jakpus</th>
                      <th>bogor</th>
                      <th>tanggrang</th>
                      <th>banten</th>
                      <th>cirebon</th>
                      <th>bandung</th>
                      <th>bekasi</th>
                    </tr>
                  </thead>
                  <?php 
                  $jaktim = 0;
                  $jakbar = 0;
                  $jakut = 0;
                  $jakpus = 0;
                  $bogor = 0;
                  $tanggrang = 0;
                  $banten = 0;
                  $cirebon = 0;
                  $bandung = 0;
                  $bekasi = 0;
                  foreach ($dataresult2 as $key => $value) {
                    
                  $jaktim = $jaktim+ $value["jaktim"];
                  $jakbar = $jakbar+ $value["jakbar"];
                  $jakut = $jakut+ $value["jakut"];
                  $jakpus = $jakpus+ $value["jakpus"];
                  $bogor = $bogor+ $value["bogor"];
                  $tanggrang = $tanggrang+ $value["tanggrang"];
                  $banten = $banten+ $value["banten"];
                  $cirebon = $cirebon+ $value["cirebon"];
                  $bandung = $bandung+ $value["bandung"];
                  $bekasi = $bekasi+ $value["bekasi"];
                    ?>
                    <tr>
                      <th><?=$value["job_name"]?></th>
                      <th><?=$value["jaktim"]?></th>
                      <th><?=$value["jakbar"]?></th>
                      <th><?=$value["jakut"]?></th>
                      <th><?=$value["jakpus"]?></th>
                      <th><?=$value["bogor"]?></th>
                      <th><?=$value["tanggrang"]?></th>
                      <th><?=$value["banten"]?></th>
                      <th><?=$value["cirebon"]?></th>
                      <th><?=$value["bandung"]?></th>
                      <th><?=$value["bekasi"]?></th>
                    </tr>
                    <?php
                  }

                  ?>
                  <tr>
                      <th>TOTAL</th>
                      <th><?=$jaktim?></th>
                      <th><?=$jakbar?></th>
                      <th><?=$jakut?></th>
                      <th><?=$jakpus?></th>
                      <th><?=$bogor?></th>
                      <th><?=$tanggrang?></th>
                      <th><?=$banten?></th>
                      <th><?=$cirebon?></th>
                      <th><?=$bandung?></th>
                      <th><?=$bekasi?></th>
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