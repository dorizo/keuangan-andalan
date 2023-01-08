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
                      <label>PROJECT CODE</label>
                      <input type="hidden" name="project_id" value="<?=$dataresult->project_id?>" class="form-control" placeholder="Enter ...">
                   
                        <input type="text" disabled name="project_code" value="<?=$dataresult->project_code?>" class="boq form-control" placeholder="Enter ...">
                       
                        <label>PROJECT NAME</label>
                        <input type="text" name="project_name" value="<?=$dataresult->project_name?>" class="boq form-control" placeholder="Enter ...">
                       
                        <!-- <label>Masukan Nilai Kontrak BOQ</label>
                        <input type="text" name="nilai_boq" value="<?=$dataresult->nilai_boq?>" class="boq form-control number-separator" placeholder="Enter ...">
                        <label>Masukan Nilai SIUJK</label>
                        <input type="text" name="nilai_project" value="<?=$dataresult->nilai_project?>" class="form-control number-separator" placeholder="Enter ...">
                        <label>Sharing Vendor (%)</label>
                        <input type="number" name="sharing_vendor" value="<?=$dataresult->sharing_vendor?>" class="form-control number-separator" placeholder="Enter ...">
                        <label>Sharing Owner (%)</label>
                        <input type="number" name="sharing_owner" value="<?=$dataresult->sharing_owner?>" class="form-control number-separator" placeholder="Enter ..."> -->
                       
                        <!-- <div class="form-group">
                          <label>Vendor</label>
                          <select name="vendorCode" class="custom-select">
                              <option value="Pilih Vendor">Pilih Vendor</option>
                              <?php
                              foreach ($vendorresult as $key => $value) {
                                  # code...
                                  $noted = $value['vendorCode'] == $dataresult->vendorCode ? ' selected="selected"' : '';
                                  echo "<option value=\"".$value['vendorCode']."\" ".$noted.">".$value['vendorName']."</option>";
                              }
                              ?>
                      
                          </select>
                          
                        </div> -->

                        
                        <div class="form-group">
                          <label>witel</label>
                          <select name="witel_id" class="custom-select">
                              <option value="Pilih Vendor">Pilih witel</option>
                              <?php
                              foreach ($witelresult as $key => $value) {
                                  # code...
                                  $noted = $value['witel_id'] == $dataresult->witel_id ? ' selected="selected"' : '';
                                  echo "<option value=\"".$value['witel_id']."\" ".$noted.">".$value['witel_name']."</option>";
                              }
                              ?>
                      
                          </select>
                          
                        </div>
                        <div class="form-group">
                    <label for="exampleInputEmail1">Estimasi Mulai</label>
                    <input type="date" name="project_start" value="<?=$dataresult->project_start?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Estimasi Selesai</label>
                    <input type="date" name="project_done"  value="<?=$dataresult->project_done?>"  class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kategori Project</label>  
                        <select name="cat_id" class="custom-select">
                        <?php
                            foreach ($kategori as $key => $value) {
                                
                                  # code...
                                  $noted = $value['cat_id'] == $dataresult->cat_id ? ' selected="selected"' : '';
                                echo "<option value=\"".$value['cat_id']."\" $noted>".$value["cat_name"]."</option>";
                            }
                            ?>
                    
                        </select>
                 </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Project Mulai</label>
                    <input type="date" name="project_date"  value="<?=$dataresult->project_date?>"  class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Catatan</label>
                    <input type="text" name="project_note"  value="<?=$dataresult->project_note?>"  class="form-control">
                  </div>
                </div>
                        <!-- <div class="form-group">
                          <label>Status Project</label>
                          <select name="project_status" class="custom-select">
                              <option value="<?=$dataresult->project_status?>"><?=$dataresult->project_status?></option>
                              <?php
                              foreach ($datajob as $key => $value) {
                                  # code...
                                  echo "<option value=\"".$value['job_name']."\">".$value['job_name']."</option>";
                              }
                              ?>
                      
                          </select>
                          
                        </div> -->
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
    // alert('Changed!')
      $("input[name='nilai_project']").val();
      var persentage = ($(this).val().replace(/,/g, '')*2)/100;
      $("input[name='nilai_project']").val($(this).val().replace(/,/g, '') - persentage);
    });
});

</script>