<div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr> 
                      <th>kode Pengajuan</th>
                      <th>tanggal</th>
                      <th>kategori</th>
                      <th>keterangan</th>
                      <th>Jumlah Pengajuan</th>
                      <th>Dikirim Oleh</th>
                      <th>witel</th>
                      <th>sto</th>
                      <th>pekerjaan</th>
                      <th>Status</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($datatable as $key => $value) { 
                    ?>
                    <tr class="odd">
                      <td class="sorting_1 dtr-control"><?=$value["orCode"]?></td>
                      <td><?=$value["tanggal"]?></td>
                      <td><?=$value["kategori"]?></td>
                      <td><?=$value["keterangan"]?></td>
                      <td><?=rupiah($value["kredit"])?></td>
                      <td><?=$value["diterimaoleh"]?></td>
                      <td><?=$value["witelhoName"]?></td>
                      <td><?=$value["stoName"]?></td>
                      <td><?=$value["pekerjaanName"]?></td>
                      <td><?=$value["kategoriakutansi"]?><a target="_BLANK" href="<?=base_url('pembayaran/'.$value['bukti'])?>"> <i class="fa fa-download"></i></a> </td>
                      <td width="120px">
                      <a  onclick="fungsidelete(<?=$value['orCode']?>)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      <a href="<?=base_url("/akutansi/oprasional/pengajuan/".$value["orCode"])?>" class="btn btn-success"><i class="fas fa-arrow-right"></i></a>
                      </td>
                    </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 <tfoot>
                    <tr>
                  
                    <th>kode Pengajuan</th>
                      <th>tanggal</th>
                      <th>kategori</th>
                      <th>keterangan</th>
                      <th>Jumlah Pengajuan</th>
                      <th>Dikirim Oleh</th>
                      <th>witel</th>
                      <th>sto</th>
                      <th>pekerjaan</th>
                      <th>Status</th>
                      <th>ACTION</th>
                    </tr>
                 </tfoot>
                </table>
               </div>
              <!-- /.card-body -->
            </div>
          </div>

          <script>

            function fungsidelete(xx){
                Swal.fire({
                    title: "APAKAH ANDA YAKIN INGIN REJECT PENGAJUAN INI?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Ya",
                    denyButtonText: `Tidak`
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href="<?=base_url("akutansi/oprasional/reject/")?>"+xx

                    } else if (result.isDenied) {
                        Swal.fire("Cancel Proses", "", "info");
                    }
                    });
            }
          </script>