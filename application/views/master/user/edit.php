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
                <label for="inputName">email</label>
                <input type="email" value="<?=$dataresult->email?>" name="email" id="inputName" class="form-control">
                <input type="hidden" value="<?=$dataresult->userCode?>" name="userCode" id="inputName" class="form-control">
              </div>
                <div class="form-group">
                <label for="inputName">NIK TA</label>
                <input type="text" name="nik_ta" id="inputName" class="form-control"  value="<?=$dataresult->nik_ta?>">
              </div>
                <div class="form-group">
                <label for="inputName">NIK API</label>
                <input type="text" name="nik_api" id="inputName" class="form-control"  value="<?=$dataresult->nik_api?>">
              </div>
              <div class="form-group">
                <label for="inputName">Password</label>
                <input type="password"  value="<?=$dataresult->password?>" name="password" id="passowrd" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputStatus">Status</label>
                <select name="isActive" id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Select one</option>
                  <option value="1" <?=$dataresult->isActive==1?"selected":""?>>Active</option>
                  <option  value="2" <?=$dataresult->isActive==2?"selected":""?>>blocked</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputStatus">Status</label>
                <select name="status" id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Select one</option>
                  <option value="Private" <?=$dataresult->status=="Private"?"selected":""?>>Private</option>
                  <option  value="Public" <?=$dataresult->status=="Public"?"selected":""?>>Public</option>
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
      