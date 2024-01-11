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
                <label for="inputName">Package Name</label>
                <input type="text" name="package_name" id="inputName" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Package Desc</label>
                <input type="text" name="package_desc" id="inputName" class="form-control">
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <a href="<?=base_url("package")?>" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create new Project" class="btn btn-success float-right">
            </div>
            </form>
       </div>
          <!-- /.card -->
      