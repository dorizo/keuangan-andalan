
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.3/xlsx.full.min.js"></script>
<div class="col-12">
    <div class="card">
        <div class="card-body">
        <form method="get" id="form-search">
            <div class="row">
                <div class="col-5"><input type="date" class="form-control" value="<?=$this->input->get("mulai")?>" name="mulai" /></div>
                <div class="col-5"><input type="date" class="form-control"  value="<?=$this->input->get("selesai")?>"  name="selesai" /></div>
                <div class="col-2"><button type="submit" class="btn btn-success" ><i class="fa fa-search"></i></button></div>
          
            </div>  
        </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
        <h5 class="description-header"><?=rupiah($nilaiboq->nilai)?></h5>
        <span class="description-text">Project Masuk</span>
        <div class="description-text"><a href="">Detail <i class="fa fa-arrow-right"></i></a></div>
        </div>

        </div>

        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
        <h5 class="description-header"><?=rupiah(($nilaikeluar->nilai+$oprasional->nilai))?></h5>
        <div class="row">
            <div class="col-6">
            <p class="h6"><?=rupiah($oprasional->nilai)?></p>
             <span class="description-text">Pengeluaran HO</span>
            </div>
            <div class="col-6"> 
                <p class="h6"><?=rupiah($nilaikeluar->nilai)?></p>
                <span class="description-text">Pengeluaran Project</span>
            </div>
            
            <button onclick="excel()"  id="exportbtn" class="btn btn-success"><i class="fa fa-print"></i> Export</button>
        </div>

        </div>

        </div>

        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
        <h5 class="description-header"><?=rupiah($projectcash->nilai)?></h5>
        <span class="description-text">CASH & BANK</span>
        </div>

        </div>
        
        <div class="col-sm-3 col-6">
        <div class="description-block border-right">
        <h5 class="description-header"><?=rupiah($projectpaid->nilai)?></h5>
        <span class="description-text">PROJECT PAID</span>
        </div>

        </div>

    </div>
    <div class="card">
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Bulan</th>
                    <th>Kode Project</th>
                    <th>Nama Akun</th>
                    <th>Kode Akun</th>
                    <th>Akun</th>
                    <th>kategori</th>
                    <th>witel</th>
                    <th>Regional</th>
                    <th>Pekerjaan</th>
                    <th>Keterangan</th>
                    <th>debit</th>
                    <th>Kredit</th>
                    <th>Mandor</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($tabledata as $key => $value) {?>
                <tr>
                   <td><?=$value["transaksiDate"]?></td>
                   <td><?=$value["bulan"]?></td>
                   <td><?=$value["project_code"]?></td>
                   <td><?=$value["AkunAkutansiName"]?></td>
                   <td><?=$value["AkunAkutansiCodeName"]?></td>
                   <td><?=$value["akun"]?></td>
                   <td><?=$value["kategori"]?></td>
                   <td><?=$value["witel_name"]?></td>
                   <td><?=$value["region_name"]?></td>
                   <td><?=$value["cat_name"]?></td>
                   <td><?=$value["transaksiNote"]?></td>
                   <td><?=rupiah($value["debit"])?></td>
                   <td><?=rupiah($value["kredit"])?></td>
                   <td><?=$value["vendorName"]?></td>
                   </tr>
                <?php
                }
                ?>
            </tbody>
            
        </table>
        </div>
    </div>
</div>
<script>
function excel(){
          var m =  $('#form-search').serializeArray();
          var $thisbtn = $("#exportbtn");
          $thisbtn.prop("disabled", true);
          $($thisbtn).html(
              `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
          );
          $.ajax({
              url: "<?=base_url("reportkeuangan/export?mulai=")?>"+m[0].value+"&selesai="+m[1].value,
              type: "post",
              dataType: "json",
              data: m,
              success: function(data) {

                let Heading = [
                    ['Tanggal', 'Bulan', 'Kode Project', 'Nama Akun', 'Kode Akun', 'Akun', 'kategori', 'witel', 'sto', 'regional', 'pekerjaan', 'Keterangan', 'debit', 'kredit', 'diterima oleh', 'dikirim oleh', 'mandor']
                ];
                var myFile = "Report_PENYELESAIAN_" + Date.now() + ".xlsx";
                var myWorkSheet = XLSX.utils.json_to_sheet(data);
                XLSX.utils.sheet_add_aoa(myWorkSheet, Heading, {
                    origin: 0
                });
                myWorkSheet['!cols'] = [{
                    width: 20
                }, {
                    width: 10
                }, {
                    width: 30
                }, {
                    width: 30
                }, {
                    width: 30
                }, {
                    width: 50
                }, {
                    width: 20
                }, {
                    width: 20
                }, {
                    width: 20
                }, {
                    width: 20
                }, {
                    width: 20
                }, {
                    width: 40
                }, {
                    width: 20
                }, {
                    width: 20
                }, {
                    width: 20
                }, {
                    width: 20
                }, {
                    width: 20
                }];
                // var merges = myWorkSheet['!merges'] = [{ s: 'A1', e: 'D1' }];
                var myWorkBook = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(myWorkBook, myWorkSheet, "myWorkSheet");
                XLSX.writeFile(myWorkBook, myFile);
                console.log(data)
                $thisbtn.prop("disabled", false);
                $($thisbtn).html(
                    `<i class="fa fa-print"></i> Export`
                );
              }
            });
        }

</script>