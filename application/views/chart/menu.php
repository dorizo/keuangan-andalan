
<div class="row mb-5">
                    <a class="col-3 bg-gray p-2 text-center <?=$this->router->fetch_method()=="index"?"pilihan":"";?>" href="<?=base_url("chart")?>">VENDOR CHART </a>
                    <a class="col-3 bg-gray p-2  text-center  <?=$this->router->fetch_method()=="kat"?"pilihan":"";?>"  href="<?=base_url("chart/kat")?>">KATEGORI CHART</a>
                    <a class="col-3 bg-gray p-2  text-center  <?=$this->router->fetch_method()=="witel"?"pilihan":"";?>"  href="<?=base_url("chart/witel")?>">WITEL CHART</a>
                    <a class="col-3 bg-gray p-2  text-center  <?=$this->router->fetch_method()=="outstanding"?"pilihan":"";?>"  href="<?=base_url("chart/outstanding")?>">OUTSTANDING CHART</a>
                </div>

                <style>
                    .pilihan{
                        background:#0556BF !important;
                    }
                </style>