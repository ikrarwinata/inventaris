
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    var default_id = $("#kodebarang_lama").val();
    if(default_id != null){
        $.ajax({
            type: 'ajax',
            method: 'POST',
            url:"Asets/get_by_kode",
            data:{'id':default_id},
            ContentType: 'application/json',
            success: function(e){
                var arr = e.split("</br>");
                $("#kodebarang").text(default_id);
                var o = arr[1] + "<small>" + arr[2] + " <strong>(" +  arr[4]+ ")</strong></small>";
                $("#namabarang").text("");
                $("#namabarang").prepend(o);
                $("#ukuran").text(arr[3]);
                o = "<strong>" + arr[5] + "</strong>"
                $("#ruangan_lama").text("");
                $("#ruangan_lama").prepend(o);
                $("#kondisi").text(arr[6]);
                $("#units").text(arr[7]);
            },
            error: function(e){
                console.log($(this).responseText);
            },
            failed: function(e){
                console.log($(this).responseText);
            }
        });
    }

    $("#kodebarang_lama").on("change", function(){
    	var id = $(this).val();
    	$.ajax({
            type: 'ajax',
            method: 'POST',
            url:"Asets/get_by_kode",
            data:{'id':id},
            ContentType: 'application/json',
            success: function(e){
                var arr = e.split("</br>");
                $("#kodebarang").text(id);
                var o = arr[1] + "<small>" + arr[2] + " <strong>(" +  arr[4]+ ")</strong></small>";
                $("#namabarang").text("");
                $("#namabarang").prepend(o);
                $("#ukuran").text(arr[3]);
                o = "<strong>" + arr[5] + "</strong>"
                $("#ruangan_lama").text("");
                $("#ruangan_lama").prepend(o);
                $("#kondisi").text(arr[6]);
                $("#units").text(arr[7]);
            },
            error: function(e){
                console.log($(this).responseText);
            },
            failed: function(e){
                console.log($(this).responseText);
            }
        });
    });


  })
</script>