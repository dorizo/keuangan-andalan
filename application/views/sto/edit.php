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
                <label for="inputName">CODE STO</label>
                <input type="text" readonly name="stoCode" id="inputName" value="<?=$dataresult->stoCode?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">NAMA STO</label>
                <input type="text"  name="stoName" id="inputName" value="<?=$dataresult->stoName?>" class="form-control">
               </div>
              <!-- <div class="form-group">
                <label for="inputStatus">Status</label>
                <select name="status" id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Select one</option>
                  <option value="Private">Private</option>
                  <option  value="Public">Public</option>
                </select>
              </div> -->
              
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
      