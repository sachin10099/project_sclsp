@extends('front.formfiller_dashboard')
@section('content')
<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-header card-header-primary">
      <h3 class="card-title">Notifications</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
        	@foreach($notifications as $notification)
			<div class="alert alert-default alert-with-icon" style="background-color: gray;" data-notify="container">
			<i class="material-icons" data-notify="icon">add_alert</i>
				<div class="pull-right">
					<i class="fa fa-envelope-open-o" aria-hidden="true" style="color: white; font-size: 15px;" data-toggle="tooltip" title="View"></i>
			  		<i class="fa fa-trash" aria-hidden="true" style="color: white; font-size: 20px;" data-toggle="tooltip" title="Delete" onclick="deleteNotification('{{ $notification->id }}')"></i>
				</div>
				
			<span data-notify="message" style="color: white;">{{ $notification->data['message'] }}</span>
			</div>
			@endforeach
			{{ $notifications->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
	function deleteNotification(id) {
	    swal({
	        title: "Are you sure?",
	        text: "Delete this Notification.",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
	    })
	    .then((willDelete) => {
	        if (willDelete) {
	            $.ajax({
	                method:'post',
	                url   : "{{ url('form-filler/delete/notification') }}",
	                data  : {
	                    "_token": "{{ csrf_token() }}",
	                    'id'    : id
	                },
	                success: function(data){
	                    swal("", data, "success");
	                    location.reload();
	                }
	            });
	        }else {
	            document.getElementById('loader').style.display ="none";
	        }
	    });
 	}
</script>
@endsection