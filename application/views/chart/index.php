<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <?php include("menu.php")?>
                <form method="get">
                <div class="row">
                    <div class="col-2">TAHUN</div>
                    <div class="col-10">
                        
                    <select class="form-control" name="tahun">
                        <?php
                        for ($i=2019; $i <= date('Y') ; $i++) { 
                            ?>
                            <option value="<?=$i?>" <?=$this->input->get("tahun")==$i?"selected":""?>><?=$i?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="card m-2 col-12">
                    <div class="card-body scroll">
                    <?php
                    foreach ($datavendor as $key => $value) {
                      $seleced = "";
                      $sos =  array_search($value["vendorCode"],$this->input->get("witel_id") ?? []);
                      if(!empty($sos) or $sos ===0){
                        $seleced = "checked";
                      }
                      ?>
                      <input type="checkbox" id="vehicle1" name="witel_id[]" value="<?=$value['vendorCode']?>" <?=$seleced?>>
                    <label for="vehicle1"> <?php print_r($value["vendorName"])?></label>  <br />
<?php }?>
                    </div>
                    </div>
                    <div class="col-1"><input type="submit" class="btn btn-success" value="search" /></div>
                </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="chart"></div>
                </div>
            </div>
        </div>
        <?php 
        $tahunss = 2021;
        $tahunss = $this->input->get("tahun");
        $val = array();
        if (is_array($this->input->get("witel_id")) || is_object($this->input->get("witel_id")))
        {
            foreach ($this->input->get("witel_id") as $key => $value) {
                    # code...
                    $kodes = array();
                $vendor =  $this->Vendor_model->viewSinggle($value);
                $val[$key]["name"] = $vendor->vendorName;
                for ($bulan=0; $bulan < 12 ; $bulan++) { 
                    # code...
                    $querrrrrV = 'SELECT sum(nilai_boq) as boq from project where vendorCode='.$value.' AND DATE_FORMAT(project_date , "%m") = '.($bulan+1).'  AND DATE_FORMAT(project_date , "%Y") = "'.$tahunss.'" GROUP BY DATE_FORMAT(project_date , "%Y-%m") ASC;';
                    // echo $querrrrrV ;
                    $xls = $this->db->query($querrrrrV)->row();
                    // print_r($xls);
                    $kodes[$bulan] = $xls?$xls->boq:0;
                }
                $val[$key]["data"] = $kodes;
                }
        }
            
            ?>
        <script>
            var options = {
          series: <?= json_encode($val);?>,
          chart: {
          type: 'bar',
          height: 500
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' , 'Nov','Des'],
        },
        yaxis: {
            labels: {
                formatter: function(value) {
                var val = Math.abs(value)
                if (val >= 1000000) {
                    val = (val / 1000000).toFixed(0) + ' JT'
                }
                return val
                }
            }
            },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "Rp " + val.toLocaleString('en-US')
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
            </script>

            
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  });
  </script>

  <style>
    .scroll {
    max-height: 200px;
    overflow-y: auto;
}
  </style>