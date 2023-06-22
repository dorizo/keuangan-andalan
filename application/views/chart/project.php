<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <?php include("menu.php")?>
                <form method="get">
                <div class="row">
                    <!-- <div class="col-2">Vendor LIST</div>
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
                    </div> -->
                    <div class="col-12 card m-2">
                    <div class="card-header">
                    <div class="row">
                        <div class="col-2 pl-2">TAHUN</div>
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
                      </div>
                        
                    </div>
                    <div class="card-body scroll">
                      <div class="row">
                        <div class="col-6 border">
                          <h6 class="label">Witel</h6><br />
                        <?php
                          foreach ($datavendor as $key => $value) {
                              // print_r($value);
                            $seleced = "";
                            $sos =  array_search($value["witel_id"],$this->input->get("witel_id") ?? []);
                            if(!empty($sos) or $sos ===0){
                              $seleced = "checked";
                            }
                            ?>
                            <input type="checkbox" id="vehicle1" name="witel_id[]" value="<?=$value['witel_id']?>" <?=$seleced?>>
                          <label for="vehicle1"> <?php print_r($value["witel_name"])?></label>  <br /> 
                          <?php }?>
                        </div>
                        
                        <div class="col-6 border p-2">
                          <h6 class="label">KATEGORI</h6><br />
                        <?php
                          foreach ($jobresult as $key => $value) {
                            $seleced = "";
                            $sos =  array_search($value["cat_id"],$this->input->get("cat_id") ?? []);
                            if(!empty($sos) or $sos ===0){
                              $seleced = "checked";
                            }
                            ?>
                            <input type="checkbox" id="vehicle1" name="cat_id[]" value="<?=$value['cat_id']?>" <?=$seleced?>>
                          <label for="vehicle1"> <?php print_r($value["cat_name"])?></label>  <br />
                          <?php }?>
                        </div>
                      </div>
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
        // echo;
        $tahunss = 2021;
        $tahunss = $this->input->get("tahun");
        $val = array();
        if (is_array($this->input->get("cat_id")) || is_object($this->input->get("cat_id")))
        {
            foreach ($this->input->get("cat_id") as $key => $value) {
                    # code...
                    $kodes = array();
                $vendor =  $this->Projectcat_model->getsingle($value);
                $val[$key]["name"] = $vendor->cat_name;
                // for ($bulan=0; $bulan <  count($this->input->get("witel_id")) ; $bulan++) { 
                    # code...
                    
            foreach ($this->input->get("witel_id") as $keyxx => $valuexx) {
                    // $arrayxxxxxxxx=array_map('intval', $this->input->get("witel_id"));
                    // $arrayxxxxxxxx = implode(",",$this->input->get("witel_id"));
                    // echo $arrayxxxxxxxx."<br />";
                    // print_r($valuexx);
                    $querrrrrV = 'SELECT sum(nilai_boq) as boq from project where  witel_id ='.$valuexx.' AND cat_id="'.$vendor->cat_id.'" AND DATE_FORMAT(project_date , "%Y") = "'.$tahunss.'"';
                    // echo $querrrrrV ;
                    $xls = $this->db->query($querrrrrV)->row();
                    // print_r($xls);
                    $kodes[$keyxx] = $xls?$xls->boq:0;
                }
                $val[$key]["data"] = $kodes;
                }
        }

        $witeldata = array();
        if (is_array($this->input->get("witel_id")) || is_object($this->input->get("witel_id")))
        {
          foreach ($this->input->get("witel_id") as $key => $value) {
           
          $vendor =  $this->Witel_model->getsinglereport($value);
          $witeldata[$key] = $vendor->witel_name;
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
          categories: <?=json_encode($witeldata);?>,
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