<div class="col-12">
            <div class="card">
            
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <h4>Total </h4>
                <!-- <form>
                    <div class="row">
                        <div class="col-4">
                            <input type="date" name="mulai" value="<?=$this->input->get("mulai")?>" class="form-control" />
                        </div>
                        <div class="col-4">
                            <input type="date" name="selesai"  value="<?=$this->input->get("selesai")?>" class="form-control" />
                        </div>
                        <div class="col-4">
                            <input type="submit" value="search" class="btn-success" />
                        </div>
                    </div>
                    
                </form> -->

                    <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>PROJECT STATUS</th>
                      <?php
                      foreach ($columtable as $key => $value) {
                        # code...
                        echo "<th>".$value["witel_name"]."</th>";
                      }
                      ?>
                    </tr>
                  </thead>
                  <?php 
                  $nilaidata = 0;
                  foreach ($dataresult as $key => $value) {
                    ?>
                    <tr>
                      <th><?=strtoupper($value["cat_name"])?></th>
                        <?php
                            foreach ($columtable as $key1 => $value1) {
                                
                                # code...
                                echo "<th> <a target='_BLANK' href=".base_url("report/detail?project-cat_id=".$value["cat_id"])."&witel_id=".$value1["witel_id"].">".thousandsCurrencyFormat($this->report_model->reportcatwitel($value["cat_id"] , $value1["witel_id"])->x)."</a></th>";
                            }
                        ?>
                    </tr>
                    <?php
                  }

                  ?>
                  <tr>
                    <th colspan=2></th>
                    <th>  
                    <?php
                    // echo rupiah($nilaidata);
                    ?>
                </th>
                  </tr>
                  <tbody>
                  </tbody>
                </table>
            </div>
        </div>
    </div>