<div class="col-12">
<div class="card card-warning"><table id="example2" class="table table-bordered table-hover">
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
                      if($value["pengajuanstatusCode"]==1){
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
                        <a href="<?=base_url('transaksi/add/'.$value['project_id'].'/'.$value['akunbank_pengajuanCode'])?>" class="btn btn-success">Proses <i class="fa fa-arrow-right"></i></a></td>
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
              <div class="card-header">
                <h3 class="card-title">FORM INPUT DENGAN KODE PENGAJUAN (<?=$pengajuanCode?>)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>transaksiNote</label>
                        <input type="hidden" name="akunbank_pengajuanCode" class="form-control" value="<?=$resultdata->akunbank_pengajuanCode?>">
                        <input type="text" name="transaksiNote" class="form-control" value="<?=$resultdata->transaksiNote?>">
                      </div>
                      
                      <div class="form-group">
                        <label>transaksiDate</label>
                      <input type="date" name="transaksiDate" class="form-control" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>transaksiJumlah</label>
                      <input type="text" name="transaksiJumlah" class="form-control number-separator"  value="<?=$resultdata->transaksiJumlah?>">
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
                        <label>statusTransaksi</label>
                        
                        <select name="statusTransaksi" class="custom-select">
                          <option value="CR">CREDIT</option>
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label>UPLOAD FILE TRANSAKSI</label>
                      <input type="file" name="file" class="form-control number-separator" placeholder="">
                      </div>
                      
                        <input type="hidden" name="project_id" class="form-control" value="<?=$project_id?>">
                    
                    </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

</div>