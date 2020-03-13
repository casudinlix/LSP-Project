<form class="" action="{{route('user.update',[$user->id])}}" method="post" id="form_user">
    @csrf
    @method('PUT')
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <span class="white">&times;</span>
            </button>
            Edit User
        </div>
    </div>

    <div class="modal-body">
        <div class="row">


            <div class="col-xs-12 col-sm-7">


                <div class="space-4"></div>

                <div class="form-group">
                    <label for="form-field-username">Username</label>

                    <div>
                        <input type="text" class="form-control" value="{{$user->name}}" name="name" id='name'
                            required />
                    </div>
                </div>

                <div class="space-4"></div>

                <div class="form-group">
                    <label for="form-field-first">email</label>
                    <div>
                        <input type="email" class="form-control" value="{{$user->email}}" name="email" id='email' />
                    </div>
                </div>
                <div class="form-group">
                    <label for="form-field-first">Status</label>

                    <div>
                        <select class="form-control" name="status">
                            <option value="1" {{($user->status==1)?"selected":""}}>Active</option>
                            <option value="0" {{($user->status==0)?"selected":""}}>Suspend</option>
                        </select>
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
  url: '{{route('user.update',[$user->id])}}',
  type: 'POST',
  method:'PUT',
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
