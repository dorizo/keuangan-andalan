<div class="col-lg-12">
<div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Status Project </h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Project</th>
                    <th>Estimasi Project Selesai</th>
                    <th>Kewajiban Bunga</th>
                    <th>Project Status</th>
                    <th>Detail</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($dataresult as $key => $value) {
                      $now = time(); // or your date as well
                      $your_date = strtotime($value["project_done"]);
                      $datediff = $your_date - $now;
                    ?>
                  <tr>
                    <td>
                      <?=$value["cat_name"]?><br />
                      <?=$value["project_code"]?>
                    </td>
                    <td>
                      tgl estimasi : <?=$value["project_done"]?><br />
                      tgl berjalan : <?=round($datediff / (60 * 60 * 24));?>
                    </td>
                    <td>
                      Nilai Project : <?=rupiah($value["nilai_project"])?><br />
                      
                    </td>
                    <td><?=$value["project_status"]?></td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <?php
                     # code...
                    }
                  ?>
                  <!-- <tr>
                    <td>
                      <img src="<?=base_url()?>asset/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Another Product
                    </td>
                    <td>$29 USD</td>
                    <td>
                      <small class="text-warning mr-1">
                        <i class="fas fa-arrow-down"></i>
                        0.5%
                      </small>
                      123,234 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="<?=base_url()?>asset/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Amazing Product
                    </td>
                    <td>$1,230 USD</td>
                    <td>
                      <small class="text-danger mr-1">
                        <i class="fas fa-arrow-down"></i>
                        3%
                      </small>
                      198 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="<?=base_url()?>asset/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Perfect Item
                      <span class="badge bg-danger">NEW</span>
                    </td>
                    <td>$199 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        63%
                      </small>
                      87 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
</div>