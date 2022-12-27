
            <div class="card card-primary col-12">
              <div class="card-header">
                <h3 class="card-title">FORM INPUT</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                <div class="form-group">
                    <label>Vendor</label>
                    <select name="vendorCode" class="custom-select">
                        <option value="Pilih Vendor">Pilih Vendor</option>
                        <?php
                        foreach ($vendorresult as $key => $value) {
                            # code...
                            $noted = $value['vendorCode'] == $dataresult->vendorCode ? ' selected="selected"' : '';
                            echo "<option value=\"".$value['vendorCode']."\" ".$noted.">".$value['vendorName']."</option>";
                        }
                        ?>
                
                    </select>
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Project Code</label>
                    <input type="text" name="project_code" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Project Name</label>
                    <input type="text" name="project_name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Estimasi Mulai</label>
                    <input type="date" name="project_start" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Estimasi Selesai</label>
                    <input type="date" name="project_done" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kategori Project</label>  
                        <select name="cat_id" class="custom-select">
                        <?php
                            foreach ($kategori as $key => $value) {
                                echo "<option value=\"".$value['cat_id']."\">".$value["cat_name"]."</option>";
                            }
                            ?>
                    
                        </select>
                 </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Project Mulai</label>
                    <input type="date" name="project_date" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Catatan</label>
                    <input type="text" name="project_note" class="form-control">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
