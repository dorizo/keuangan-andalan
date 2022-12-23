<div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">TABLE <?=$titlepage?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>PROJECT ID LOCAL</th>
                      <th>PROJECT CODE</th>
                      <th>PROJECT STATUS</th>
                      <th>ESTIMASI PROJECT DONE</th>
                      <th>CATATAN PROJECT</th>
                      <th>MODE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($dataresult as $key => $value) { 
                    ?>
                    <tr class="odd">
                      <td class="sorting_1 dtr-control"><?=$value["project_id"]?></td>
                      <td><?=$value["project_code"]?></td>
                      <td><?=$value["project_status"]?></td>
                      <td><?=$value["project_done"]?></td>
                      <td><?=$value["project_note"]?></td>
                      <td>
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Mode
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="<?=base_url("project/detail/".$value["project_id"])?>"><i class="fas fa-search fa-fw"></i> Detail</a>
                          <a class="dropdown-item" href="<?=base_url("project/setting/".$value["project_id"])?>"><i class="fas fa-money-bill"></i> Setting Jumlah</a>
                          <a class="dropdown-item" href="<?=base_url("transaksi/setting/".$value["project_id"])?>"><i class="fas fa-money-bill"></i> Pembayaran Vendor</a>
                        </div>
                      </div>    
                    </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 <tfoot>
                  <tr>
                     <th>PROJECT ID</th>
                      <th>PROJECT NAME</th>
                      <th>PROJECT STATUS</th>
                      <th>ESTIMASI PROJECT DONE</th>
                      <th>ESTIMASI PROJECT DONE</th>
                      <th>MODE</th>
                    </tr>
                 </tfoot>
                </table>
               </div>
              <!-- /.card-body -->
            </div>
          </div>