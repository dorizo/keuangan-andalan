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
                <label for="inputName">DESIGNATOR CODE</label>
                <input type="text" name="designator_code" id="inputName" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">URAIAN PEKERJAAN</label>
                <input type="text" name="designator_desc" id="inputName" class="form-control">
                <input type="hidden" name="product_id" value="1" class="form-control">
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
      