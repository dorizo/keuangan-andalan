<div class="col-12">
    <div class="card">
        <div class="card-body">
        <form method="get">
            <div class="row">
                <div class="col-5"><input type="date" class="form-control" value="<?=$this->input->get("mulai")?>" name="mulai" /></div>
                <div class="col-5"><input type="date" class="form-control"  value="<?=$this->input->get("selesai")?>"  name="selesai" /></div>
                <div class="col-2"><button type="submit" class="btn btn-success" ><i class="fa fa-search"></i></button></div>
          
            </div>  
        </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-6">
        <div class="description-block border-right">
        <h5 class="description-header"><?=rupiah($nilaiboq->nilai)?></h5>
        <span class="description-text">Project Masuk</span>
        </div>

        </div>

        <div class="col-sm-4 col-6">
        <div class="description-block border-right">
        <h5 class="description-header"><?=rupiah($nilaikeluar->nilai)?></h5>
        <span class="description-text">TOTAL PENGELUARAN</span>
        </div>

        </div>

        <div class="col-sm-4 col-6">
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
