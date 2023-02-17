
                <div class="col-12">
<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">FORM INPUT</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      
                      
                      <div class="form-group">
                        <label>KETERANGAN</label>
                        
                        <input type="hidden" name="pengajuanCode" class="form-control" value="<?=$pengajuanCode?>" placeholder="">
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
                          <option>Pilih Witel</option>
                        <?php
                            foreach ($witel as $key => $value) {
                              $selected = $value['witel_id']==$resultdata->witel_id?"selected":"";
                                echo "<option value=\"".$value['witel_id']."\" $selected >".$value["witel_name"]."(".$value['region_id'].")</option>";
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
                      
                      <div class="form-group">
                        <label>UPLOAD FILE PENGAJUAN</label>
                      <input type="file" name="file" class="form-control number-separator" placeholder="">
                      </div>
                    </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

</div>