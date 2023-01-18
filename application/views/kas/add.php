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
                        <label>transaksiNote</label>
                        <input type="text" name="transaksiNote" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>TANGGAL</label>
                      <input type="date" name="transaksiDate" class="form-control" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>JUMLAH</label>
                      <input type="text" name="transaksiJumlah" class="form-control number-separator" placeholder="">
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
                        <label>Status</label>    
                        <select name="status" class="custom-select">
                            <option value="Cash Out">Cash Out</option>
                            <option value="Cash IN">Cash IN</option>
                        </select>
                      </div>
                      <div>
                      <input type="hidden" name="statusTransaksi" value="PENDING">
                      
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