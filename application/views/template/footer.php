</div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap -->
<script src="<?=base_url()?>asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?=base_url()?>asset/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?=base_url()?>asset/plugins/chart.js/Chart.min.js"></script>
<script src="<?=base_url()?>asset/js/easy-number-separator.js"></script>

<script src="<?=base_url()?>asset/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?=base_url()?>asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>asset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>asset/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url()?>asset/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url()?>asset/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url()?>asset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>asset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>asset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="<?=base_url()?>/asset/plugins/select2/js/select2.min.js"></script>
<script src="<?=base_url()?>asset/plugins/pace-progress/pace.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.2/sorting/formatted-numbers.js" ></script>
<?php
if(!empty($pluginjs)){
  echo "<script src=".base_url("js/".$pluginjs)."></script>";
};
?>
<!-- AdminLTE for demo purposes -->


<script>
  $(function () {
    $("#example").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "bDestroy": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "bDestroy": true,
    });
  });
</script>
</body>
</html>
<script>

var globalFunctions = {};

globalFunctions.ddInput = function(elem) {
  if ($(elem).length == 0 || typeof FileReader === "undefined") return;
  var $fileupload = $('input[type="file"]');
  var noitems = '<li class="no-items"><span class="blue-text underline">Browse</span> or drop here</li>';
  var hasitems = '<div class="browse hasitems">Other files to upload? <span class="blue-text underline">Browse</span> or drop here</div>';
  var file_list = '<ul class="file-list"></ul>';
  var rmv = '<div class="remove"><i class="icon-close icons">x</i></div>'

  $fileupload.each(function() {
    var self = this;
    var $dropfield = $('<div class="drop-field"><div class="drop-area"></div></div>');
    $(self).after($dropfield).appendTo($dropfield.find('.drop-area'));
    var $file_list = $(file_list).appendTo($dropfield);
    $dropfield.append(hasitems);
    $dropfield.append(rmv);
    $(noitems).appendTo($file_list);
    var isDropped = false;
    $(self).on("change", function(evt) {
      if ($(self).val() == "") {
        $file_list.find('li').remove();
        $file_list.append(noitems);
      } else {
        if (!isDropped) {
          $dropfield.removeClass('hover');
          $dropfield.addClass('loaded');
          var files = $(self).prop("files");
          traverseFiles(files);
        }
      }
    });

    $dropfield.on("dragleave", function(evt) {
      $dropfield.removeClass('hover');
      evt.stopPropagation();
    });

    $dropfield.on('click', function(evt) {
      $(self).val('');
      $file_list.find('li').remove();
      $file_list.append(noitems);
      $dropfield.removeClass('hover').removeClass('loaded');
    });

    $dropfield.on("dragenter", function(evt) {
      $dropfield.addClass('hover');
      evt.stopPropagation();
    });

    $dropfield.on("drop", function(evt) {
      isDropped = true;
      $dropfield.removeClass('hover');
      $dropfield.addClass('loaded');
      var files = evt.originalEvent.dataTransfer.files;
      traverseFiles(files);
      isDropped = false;
    });


    function appendFile(file) {
      console.log(file);
      $file_list.append('<li>' + file.name + '</li>');
    }

    function traverseFiles(files) {
      if ($dropfield.hasClass('loaded')) {
        $file_list.find('li').remove();
      }
      if (typeof files !== "undefined") {
        for (var i = 0, l = files.length; i < l; i++) {
          appendFile(files[i]);
        }
      } else {
        alert("No support for the File API in this web browser");
      }
    }

  });
};

$(document).ready(function() {
  globalFunctions.ddInput('input[type="file"]');
});
</script>