<div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">TABLE <?=$titlepage?></h3> -->
                <a class="btn btn-danger" href="<?=base_url("suratpesanan/add")?>">Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>NO CODE</th>
                      <th>NO SURAT PESANAN</th>
                      <th>NILAI SURAT PESANAN</th>
                      <th>witel_id</th>
                      <th>MODE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($dataresult as $key => $value) { 
                    ?>
                    <tr class="odd">
                      <td class="sorting_1 dtr-control"><?=$value["suratpesananCode"]?></td>
                      <td><?=$value["NoSuratpesanan"]?></td>
                      <td><?=$value["nilaiSuratpesanan"]?></td>
                      <td><?=$value["witel_id"]?></td>
                      <td width=120px>
                        <a onclick="hapus('<?=base_url('suratpesanan/delete/'.$value['suratpesananCode'])?>')" class="btn btn-success"><i class="fas fa-trash"></i></a>
                        <a href="<?=base_url('suratpesanan/detail/'.$value['suratpesananCode'])?>" class="btn btn-success"><i class="fas fa-eye"></i></a>
                      </td>
                      </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 <tfoot>
                    <tr>
                    
                    <th>CODE</th>
                      <th>keterangan</th>
                      <th>biayalain</th>
                      <th>witel_id</th>
                      <th>MODE</th>
                    </tr>
                 </tfoot>
                </table>
               </div>
              <!-- /.card-body -->
            </div>
          </div>