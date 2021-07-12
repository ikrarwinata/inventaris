
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
    	$("#modal-overlay").find(".modal-title").text("Tambah Tipe Asets");
    	$("form").attr("action", "Tipe_asets/create_action");
    	$("#modal-overlay").find("#idtipe").val(null);
    	$("#modal-overlay").find("#tipe").val(null);
    	$("#modal-overlay").find("#keterangan").val(null);
    });
    $("table").on("click", ".btn-update", function() {
    	$("#modal-overlay").find(".overlay").remove();
        $("#modal-overlay").find(".modal-title").text("Ubah Tipe Asets");
        $("#modal-overlay").find("form").attr("action", "Tipe_asets/update_action");
        var id = $(this).closest("tr").find(".id-placeholder").text();
        var tipe = $(this).closest("tr").find(".tipe-placeholder").text();
        var keterangan = $(this).closest("tr").find(".keterangan-placeholder").text();
        $("#modal-overlay").find("#idtipe").val(id);
        $("#modal-overlay").find("#tipe").val(tipe);
        $("#modal-overlay").find("#keterangan").val(keterangan);
    });

  });
</script>