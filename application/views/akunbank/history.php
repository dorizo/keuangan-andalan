<div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">TABLE <?=$titlepage?></h3> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>akunbank_transaksiCode</th>
                      <th>Akun Akitansi</th>
                      <th>transaksiNote</th>
                      <th>project Code</th>
                      <th>transaksiDate</th>
                      <th>transaksiJumlah</th>
                      <th>akunBankCode</th>
                      <th>statusTransaksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($datatable as $key => $value) { 
                    ?>
                    <tr class="odd">
                      <td class="sorting_1 dtr-control"><?=$value["akunbank_transaksiCode"]?></td>
                      <td><?=$value["AkunAkutansiName"]?></td>
                      <td><?=$value["transaksiNote"]?></td>
                      <td><?=$value["project_code"]?></td>
                      
                      <td><?=$value["transaksiDate"]?></td>
                      <td><?=rupiah($value["transaksiJumlah"])?></td>
                      <td><?=$value["akunBankCode"]?></td>
                      <td><?=$value["statusTransaksi"]?><a target="_BLANK" href="<?=base_url('pembayaran/'.$value['upload_file'])?>"> <i class="fa fa-download"></i></a> </td>
                    </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 <tfoot>
                    <tr>
                    <th>akunbank_transaksiCode</th>
                      <th>Akun Akitansi</th>
                      <th>transaksiNote</th>
                      <th>project Code</th>
                      <th>transaksiDate</th>
                      <th>transaksiJumlah</th>
                      <th>akunBankCode</th>
                      <th>statusTransaksi</th>
                    </tr>
                 </tfoot>
                </table>
               </div>
              <!-- /.card-body -->
            </div>
          </div>