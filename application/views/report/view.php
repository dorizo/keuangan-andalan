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
                      <th><?=strtoupper($value["project_status"])?></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["project_status"])?>" target="_BLANK"><?=$value["Count"]?></a></th>
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
                <hr /><h4>PER WITEL PARAMETER JUMLAH PROJECT</h4>
                
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>PROJECT STATUS</th>
                      <th>JAK TIM</th>
                      <th>JAK SEL</th>
                      <th>JAK BAR</th>
                      <th>JAK UT</th>
                      <th>JAK PUS</th>
                      <th>BOGOR</th>
                      <th>TANGGRANG</th>
                      <th>BANTEN</th>
                      <th>CIREBON</th>
                      <th>BANDUNG</th>
                      <th>BEKASI</th>
                      <th>TOTAL </th>
                    </tr>
                  </thead>
                  <?php 
                  $jaktim = 0;
                  $jaksel = 0;
                  $jakbar = 0;
                  $jakut = 0;
                  $jakpus = 0;
                  $bogor = 0;
                  $tanggrang = 0;
                  $banten = 0;
                  $cirebon = 0;
                  $bandung = 0;
                  $bekasi = 0;
                  //kode witel untuk ambil url
                  $witeler = array(6,7,8,9,10,11,12,14,14,15,16);
                  foreach ($dataresult2 as $key => $value) {
                    
                  $jaktim = $jaktim+ $value["jaktim"];
                  $jaksel = $jaksel+ $value["jaksel"];
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
                      <th><?=strtoupper($value["job_name"])?></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[0]?>" target="_BLANK"><?=$value["jaktim"]?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[1]?>" target="_BLANK"><?=$value["jaksel"]?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[2]?>" target="_BLANK"><?=$value["jakbar"]?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[4]?>" target="_BLANK"><?=$value["jakut"]?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[3]?>" target="_BLANK"><?=$value["jakpus"]?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[5]?>" target="_BLANK"><?=$value["bogor"]?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[6]?>" target="_BLANK"><?=$value["tanggrang"]?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[7]?>" target="_BLANK"><?=$value["banten"]?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[8]?>" target="_BLANK"><?=$value["cirebon"]?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[9]?>" target="_BLANK"><?=$value["bandung"]?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[10]?>" target="_BLANK"><?=$value["bekasi"]?></a></th>
                      <th><?=($value["jaktim"]+$value["jakbar"]+$value["jakut"]+$value["jakpus"]+$value["bogor"]+$value["tanggrang"]+$value["banten"]+$value["cirebon"]+$value["bandung"]+$value["bekasi"])?></th>
                    </tr>
                    <?php
                  }

                  ?>
                  <tr>
                      <th>TOTAL</th>
                      <th><?=$jaktim?></th>
                      <th><?=$jaksel?></th>
                      <th><?=$jakbar?></th>
                      <th><?=$jakut?></th>
                      <th><?=$jakpus?></th>
                      <th><?=$bogor?></th>
                      <th><?=$tanggrang?></th>
                      <th><?=$banten?></th>
                      <th><?=$cirebon?></th>
                      <th><?=$bandung?></th>
                      <th><?=$bekasi?></th>
                      <th><?=thousandsCurrencyFormat(($jaktim+$jakbar+$jakut+$jakpus+$bogor+$tanggrang+$banten+$cirebon+$bandung+$bekasi))?></th>
                      </tr>
                  <tbody>
                  </tbody>
                </table>

                <hr /><h4>PER WITEL PARAMETER NILAI PROJECT</h4>
                
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>PROJECT STATUS</th>
                      <th>JAK TIM</th>
                      <th>JAK SEL</th>
                      <th>JAK BAR</th>
                      <th>JAK UT</th>
                      <th>JAK PUS</th>
                      <th>BOGOR</th>
                      <th>TANGGRANG</th>
                      <th>BANTEN</th>
                      <th>CIREBON</th>
                      <th>BANDUNG</th>
                      <th>BEKASI</th>
                      <th>TOTAL</th>
                    </tr>
                  </thead>
                  <?php 
                  $jaktim = 0;
                  $jaksel = 0;
                  $jakbar = 0;
                  $jakut = 0;
                  $jakpus = 0;
                  $bogor = 0;
                  $tanggrang = 0;
                  $banten = 0;
                  $cirebon = 0;
                  $bandung = 0;
                  $bekasi = 0;
                  foreach ($dataresult3 as $key => $value) {
                  $jaktim = $jaktim+ $value["jaktim"];
                  $jakbar = $jakbar+ $value["jakbar"];
                  $jaksel = $jaksel+ $value["jaksel"];
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
                      <th><?=strtoupper($value["job_name"])?></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[0]?>" target="_BLANK"><?=thousandsCurrencyFormat($value["jaktim"])?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[1]?>" target="_BLANK"><?=thousandsCurrencyFormat($value["jaksel"])?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[2]?>" target="_BLANK"><?=thousandsCurrencyFormat($value["jakbar"])?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[4]?>" target="_BLANK"><?=thousandsCurrencyFormat($value["jakut"])?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[3]?>" target="_BLANK"><?=thousandsCurrencyFormat($value["jakpus"])?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[5]?>" target="_BLANK"><?=thousandsCurrencyFormat($value["bogor"])?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[6]?>" target="_BLANK"><?=thousandsCurrencyFormat($value["tanggrang"])?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[7]?>" target="_BLANK"><?=thousandsCurrencyFormat($value["banten"])?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[8]?>" target="_BLANK"><?=thousandsCurrencyFormat($value["cirebon"])?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[9]?>" target="_BLANK"><?=thousandsCurrencyFormat($value["bandung"])?></a></th>
                      <th><a href="<?=base_url("report/detail?project_status=".$value["job_name"])."&witel_id=".$witeler[10]?>" target="_BLANK"><?=thousandsCurrencyFormat($value["bekasi"])?></a></th>
                     <th><?=thousandsCurrencyFormat(($value["jaktim"]+$value["jakbar"]+$value["jakut"]+$value["jakpus"]+$value["bogor"]+$value["tanggrang"]+$value["banten"]+$value["cirebon"]+$value["bandung"]+$value["bekasi"]))?></th>
                    </tr>
                    <?php
                  }

                  ?>
                  <tr>
                      <th>TOTAL</th>
                      <th><?=thousandsCurrencyFormat($jaktim)?></th>
                      <th><?=thousandsCurrencyFormat($jaksel)?></th>
                      <th><?=thousandsCurrencyFormat($jakbar)?></th>
                      <th><?=thousandsCurrencyFormat($jakut)?></th>
                      <th><?=thousandsCurrencyFormat($jakpus)?></th>
                      <th><?=thousandsCurrencyFormat($bogor)?></th>
                      <th><?=thousandsCurrencyFormat($tanggrang)?></th>
                      <th><?=thousandsCurrencyFormat($banten)?></th>
                      <th><?=thousandsCurrencyFormat($cirebon)?></th>
                      <th><?=thousandsCurrencyFormat($bandung)?></th>
                      <th><?=thousandsCurrencyFormat($bekasi)?></th>
                      <th><?=thousandsCurrencyFormat(($jaktim+$jakbar+$jakut+$jakpus+$bogor+$tanggrang+$banten+$cirebon+$bandung+$bekasi))?></th>
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