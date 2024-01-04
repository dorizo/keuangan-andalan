<div class="col-lg-12">
<div class="card p-2">
              
              <div class="card-body table-responsive p-0">
                  <div class="alert clearfix text-right">
                    <a href="<?=base_url("Master/user/add");?>" class="btn btn-success"><i class="fa fa-plus"></i>TAMBAH</a>
                  </div>
                <table id="example" class="table table-striped table-valign-middle" style="font-size:12px">
                  <thead>
                  <tr>
                    <th>UserCode</th>
                    <th>Username</th>
                    <th>Create</th>
                    <th width=50px>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($result as $key => $value) {
                //    print_r($value);
                    ?>
                    <tr>
                        <td><?php print_r($value["userCode"]); ?></td>
                        <td><?php print_r($value["email"]); ?></td>
                        <td><?php print_r(tanggal($value["createAt"])); ?></td>
                        <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default">Action</button>
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                            <?=projectmenu("CR",base_url("Master/user/detail/".$value["userCode"]) , "fa-money-bill" , "Detail")?>
                            <?=projectmenu("CR",base_url("Master/user/detailwitel/".$value["userCode"]) , "fa-money-bill" , "Setting witel")?>
                          
                              <a class="dropdown-item" href="<?=base_url("Master/user/edit/".$value["userCode"]);?>">EDIT</a>
                              <a class="dropdown-item" onclick="hapus('<?=base_url("Master/user/delete/".$value['userCode']);?>')">DELETE</a>
                            </div>
                          </div>
                        </td>
                    </tr>
                    </tr>

                    <?php
                         # code...
                        }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
</div>