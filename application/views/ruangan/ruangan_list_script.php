
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<script>
  $(function () {
    $("#datatab1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    var newoverlay = "<div class=\"overlay d-flex justify-content-center align-items-center\"><i class=\"fas fa-2x fa-sync fa-spin\"></i></div>";
    $(".modal-dismiss").on("click", function(){
    	$("#modal-overlay").find(".modal-content").prepend(newoverlay);
    });

    $("#add-new").on("click", function() {
        $("#modal-overlay").find(".overlay").remove();
    	$("#modal-overlay").find(".modal-title").text("Tambah Data Ruangan");
    	$("form").attr("action", "Ruangan/create_action");
    	$("#modal-overlay").find("#idruangan").val(null);
    	$("#modal-overlay").find("#tipe").val(null);
    	$("#modal-overlay").find("#keterangan").val(null);
    });
    $("table").on("click", ".btn-update", function() {
        var id = $(this).closest("tr").find(".id-placeholder").text();
        $("#modal-overlay").find(".modal-title").text("Ubah Data Ruangan");
        $("#modal-overlay").find("form").attr("action", "Ruangan/update_action");
        $.ajax({
            type: 'ajax',
            method: 'POST',
            url:"Ruangan/update",
            data:{'id':id},
            ContentType: 'application/json',
            success: function(e){
                var arr = e.split("</br>");
                $("#modal-overlay").find("#idruangan").val(id);
                $("#modal-overlay").find("#nama_ruangan").val(arr[1].trim());
                $("#modal-overlay").find("#lokasi").val(arr[2].trim());
                $("#modal-overlay").find("#keterangan").val(arr[3].trim());
                $("#modal-overlay").find(".overlay").remove();
            },
            error: function(e){
                console.log($(this).responseText);
            },
            failed: function(e){
                console.log($(this).responseText);
            }
        });
    });

    $("table").on("click", ".btn-delete", function() {
        var id = $(this).closest("tr").find(".id-placeholder").text();
        $("#ref-delete").attr("href", "Ruangan/delete/" + id);
        $("#ref-delete-all").attr("href", "Ruangan/delete_asets/" + id);
        $("#modal-delete").find(".overlay").remove();
    });
  });
</script>