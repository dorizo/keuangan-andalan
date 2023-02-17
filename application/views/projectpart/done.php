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
                      <input type="hidden" name="project_id" value="<?=$dataresult->project_id?>" class="form-control" placeholder="Enter ...">
                      <label>TANGGAL CASH & BANK PROJECT</label>
                        <input type="date" name="tanggal_cashbank" value="<?=$dataresult->tanggal_cashbank?>" class="form-control" placeholder="Enter ...">
                        
                        <label>TANGGAL DONE PROJECT</label>
                        <input type="date" name="project_paid" value="<?=$dataresult->project_paid?>" class="form-control" placeholder="Enter ...">
                       
                        <div class="form-group">
                          <label>Status Project</label>
                          <select name="project_status" class="custom-select">
                              <option value="PAID">PAID</option>
                          </select>
                          
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

</div>