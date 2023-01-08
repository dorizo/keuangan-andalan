<div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-10">
                    <h3 class="card-title">TABLE <?=$titlepage?></h3>
                  </div>
                  <div class="col-2">
                  <a class="btn btn-danger" href="<?=base_url("project/add")?>">Tambah</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>NO</th>
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
                      <div class="btn-group dropleft">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu">
                          <!-- Dropdown menu links -->
                          <a class="dropdown-item" href="<?=base_url("project/detail/".$value["project_id"])?>"><i class="fas fa-search fa-fw"></i> Detail</a>
                          <?=projectmenu("CPRO",base_url("pengajuan/setting/".$value["project_id"]) , "fa-money-bill" , "Pengajuan")?>
                          <?=projectmenu("KEUW",base_url("project/generate/".$value["project_id"]) , "fa-money-bill" , "Generate CALLCENTER")?>
                          <?=projectmenu("UPRO",base_url("project/edit/".$value["project_id"]) , "fa-money-bill" , "Edit")?>
                          <?=projectmenu("KEUW",base_url("project/setting/".$value["project_id"]) , "fa-money-bill" , "Setting Project")?>
                          <?=projectmenu("KEUW",base_url("transaksi/setting/".$value["project_id"]) , "fa-money-bill" , "Pembayaran Vendor")?>
                          <?=projectmenu("KEUW",base_url("project/done/".$value["project_id"]) , "fa-money-bill" , "Penyelesaian Project")?>
                          <!-- <a class="dropdown-item" href="<?=base_url("project/setting/".$value["project_id"])?>"><i class="fas fa-money-bill"></i> </a>
                          <a class="dropdown-item" href="<?=base_url("transaksi/setting/".$value["project_id"])?>"><i class="fas fa-money-bill"></i> </a>
                          <a class="dropdown-item" href="<?=base_url("project/done/".$value["project_id"])?>"><i class="fas fa-user fa-fw"></i> </a> -->
                    
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