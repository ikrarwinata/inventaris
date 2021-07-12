
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script>
  $(function () {
    $("#datatab1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    var newoverlay = "<div class=\"overlay d-flex justify-content-center align-items-center\"><i class=\"fas fa-2x fa-sync fa-spin\"></i></div>";
    $("#modal-dismiss").on("click", function(){
    	$("#modal-overlay").find(".modal-content").prepend(newoverlay);
    });
    $("#add-new").on("click", function() {
        $("#modal-overlay").find(".overlay").remove();
    	$("#modal-overlay").find(".modal-title").text("Tambah Data Bahan");
    	$("form").attr("action", "Bahan_asets/create_action");
    	$("#modal-overlay").find("#idbahan").val(null);
    	$("#modal-overlay").find("#bahan").val(null);
    	$("#modal-overlay").find("#keterangan").val(null);
    });
    $("table").on("click", ".btn-update", function() {
    	$("#modal-overlay").find(".overlay").remove();
        $("#modal-overlay").find(".modal-title").text("Ubah Data Bahan");
        $("#modal-overlay").find("form").attr("action", "Bahan_asets/update_action");
        var id = $(this).closest("tr").find(".id-placeholder").text();
        var bahan = $(this).closest("tr").find(".bahan-placeholder").text();
        var keterangan = $(this).closest("tr").find(".keterangan-placeholder").text();
        $("#modal-overlay").find("#idbahan").val(id);
        $("#modal-overlay").find("#bahan").val(bahan);
        $("#modal-overlay").find("#keterangan").val(keterangan);
    });

  });
</script>