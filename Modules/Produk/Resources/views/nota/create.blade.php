<form class="" action="{{route('produk.store')}}" method="post" id="form_user">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <span class="white">&times;</span>
            </button>
            Tambah Barang
        </div>
    </div>

    <div class="modal-body">
        <div class="row">

            <div class="col-xs-12 col-sm-7">
                <div class="form-group">
                    <label for="form-field-username">Kode Produk</label>

                    <div>
                        <input type="text" class="form-control" name="kode" id='kode' required maxlength="6" />
                    </div>
                </div>


                <div class="form-group">
                    <label for="form-field-username">Nama Produk</label>

                    <div>
                        <input type="text" class="form-control" name="name" id='name' required />
                    </div>
                </div>

                <div class="space-4"></div>

                <div class="form-group">
                    <label for="form-field-first">STOK</label>
                    <div>
                        <input type="number" class="form-control" name="stok" id='stok' />
                    </div>
                </div>
                <div class="form-group">
                    <label for="form-field-first">Harga</label>

                    <div>
                        <input type="number" class="form-control" name="harga" id='harga' />
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal-footer no-margin-top">
        <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
            <i class="ace-icon fa fa-times"></i>
            Close
        </button>
        <button type="button" class="btn btn-sm btn-success pull-right" id="simpan_user">
            <i class="ace-icon fa fa-check"></i>
            Simpan
        </button>


    </div>
</form>


<script type="text/javascript">
    $(".select2").select2({
allowclear:true,
placeholder:'Cari'
});
$("#simpan_user").click(function(event) {
$.ajax({
  url: '{{route('produk.store')}}',
  type: 'POST',
  dataType: 'JSON',
  data: $("#form_user").serialize(),
  success:function(response)
  {
    if (response.status=='error') {
      swal("Error", response.msg, "error");
      $('#myModal').modal('hide');
      myTable.ajax.reload();

    }else {
      swal({
            title: "Success!",
            text: "Data Updateed.",
            type: "success",
            timer: 1000
            });
      $('#myModal').modal('hide');

      myTable.ajax.reload();
    }
  },
  error:function(response)
  {
    swal("Error", "Data Not Deleted", "error");

  }
})
});
</script>
