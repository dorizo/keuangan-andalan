<div class="col-lg-12">
        <div class="card card-primary">
            <form method="post">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Code WITEL</label>
                <input type="hidden"  name="witel_id" id="inputName" value="<?=$dataresult->witel_id?>" class="form-control">
                <input type="text" name="witel_code" id="inputName" value="<?=$dataresult->witel_code?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">NAMA WITEL</label>
                <input type="text" name="witel_name" value="<?=$dataresult->witel_name?>" id="inputName" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputStatus">Status</label>
                <select name="package_id" id="inputStatus" class="form-control custom-select">
                 <?php  
                 foreach ($result as $key => $value) {
                  $selectedd = "";
                  $selectedd = $dataresult->package_id==$value["package_id"]?"selected":"";
                  ?>
                  
                  # code...
                  <option <?=$selectedd?> value="<?=$value["package_id"]?>"><?=$value["package_name"]?></option>
                  <?php
                 }
                 ?>
                </select>
              </div>
              <!-- <div class="form-group">
                <label for="inputDescription">Project Description</label>
                <textarea id="inputDescription" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Client Company</label>
                <input type="text" id="inputClientCompany" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Project Leader</label>
                <input type="text" id="inputProjectLeader" class="form-control">
              </div> -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <a href="<?=base_url("master/user")?>" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create new Project" class="btn btn-success float-right">
            </div>
            </form>
       </div>
          <!-- /.card -->
      