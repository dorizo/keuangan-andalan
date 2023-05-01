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
                        <label>JUMLAH BOQ</label>
                        <input type="text" name="nilai_project" value="<?=rupiah($dataresult->nilai_project)?>" class="form-control" disabled>
                       
                        <label>JUMLAH TERBAYARKAN</label>
                        <input type="text" name="nilai_project_paid" value="<?=$dataresult->nilai_project_paid?>" class="boq form-control  number-separator" placeholder="Enter ...">
                       
                        <label>STATUS PEMBAYARAN</label>
                        <select name="status_paid" class="custom-select">
                              <option value="<?=$dataresult->status_paid?>"><?=$dataresult->status_paid?></option>
                              <option value="OUTSTENDING">OUTSTANDING</option>
                              <option value="LUNAS">LUNAS</option>
                          </select>
                           
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
<script>
  $( document ).ready(function() {
     $('input.boq').on('input',function(e){
    });
});

</script>