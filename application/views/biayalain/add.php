<table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>KODE PENGAJUAN</th>
                      <th>PENGAJUAN NOTE</th>
                      <th>TANGGAL PENGAJUAN</th>
                      <th>JUMLAH TRANSAKSI</th>
                      <th>STATUS</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($pengajuan as $key => $value) { 
                      if($value["pengajuanstatusCode"]==2){

                    ?>
                    <tr class="odd">
                      <td class="sorting_1 dtr-control"><?=$value["akunbank_pengajuanCode"]?></td>
                      <td><?=$value["transaksiNote"]?></td>
                      <td><?=$value["transaksiDate"]?></td>
                      <td><?=rupiah($value["transaksiJumlah"])?></td>
                      <td><?=$value["statusTransaksi"]?><a target="_BLANK" href="<?=base_url('pembayaran/'.$value['upload_file'])?>">   <i class="fa fa-download"></i></a> </td>
                      <td>
                        <?php
                        if($value["statusTransaksi"] == "PENDING"){
                        ?>
                        <a href="<?=base_url('biayalain/add/'.$value['akunbank_pengajuanCode'])?>" class="btn btn-success">Proses <i class="fa fa-arrow-right"></i></a></td>
                        <?php
                          }
                          ?>
                      </tr>
                  <?php
                  }
                     }
                     if($pengajuanCode == 0){
                      return;
                     }
                  ?>

                </tbody>
                 <!-- <tfoot>
                    <tr>
                      <th>akunbank_pengajuanCode</th>
                      <th>PENGAJUAN NOTE</th>
                      <th>TANGGAL PENGAJUAN</th>
                      <th>JUMLAH TRANSAKSI</th>
                      <th>STATUS</th>
                      <th>ACTION</th>
                    </tr>
                 </tfoot> -->
                </table>
                <div class="col-12">
<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">FORM INPUT</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post">
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      
                      
                      <div class="form-group">
                        <label>KETERANGAN</label>
                      <input type="text" name="keterangan" class="form-control" value="<?=$resultdata->transaksiNote?>" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>Biaya</label>
                        <input type="text" name="biayalain" value="<?=$resultdata->transaksiJumlah?>" class="form-control number-separator">
                      </div>
                      <div class="form-group">
                        <label>akunBankCode</label>    
                        <select name="akunBankCode" class="custom-select">
                        <?php
                            foreach ($akunbank as $key => $value) {
                                echo "<option value=\"".$value['akunbankCode']."\">".$value["akunbankName"]."(".$value['saldo_sekarang'].")</option>";
                            }
                            ?>
                    
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Akun Akutansi</label>    
                        <select name="AkunAkuntansiCode" class="custom-select">
                        <?php
                            foreach ($akunakutansi as $key => $value) {
                                echo "<option value=\"".$value['AkunAkuntansiCode']."\">".$value["AkunAkutansiName"]."(".$value['AkunAkutansiCodeName'].")</option>";
                            }
                            ?>
                    
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Witel Model</label>    
                        <select name="witel_id" class="custom-select">
                        <?php
                            foreach ($witel as $key => $value) {
                                echo "<option value=\"".$value['witel_id']."\">".$value["witel_name"]."(".$value['region_id'].")</option>";
                            }
                            ?>
                    
                        </select>
                      </div>
                      
                      <!-- <div class="form-group">
                        <label>Name</label>
                      <input type="text" name="vendorName" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="vendorAlamat" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>phone</label>
                        <input type="text" name="vendorPhone" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>email</label>
                        <input type="text" name="vendorEmail" class="form-control" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>username</label>
                        <input type="text" name="username" class="form-control" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>pasword</label>
                        <input type="password" name="password" class="form-control" placeholder="">
                      </div> -->
                    </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

</div>