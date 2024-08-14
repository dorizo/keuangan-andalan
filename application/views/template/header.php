<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$titlepage?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url()?>asset/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>asset/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=base_url()?>asset/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url()?>asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
  <link rel="stylesheet" href="<?=base_url()?>asset/plugins/pace-progress/themes/black/pace-theme-flat-top.css">
  
  <link rel="stylesheet" href="<?=base_url()?>/asset/plugins/select2/css/select2.min.css">
   <link rel="stylesheet" href="<?=base_url()?>/asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- jQuery -->
<script src="<?=base_url()?>asset/plugins/jquery/jquery.min.js"></script>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="sidebar-mini layout-fixed  accent-info text-sm layout-navbar-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-cyan bg-primary navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

      <!-- Messages Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="<?=base_url()?>asset/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="<?=base_url()?>asset/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="<?=base_url()?>asset/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge"><?=notifikasinumber("KEUW")?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <?php if(kondisipermision("KEUW")){ ?>
          <span class="dropdown-item dropdown-header">Pengajuan  project</span>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url("pengajuan");?>" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?=$this->db->query("select * from akunbank_pengajuan where statusTransaksi='PENDING' AND statusPengajuan='project'")->num_rows()?> PENDING PENGAJUAN
          </a>
          <?php } ?>
          <?php if(kondisipermision("KEUW")){ ?>
          <span class="dropdown-item dropdown-header">Pengajuan SP</span>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url("pengajuan/notivsp");?>" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?=$this->db->query("
SELECT * FROM `akunbank_pengajuan` JOIN `suratpesanan` ON `suratpesanan`.`suratpesananCode`=`akunbank_pengajuan`.`project_id` JOIN `witel` ON `witel`.`witel_id`=`suratpesanan`.`witel_id` WHERE `akunbank_pengajuan`.`statusTransaksi` = 'PENDING'")->num_rows()?> PENDING PENGAJUAN
          </a>
          <?php } ?>
          
          <?php if(kondisipermision("KEUW")){ ?>
          <span class="dropdown-item dropdown-header">Pengajuan HO</span>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url("pengajuan/pengajuanho");?>" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?=$this->db->query("select * from oprasionalrequest WHERE `kategoriakutansi` = 'PENDING'")->num_rows()?> PENDING PENGAJUAN HO
          </a>
          <?php } ?>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-th-large"></i>
          </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> Setting
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url("login/logout")?>" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> Logout
          </a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-teal">
    <!-- Brand Logo -->
    <a href="<?=base_url()?>" class="brand-link bg-success bg-cyan bg-info">
      <!-- <img src="<?=base_url()?>asset/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">HO ANDALAN PRATAMA INDONUSA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url()?>asset/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">ADMIN</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2 ">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="<?=base_url("project")?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Project
              </p>
            </a>
          </li>
          
          <li class="nav-item">
          <?=projectmenu("KEUW",base_url("biayalain") , "fas fa-th" , "BIAYA LAINNYA")?>
          <?=projectmenu("KEUW",base_url("kas") , "fas fa-th" , "Overhead")?>
          <?=projectmenu("KEUW",base_url("akutansi/oprasional") , "fas fa-book" , "Oprasional")?>
          <?=projectmenu("SuPes",base_url("suratpesanan") , "fas fa-th" , "Surat Pesanan")?>
          <?=projectmenu("KEUW",base_url("suratpesanan") , "fas fa-th" , "Surat Pesanan")?>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?=projectmenu("CU",base_url("kategori/parent") , "far fa-circle" , "PARENT KATEGORI")?>
            <?=projectmenu("CU",base_url("kategori/kat") , "far fa-circle" , "KATEGORI")?>
            <?=projectmenu("CU",base_url("job") , "far fa-circle" , "PROJECT STATUS")?>
          <?=projectmenu("KEUW",base_url("akunbank") , "far fa-circle" , "AKUN BANK")?>
          <?=projectmenu("KEUW",base_url("akunakutansi") , "far fa-circle" , "AKUN AKUTANSI")?>
          <?=projectmenu("VENDOR",base_url("index.php/vendor") , "far fa-circle" , "VENDOR")?>
            <?=projectmenu("VENDOR",base_url("witel") , "far fa-circle" , "WITEL")?>
          <?=projectmenu("LAPR",base_url("report") , "far fa-circle" , "REPORT")?>
          <?=projectmenu("KEUW",base_url("excelexport") , "fas fa-th" , "Excel Export")?>
          <?=projectmenu("LAPR",base_url("excelexport") , "fas fa-th" , "Excel Export")?>
          <?=projectmenu("KEUW",base_url("excelexport/transaksi") , "fas fa-th" , "Excel Transaksi")?>
          <?=projectmenu("LAPR",base_url("ReportKategori") , "far fa-circle" , "REPORT KATEGORI")?>
          <?=projectmenu("LAPR",base_url("ReportKategori/keuangan") , "far fa-circle" , "REPORT KEUANGAN")?>
          <?=projectmenu("LAPR",base_url("chart") , "far fa-circle" , "Chart REPORT")?>
          <?=projectmenu("LAPR",base_url("absensi") , "far fa-circle" , "Absensi REPORT")?>
          <?=projectmenu("LAPR",base_url("log") , "far fa-circle" , "Log REPORT")?>
              
              
              
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master Keuangan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
          <?=projectmenu("KEUW",base_url("akutansi/akun") , "far fa-circle" , "Master Akun")?>
          <?=projectmenu("KEUW",base_url("akutansi/sto") , "far fa-circle" , "STO")?>
          <?=projectmenu("KEUW",base_url("akutansi/pekerjaan") , "far fa-circle" , "Pekerjaan")?>
          <?=projectmenu("KEUW",base_url("akutansi/witel") , "far fa-circle" , "witel")?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?=projectmenu("CR",base_url("Master/role") , "far fa-circle" , "ROLE")?>
            <?=projectmenu("CU",base_url("Master/user") , "far fa-circle" , "USER")?>
            <?=projectmenu("CU",base_url("mandor") , "far fa-circle" , "KARYAWAN")?>
              <!-- <li class="nav-item">
                <a href="<?=base_url("/Master/role")?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ROLE</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url("/Master/user")?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>USER</p>
                </a>
              </li> -->
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?=projectmenu("KEUW",base_url("reportkeuangan") , "far fa-circle" , "REPORT")?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Project Param
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?=projectmenu("CR",base_url("Package") , "far fa-circle" , "Peckage")?>
            <?=projectmenu("CU",base_url("desinator") , "far fa-circle" , "Desinator")?>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0"><?=$titlepage?></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <?php
                $segments = $this->uri->segment_array();
                $last_segment = '';
                foreach ($segments as $segment) {
                    $last_segment .= '/' . $segment;
                    echo ' <li class="breadcrumb-item"><a href="'.base_url($last_segment).'">' . ucfirst(str_replace(array('-', '_'), '', $segment)) . '</a></li>';
                    // echo '/<a href="www.homepage.com' . $last_segment . '">' . ucfirst(str_replace(array('-', '_'), '', $segment)) . '</a>';
                }
                ?>
                <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item ">Dashboard v3</li> -->
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
        <div class="container-fluid">
            <div class="row">