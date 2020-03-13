@extends('layouts.app')
@section('title')
Users
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('dt.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection
@section('atas')

@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">User List</h3>

        <div class="clearfix">
            <div class="pull-right tableTools-container">

            </div>
        </div>


        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->
        <div class="table-responsive dataTables_borderWrap">
            <table id="user" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">
                            #
                        </th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                        <th class="text-center" style="width: 15%;">#</th>

                    </tr>
                </thead>

                <tbody>



                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('modal')
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="modal-large" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popin">
        <div class="modal-content">

        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('dt1.js')}}" charset="utf-8"></script>
<script src="{{asset('dt.js')}}" charset="utf-8"></script>
<script src="{{asset('assets/js/select2.min.js')}}" charset="utf-8"></script>


@endsection
@section('script')

<script type="text/javascript">
    $("#myModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-content").load(link.attr("href"));
});


var myTable=jQuery("#user").dataTable({
  processing: true,
  serverSide: true,
  responsive: true,
  bAutoWidth: false,
  pageLength:10,
  lengthMenu:[[5,10,15,20],[5,10,15,20]],
  // autoWidth:false,
  select: {
						style: 'multi'
					},
  ajax: {
      url: '{{route('api.user')}}',
      method: 'POST'
  },
  columns:[
    {data: 'DT_RowIndex', orderable: false, searchable: false},


    {data: 'name', name: 'name'},
    {data: 'email', name: 'email',orderable: false},
    {data: 'status', name: 'status',orderable: false},
     {data: 'action', name: 'action', orderable: false, searchable: false}
  ],
}).api();
$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
          },
					  {

						"text": "<i class='glyphicon glyphicon-refresh bigger-110 blue'></i> <span class='hidden'>Refresh</span>",
						"className": "btn btn-white btn-primary btn-bold",
            action: function ( e, dt, node, config ) {
                dt.ajax.reload();
            }
          },
					  {

						"text": "<i class='fa fa-plus-circle bigger-110 blue'></i> <a href='{{route('user.create')}}' class='hidden' data-remote='false' data-target='#myModal' data-toggle='modal'>New User</a>",
						"className": "btn btn-white btn-primary btn-bold",
            action: function (e, node, config){
              $('#myModal').modal('show').find(".modal-content").load('{{route('user.create')}}')
            },

					  }
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );

				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});


				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {

					defaultColvisAction(e, dt, button, config);


					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
        setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);

function hapus(id)
{
  swal({
  title: "Are you Sure",
  text: "Delete This Data",
  type: "info",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true
}, function () {
  setTimeout(function () {
    $.ajax({
      url: '{{url("administrator/user/")}}/'+id,
      type: 'POST',
      method:'DELETE',
      dataType: 'JSON',
      data: {id: id},
      success:function(data){
        swal("Success", "Data Deleted", "success");
        myTable.ajax.reload();

      },
      error:function(data)
      {
        swal("Error", "Data Not Deleted", "error");


      }
    })


  }, 600);
});
}

</script>
@endsection
