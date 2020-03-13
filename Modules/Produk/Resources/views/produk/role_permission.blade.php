<form class="" action="{{route('postrolePermission',[Request::segment(4)])}}" method="post" id="form_user">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <span class="white">&times;</span>
            </button>
            Assign Permission
        </div>
    </div>

    <div class="modal-body">
        <div class="row">


            <div class="col-xs-12 col-sm-12">

                @php
                $no=1;
                @endphp

                @foreach ($permissions as $key => $row)
                <div class="col-xs-6">
                    <label>
                        <input name="permission[]" class="ace ace-switch ace-switch-5" type="checkbox"
                            value="{{ $row }}" {{ in_array($row, $hasPermission) ? 'checked':'' }} />
                        <span class="lbl">{{ $row }}</span>
                    </label>

                    {{-- <div class="col-6">
                                <label class="css-control css-control-success css-checkbox">
                                <input type="checkbox" class="css-control-input" name="permission[]" value="{{ $row }}"
                    {{ in_array($row, $hasPermission) ? 'checked':'' }}>
                    <span class="css-control-indicator"></span> {{ $row }} <br>
                    </label>
                </div> --}}
            </div>
            @if ($no++%4 == 0)
            <br>
            @endif
            @endforeach

            <div class="space-4"></div>

        </div>
    </div>
    </div>

    <div class="modal-footer no-margin-top">
        <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
            <i class="ace-icon fa fa-times"></i>
            Close
        </button>
        <button type="submit" class="btn btn-sm btn-success pull-right" id="simpan_user">
            <i class="ace-icon fa fa-check"></i>
            Update
        </button>


    </div>
</form>
<script type="text/javascript">
    $(".select2").select2({
                    allowclear:true,
                    placeholder:'Cari'
                    });
                    $("#form_user").submit(function(event) {
                      var formdata = $(this).serialize(); // here $(this) refere to the form its submitting

                    $.ajax({
                      url: '{{route('postrolePermission',[Request::segment(4)])}}',
                      type: 'POST',
                      //method:'PUT',
                      dataType: 'JSON',
                      data: formdata,
                      success:function(response)
                      {
                        if (response.status=='error') {
                          swal("Error", response.status, "error");
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
                        swal("Error", response.status, "error");
                        $('#myModal').modal('hide');

                      }
                    })
                    event.preventDefault();
                    });
</script>
