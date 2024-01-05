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
                        <label>Masukan Nilai Kontrak Project</label>
                        <input type="hidden" name="akunbankCode" value="<?=$dataresult->akunbankCode?>" class="form-control" placeholder="Enter ...">
                        <input type="text" name="bank_name" value="<?=$dataresult->bank_name?>" class="form-control" placeholder="Enter ...">
                        <div class="col-sm-12">
                      <!-- select -->
                    </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

</div>