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
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">NAMA PROJECT STATUS</label>
                <input type="hidden" name="job_id" id="inputName" class="form-control"  value="<?=$dataresult->job_id?>">
                <input type="hidden" name="job_nameold" id="inputName" class="form-control"  value="<?=$dataresult->job_name?>">
                <input type="text" name="job_name" id="inputName" class="form-control"  value="<?=$dataresult->job_name?>">
              </div>
              <div class="form-group">
                <label for="inputName"> PERSENTASI PEKERJAAN  PROJECT STATUS</label>
                <input type="number" name="job_percent" id="inputName" class="form-control"  value="<?=$dataresult->job_percent?>">
              </div>
              <div class="form-group">
                <label for="inputName">STEP PROJECT STATUS</label>
                <input type="number" name="job_day" id="inputName" class="form-control"  value="<?=$dataresult->job_day?>">
              </div>
             
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <a href="<?=base_url("job")?>" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create new Project" class="btn btn-success float-right">
            </div>
            </form>
       </div>
          <!-- /.card -->
        <div class="alert alert-danger">Peringatan (Setiap Anda Merubah Status Project akan berpengaruh kesetiap project jadi mohon konsiltasi terlebih dahulu) </div>

        <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>PROJECT CODE</th>
                      <th>PROJECT NAME</th>
                      <th>PROJECT STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($project as $key => $value) { 
                       ?>
                    <tr class="odd">
                      <td class="sorting_1 dtr-control"><?=$value["project_id"]?></td>
                      <td><?=$value["project_code"]?></td>
                      <td><?=$value["project_name"]?></td>
                     <td><?=$value["project_status"]?></td>
                    </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 
                </table>
      