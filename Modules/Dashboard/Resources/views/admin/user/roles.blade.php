<form class="" action="{{route('post.role.user',[$user->id])}}" method="post" id="form_user">
    @csrf

    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <span class="white">&times;</span>
            </button>
            Role User
        </div>
    </div>

    <div class="modal-body">
        <div class="row">


            <div class="col-xs-12 col-sm-7">


                <div class="form-group">
                    <label for="form-field-first">Role</label>

                    <div>
                        @foreach ($roles as $row)
                        <div class="col-6">
                            <label class="css-control css-control-success css-radio">
                                <input type="radio" class="css-control-input" name="role"
                                    {{ $user->hasRole($row) ? 'checked':'' }} value="{{ $row }}">
                                <span class="css-control-indicator"></span> {{ $row }}
                            </label>

                        </div>
                        @endforeach
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
  url: '{{route('post.role.user',[$user->id])}}',
  type: 'POST',
  // method:'PUT',
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


{{--
<form class="" action="{{route('post.role.user',[$user->id])}}" method="post">
@csrf


<div class="block block-themed block-transparent mb-0 ">
    <div class="block-header bg-primary-dark">
        <h3 class="block-title">Update User Role</h3>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                <i class="si si-close"></i>
            </button>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12">

            <div class="block-content">

                <div class="form-group row">
                    <label class="col-12" for="example-text-input">Role</label>
                    <div class="col-md-9">
                        @foreach ($roles as $row)
                        <div class="col-6">
                            <label class="css-control css-control-success css-radio">
                                <input type="radio" class="css-control-input" name="role"
                                    {{ $user->hasRole($row) ? 'checked':'' }} value="{{ $row }}">
                                <span class="css-control-indicator"></span> {{ $row }}
                            </label>

                        </div>
                        @endforeach


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-alt-success">
        <i class="fa fa-check"></i> Save
    </button>
</div>
</form>
<script type="text/javascript">
    $(".select2").select2({
allowclear:true,
placeholder:'Cari'
});
</script> --}}
