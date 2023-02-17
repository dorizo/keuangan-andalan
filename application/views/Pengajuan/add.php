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
                        <input type="hidden" name="statusPengajuan"  value="<?=$pengajuanproses?>" class="form-control" placeholder="">
                        <input type="text" name="transaksiNote" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>TANGGAL PENGAJUAN</label>
                      <input type="date" name="transaksiDate" class="form-control" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>JUMLAH PENGAJUAN</label>
                      <input type="text" name="transaksiJumlah" class="form-control number-separator" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>pengajuanstatus</label>    
                        <select name="pengajuanstatusCode" class="custom-select">
                        <?php
                            foreach ($pengajuanstatus as $key => $value) {
                                echo "<option value=\"".$value['pengajuanstatusCode']."\">".$value["pengajuanstatusName"]."</option>";
                            }
                            ?>
                    
                        </select>
                      </div>
                      <input type="hidden" name="statusTransaksi" value="PENDING">
                      
                      <div class="form-group">
                        <label>UPLOAD FILE PENGAJUAN</label>
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