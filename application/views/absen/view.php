<div class="col-lg-12">
<div class="card p-2">
              
              <div class="card-body table-responsive p-0">
                  <div class="alert clearfix text-right">
                    <a href="<?=base_url("mandor/add");?>" class="btn btn-success"><i class="fa fa-plus"></i>TAMBAH</a>
                  </div>
                <table id="example" class="table table-striped table-valign-middle" style="font-size:12px">
                  <thead>
                  <tr>
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th>POSISI</th>
                    <th>Status Absen</th>
                    <th>TANGGAL</th>
                    <th>Foto</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($dataresult as $key => $value) {
                //    print_r($value);
                    ?>
                    <tr>
                        <td><?php print_r($value["karyawanNip"]); ?></td>
                        <td><?php print_r($value["karyawanNama"]); ?></td>
                        <td><?php print_r($value["username"])?></td>
                        <td><?php print_r($value["akses"])?></td>
                        <td><?php print_r($value["posisi"])?></td>
                        <td><?php print_r($value["create_at"])?></td>
                        <td><a target="_BLANK" href="<?="https://karyawan.ciptateknologimuda.com/uploads/absen/".$value["image"]?>">Download</td>
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