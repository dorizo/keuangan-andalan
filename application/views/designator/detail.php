<div class="col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
              <h3 class="card-title"><?=$designator->designator_code?> ( <?=$designator->designator_desc?> )</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
            <form  method="post" role="form" enctype="multipart/form-data">
              
                <div class="form-group">
                  <?php ?>
                  <label>package </label>
                  <input type="hidden" name="designator_id" value="<?= $designator->designator_id ?>">
                  <select class="permission select2bs4" data-placeholder="Select a role" name="package_id" style="width: 100%;" required="required">
                    <?php
                    if(!empty($permission)){
                      foreach($permission as $value){
                        echo "<option value='$value->package_id' select>$value->package_name</option>";
                      }}
                      ?>
                  </select>
                  <br />
                  <b>material price</b>
                  <input type="text" name="material_price" class="form-control number-separator" />
                  <br />
                  <b>service price</b>
                  <input type="text" name="service_price" class="form-control number-separator" />
                  <button type="submit" class="btn btn-primary mt-1">
                    <i class="fas fa-plus"></i> Add data 
                  </button>
                </div>


            </form>
            

        </div>
        <div class="card-body" >
          <table class="table">
            <thead>
              <tr>
                <td>package</td>
                <td>package_desc</td>
                <td>material_price</td>
                <td>service_price</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
         <?php foreach($datadetail as $value){ ?>
          <tr>
                <td><?=$value["package_name"]?></td>
                <td><?=$value["package_desc"]?></td>
                <td><?=rupiah($value["material_price"])?></td>
                <td><?=rupiah($value["service_price"])?></td>
                <td><a class="btn btn-success" href="<?=base_url("desinator/editpaket/").$designator->designator_id."/".$value["designator_package_id"]?>">Rubah</a></td>
              </tr>
          <?php } ?>
         </tbody>
         </table>


         
            <!-- div class="col-lg-6">
              <div >
                
                <button type="reset" class="btn btn-warning col cancel">
                  <i class="fas fa-times-circle"></i>
                  <span>Cancel upload</span>
                </button>
              </div>
            </div> -->
          
        </div>
</div>
</div>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2(
    {
       
                });


      

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
  
</script>

