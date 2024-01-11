<div class="col-lg-12">
<div class="card p-2">
              
              <div class="card-body table-responsive p-0">
                  <div class="alert clearfix text-right">
                    <a href="<?=base_url("desinator/add");?>" class="btn btn-success"><i class="fa fa-plus"></i>TAMBAH</a>
                  </div>
                <table id="example" class="table table-striped table-valign-middle" style="font-size:12px">
                  <thead>
                  <tr>
                    <th>DESIGNATOR ID</th>
                    <th>DESIGNATOR CODE</th>
                    <th>URAIAN PEKERJAAN</th>
                    <th>Package</th>
                    <th width=50px>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($result as $key => $value) {
                //    print_r($value);
                    ?>
                    <tr>
                        <td><?php print_r($value["designator_id"]); ?></td>
                        <td><?php print_r($value["designator_code"]); ?></td>
                        <td><?php print_r($value["designator_desc"]); ?></td>
                        <td>
                          <?php
                          $variable= $data["datadetail"] = $this->Designator_model->detail($value["designator_id"]);
                          foreach ($variable as $key => $value) {
                           
                            echo $value["package_name"]."Material(".rupiah($value['material_price']).")"."jasa(".rupiah($value['service_price']).")<hr />";
                          } 
                          ?>
                        
                        </td>
                        
                        <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default">Action</button>
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="<?=base_url("desinator/edit/".$value["designator_id"]);?>">EDIT</a>
                              <a class="dropdown-item" href="<?=base_url("desinator/detail/".$value["designator_id"]);?>">Setting Package</a>
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