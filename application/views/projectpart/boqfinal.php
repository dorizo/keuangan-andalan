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
                        <input type="text" disabled name="project_code" value="<?=$dataresult->project_code?>" class="form-control" placeholder="Enter ...">
                       
                        <label>PROJECT NAME</label>
                        <input type="text" disabled name="project_name" value="<?=$dataresult->project_name?>" class="form-control" placeholder="Enter ...">
                        <input type="hidden" name="project_id" value="<?=$dataresult->project_id?>" class="form-control" placeholder="Enter ...">
                     
                        <div class="form-group">
                        <label>Masukan Nilai BOQ FINAL</label>
                        <input type="text" name="boqfinal" value="<?=$dataresult->boqfinal?>" class="boq form-control number-separator" placeholder="Enter ...">
                       
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
    // alert('Changed!')
      $("input[name='nilai_project']").val();
      var persentage = ($(this).val().replace(/,/g, '')*2)/100;
      $("input[name='nilai_project']").val($(this).val().replace(/,/g, '') - persentage);
    });
});

</script>