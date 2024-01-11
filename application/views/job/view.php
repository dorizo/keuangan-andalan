<div class="col-lg-12">
<div class="card p-2">
              
              <div class="card-body table-responsive p-0">
                  <div class="alert clearfix text-right">
                    <a href="<?=base_url("job/add");?>" class="btn btn-success"><i class="fa fa-plus"></i>TAMBAH</a>
                  </div>
                <table id="example" class="table table-striped table-valign-middle" style="font-size:12px">
                  <thead>
                  <tr>
                    <th>Code Project Status</th>
                    <th>NAMA Project Status</th>
                    <th>Persantasi Project Status</th>
                    <th>Step Project Status</th>
                    <th width=50px>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($result as $key => $value) {
                //    print_r($value);
                    ?>
                    <tr>
                        <td><?php print_r($value["job_id"]); ?></td>
                        <td><?php print_r($value["job_name"]); ?></td>
                        <td><?php print_r($value["job_percent"]); ?>%</td>
                        <td><?php print_r($value["job_day"]); ?></td>
                        <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default">Action</button>
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="<?=base_url("job/edit/".$value["job_id"]);?>">EDIT</a>
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