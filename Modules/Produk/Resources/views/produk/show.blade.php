<form class="" action="{{route('beli',$data->id)}}" method="post" id="form_user">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <span class="white">&times;</span>
            </button>
            Beli Barang
        </div>
    </div>

    <div class="modal-body">
        <div class="row">

            <div class="col-xs-12 col-sm-7">
                <div class="form-group">
                    <label for="form-field-username">Kode Produk</label>

                    <div>
                        <input type="text" class="form-control" name="kode" id='kode' required maxlength="6"
                            value="{{$data->kode}}" readonly />
                    </div>
                </div>


                <div class="form-group">
                    <label for="form-field-username">Nama Produk</label>

                    <div>
                        <input type="text" class="form-control" name="name" id='name' value="{{$data->name}}"
                            readonly />
                    </div>
                </div>


                <div class="form-group">
                    <label for="form-field-first">Harga</label>

                    <div>
                        <input type="number" class="form-control" name="harga" id='harga' value="{{$data->harga}}"
                            readonly />
                    </div>
                </div>
                <div class="form-group">
                    <label for="form-field-first">Total Beli</label>
                    <div>
                        <input type="number" class="form-control" name="beli" id="beli" />
                    </div>
                </div>
                <div class=" form-group">
                    <label for="form-field-first">Total</label>
                    <div>
                        <input type="number" class="form-control" name="total" id="total" readonly />
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
  url: '{{route('beli',[$data->id])}}',
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
            text: response.msg,
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

        $('#beli').keyup(function(){
        var value1 = parseFloat($('#beli').val()) || 0;
        var value2 = parseFloat($('#harga').val()) || 0;
        $('#total').val(value1 * value2);
        });
</script>
