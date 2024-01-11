<div class="col-lg-12">
  <?php print_r($result)?>
        <div class="card card-primary">
            <form method="post">
            <div class="card-header">
              <h3 class="card-title">Edit</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Parent name</label>
                
                <input type="hidden" name="cat_id" value="<?=$result->cat_id;?>" class="form-control">
                <input type="text" name="cat_name"  value="<?=$result->cat_name;?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Parent struktur</label>
                <input type="text" name="cat_parent"  value="<?=$result->cat_parent;?>" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="inputName">Parent struktur</label>
                <select type="text" name="parentcatCode"   class="form-control">

                <?php foreach ($dataresult as $key => $valuex) {
                  // print_r($valuex);
                  # code...
                  $sss = "";
                  $sss = $result->parentcatCode==$valuex["parentcatCode"]?"selected":"";
                  // echo $result->parentcatCode."===========".$valuex["parentcatCode"]."===".$sss;
                  echo "<option ".$sss." value='".$valuex['parentcatCode']."' >".$valuex['parentcatName']."</option>";
                }
                ?>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <a href="<?=base_url("master/user")?>" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create new Project" class="btn btn-success float-right">
            </div>
            </form>
       </div>
          <!-- /.card -->
      