$(function () {
    $("#example1").DataTable({
      "responsive": true,
      "pageLength": 50, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });