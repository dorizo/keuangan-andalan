<div class="col-lg-12">
<div class="card p-2">
<div class="card">
  <form>
    <div class="row">
      <div class="col-5">
          <input type="date" name="awal" value="<?=$this->input->get("awal")?>" class="form-control form-control-sidebar">
      </div>
      <div class="col-5">
      <input type="date" name="akhir" value="<?=$this->input->get("akhir")?>"  class="form-control form-control-sidebar">
      </div>
      
      <div class="col-2">
      <input type="submit" value="Cari" class="btn btn-success form-control">
      </div>
    
    </div>

  </form>
</div>
              <div class="card-body table-responsive p-0">
                  <div class="alert clearfix text-right">
                    <a href="<?=base_url("mandor/add");?>" class="btn btn-success"><i class="fa fa-plus"></i>TAMBAH</a>
                  </div>
                <table id="example" class="table table-striped table-valign-middle" style="font-size:12px">
                  <thead>
                  <tr>
                    <th>NIP</th>
                    <th>LOG NAME</th>
                    <th>TANGGAL</th>
                    <th>PROJECT CODE</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($dataresult as $key => $value) {
                //    print_r($value);
                    ?>
                    <tr>
                        <td><?php print_r($value["log_projectCode"]); ?></td>
                        <td><?php print_r($value["log_name"]); ?></td>
                        <td><?php print_r($value["log_date"]); ?></td>
                        <td><?php print_r($value["project_code"]); ?></td>
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