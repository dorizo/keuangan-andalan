s<div class="col-12">
<div class="card card-warning">
    <table class="table">
        <thead>
            <tr>
            <th>BOQ LAMA</th>
            <th>BOQ BOQ BARU</th>
            <th>STATUS</th>
            <th>AKSES</th>
            <tr>
        </thead>
        <tbody>
            
        <?php 
        foreach ($dataall as $key => $value) {
            ?>
            <tr>
                <td><?=rupiah($value->nilaiboq)?></td>
                <td><?=rupiah($value->nilaiboqbaru)?></td>
                <td><?=$value->status?></td>
                <td><?=!empty(roleuser("KEUW"))?"<a class='btn btn-success' href='".base_url("perubahanboq/final/".$value->requstboq_id)."'>approve</a>":"NOT ACCESS APPROVE";?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
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
                        <label>Nilai BOQ Sekarang</label><br />
                        <b><?=rupiah($dataresult->nilai_boq)?></b>
                        <input type="hidden"  name="nilaiboq" value="<?=$dataresult->nilai_boq?>" class="boq form-control number-separator" placeholder="Enter ...">
                       
                        </div>
                        <div class="form-group">
                        <label>Masukan Nilai BOQ FINAL</label>
                        <input type="text" name="nilaiboqbaru" class="boq form-control number-separator" placeholder="Enter ...">
                       
                        </div>
                        <div class="form-group">
                        <label>Status</label>
                        <select disabled name="nilaiboqbaru" class="boq form-control number-separator">
                            <option value="proses">proses</option>
                            <option value="approve">approve</option>
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
    // alert('Changed!')
      $("input[name='nilai_project']").val();
      var persentage = ($(this).val().replace(/,/g, '')*2)/100;
      $("input[name='nilai_project']").val($(this).val().replace(/,/g, '') - persentage);
    });
});

</script>


