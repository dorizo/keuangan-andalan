<div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">TABLE <?=$titlepage?></h3> -->
                <a class="btn btn-danger" href="<?=base_url("akunbank/add")?>">Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example2" data-order='[[ 0, "desc" ]]' class="table table-bordered table-hover">
                  <thead>
                    <tr>
                       <th>akunbankID</th>
                      <th>akunbankCode</th>
                      <th>total_akunbank</th>
                      <th>taggal_peminjaman</th>
                      <th>saldo_sekarang</th>
                      <th>bungabank</th>
                      <th>Bank accont</th>
                      <th>MODE</th>
                      <th>edit</th>
                      <th>detail</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($dataresult as $key => $value) {
                    ?>
                    <tr class="odd">
                    
                    <td class="sorting_1"><?=$value["akunbankCode"]?></td>
                      <td class=""><?=$value["akunbankName"]?></td>
                      <td><?=rupiah($value["total_akunbank"])?></td>
                      <td><?=tanggalindo($value["taggal_peminjaman"])?></td>
                      <td><?=rupiah($value["saldo_sekarang"])?></td>
                      <td><?=$value["bungabank"]?></td>
                      <td><?=$value["bank_name"]?></td>
                      <td><a onclick="hapus('<?=base_url('akunbank/delete/'.$value['akunbankCode'])?>')" class="btn btn-success"><i class="fas fa-trash"></i></a></td>
                      <td><a href="<?=base_url('akunbank/cangename/'.$value['akunbankCode'])?>" class="btn btn-success"><i class="fas fa-edit"></i></a></td>
                      <td><a href="<?=base_url('akunbank/record/'.$value['akunbankCode'])?>" class="btn btn-success"><i class="fas fa-arrow-right"></i></a></td>
                    </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 <tfoot>
                    <tr>
                    <th>akunbankID</th>
                      <th>akunbankCode</th>
                      <th>total_akunbank</th>
                      <th>taggal_peminjaman</th>
                      <th>saldo_sekarang</th>
                      <th>bungabank</th>
                      <th>BANK ACCONT</th>
                      <th>MODE</th>
                      <th>edit</th>
                      <th>MODE</th>
                    </tr>
                 </tfoot>
                </table>
               </div>
              <!-- /.card-body -->
            </div>
          </div>
