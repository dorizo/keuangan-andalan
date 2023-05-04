<div class="col-12">
            <div class="card">
            
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form method="get">
                            <div class="row">
                                <div class="col-3">
                                    <input type="date" value="<?=$this->input->get("mulai")?>" name="mulai" class="form-control" />
                                </div>
                                <div class="col-3">
                                    <input type="date"  value="<?=$this->input->get("selesai")?>"  name="selesai" class="form-control" />
                                </div>
                                <div class="col-3">
                                    <select type="date" name="kategori" class="form-control" >
                                        <option value="paid">paid</value>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="submit" value="search" class="btn btn-success" />

                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?=rupiah($row->nilaiproject)?></h3>

                                <p>NILAI BOQ</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?=rupiah($row->mandor)?></h3>

                                <p>NILAI MANDOR/VENDOR</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?=rupiah($row->api)?></h3>

                                <p>NILAI API</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                         
                        </div>
                    </div>


                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?=rupiah($row->totalbungaseluruh)?></h3>

                                <p>NILAI BUNGA </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?=rupiah($row->dibayar)?></h3>

                                <p>NILAI DIBAYAR VENDOR</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?=rupiah($row->PAID_PROJECT-$point)?></h3>

                                <p>NILAI PAID</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                         
                        </div>
                    </div>
                    
                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3> <?=rupiah($bungaakunbank->x)?></h3>

                                <p>NILAI BUNGA BERJALAN NO REK PINJAMAN</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                         
                        </div>
                    </div>
                   
                    
                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3> <?=rupiah($bungaakunbank->x - $row->totalbungaseluruh)?></h3>

                                <p>BEBAN BUNGA  PERUSAHAAN</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                         
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3> <?=rupiah($point)?></h3>

                                <p>OUTSTANDING PAYMENT</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                         
                        </div>
                    </div>
                    <div class="col-12">
                        <table id="example1" class="table table-striped table-valign-middle" style="font-size:12px">
                            <thead>
                            <tr>
                                <th>PROJECT ID</th>
                                <th>PROJECT PAID</th>
                                <th>nilaiproject</th>
                                <th>mandor</th>
                                <th>api</th>
                                <th>totalbungaseluruh</th>
                                <th>dibayar</th>
                                <th>PAID_PROJECT</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataresult as $key => $value) {
                            //    print_r($value);
                                ?>
                                <tr> 
                                    <td><?=$value["project_code"]; ?></td>
                                    <td><?=$value["project_paid"]; ?></td>
                                    <td><?=rupiahtable($value["nilaiproject"]); ?></td>
                                    <td><?=rupiahtable($value["mandor"]); ?></td>
                                    <td><?=rupiahtable($value["api"]); ?></td>
                                    <td><?=rupiahtable($value["totalbungaseluruh"]); ?></td>
                                    <td><?=rupiahtable($value["dibayar"]); ?></td>
                                    <td><?=rupiahtable($value["PAID_PROJECT"]); ?></td>
                                </tr>

                                <?php
                                    # code...
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

             </div>
    </div>
</div>