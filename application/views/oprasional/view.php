<div class="col-lg-12">
<div class="card p-2">
                <div class="alert clearfix text-right">
                    <a href="<?=base_url("akutansi/oprasional/add");?>" class="btn btn-success"><i class="fa fa-plus"></i>TAMBAH</a>
              </div>
              
              <div class="card-body p-0" style="overflow-x: auto;">
                 
                <table  style="width:2000px" class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Bulan</th>
                    <th>Kode Project</th>
                    <th>Nama Akun</th>
                    <th>Kode Akun</th>
                    <th>Akun</th>
                    <th>kategori</th>
                    <th>witel</th>
                    <th>sto</th>
                    <th>regional</th>
                    <th>pekerjaan</th>
                    <th>Keterangan</th>
                    <th>debit</th>
                    <th>kredit</th>
                    <th>diterima oleh</th>
                    <th>dikirim oleh</th>
                    <th>mandor</th>
                    <th width=50px>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($result as $key => $value) {
                //    print_r($value);
                    ?>
                    <tr>
                        <td><?php print_r($value["tanggal"]); ?></td>
                        <td><?php print_r($value["kode_project"]); ?></td>
                        <td><?php print_r($value["kode_project"]); ?></td>
                        <td><?php print_r($value["nama_akun"]); ?></td>
                        <td><?php print_r($value["kode_akun"]); ?></td>
                        <td><?php print_r($value["nama_akun"]); ?></td>
                        <td><?php print_r($value["kategori"]); ?></td>
                        <td><?php print_r($value["witel_name"]); ?></td>
                        <td><?php print_r($value["stoName"]); ?></td>
                        <td><?php print_r($value["regional_id"]); ?></td>
                        <td><?php print_r($value["pekerjaanName"]); ?></td>
                        <td><?php print_r($value["keterangan"]); ?></td>
                        <td><?php print_r($value["debit"]); ?></td>
                        <td><?php print_r($value["kredit"]); ?></td>
                        <td><?php print_r($value["diterimaoleh"]); ?></td>
                        <td><?php print_r($value["dikirimoleh"]); ?></td>
                        <td><?php print_r($value["mandor"]); ?></td>
                        <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default">Action</button>
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="<?=base_url("akutansi/akun/edit/".$value["ID"]);?>">EDIT</a>
                              <a class="dropdown-item" onclick="hapus('<?=base_url("akunakutansi/delete/".$value['ID']);?>')">DELETE</a>
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