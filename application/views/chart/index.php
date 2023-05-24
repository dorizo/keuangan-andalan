<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <form method="get">
                <div class="row">
                    <div class="col-2">Vendor LIST</div>
                    <div class="col-3">
                        
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
                    <div class="col-4">
                    <select class="form-control select2" multiple="multiple" name="witel_id[]">
                    <option value="">ALL DATA</option>
                    <?php
                    foreach ($datavendor as $key => $value) {
                    //   print_r($value);
                      $seleced = "";
                      $sos =  array_search($value["vendorCode"],$this->input->get("witel_id") ?? []);
                      if(!empty($sos) or $sos ===0){
                        $seleced = "selected";
                      }
                      ?>
                    <option   <?=$seleced?>   value="<?=$value['vendorCode']?>"><?php print_r($value["vendorName"])?></option>
                    <?php
                    }
                    ?>
                  </select>
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
        foreach ($this->input->get("witel_id") as $key => $value) {
                # code...
                $kodes = array();
               $vendor =  $this->Vendor_model->viewSinggle($value);
               $val[$key]["name"] = $vendor->vendorName;
               for ($bulan=0; $bulan < 12 ; $bulan++) { 
                # code...
                $querrrrrV = 'SELECT sum(nilai_boq) as boq from project where vendorCode='.$value.' AND DATE_FORMAT(project_date , "%m") = "'.($bulan+1).'"  AND DATE_FORMAT(project_date , "%Y") = "'.$tahunss.'" GROUP BY DATE_FORMAT(project_date , "%Y-%m") ASC;';
                // echo $querrrrrV ;
                $xls = $this->db->query($querrrrrV)->row();
                // print_r($xls);
                $kodes[$bulan] = $xls?$xls->boq:0;
              }
              $val[$key]["data"] = $kodes;
            }
            
            ?>
        <script>
            var options = {
          series: <?= json_encode($val);?>,
          chart: {
          type: 'bar',
          height: 350
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
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
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