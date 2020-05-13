@extends('front.front')  
@section('content')

<div class="container-fluid">
<div class="row" style="margin-top: 60px;margin-bottom: 60px;">
	<div class="col-sm-2">&nbsp;</div>
	<div class="col-sm-8">
		<div class="panel panel-danger">
		  <div class="panel-heading"><b>Terms And Conditions</b></div>
		  <div class="panel-body">{!! $data['terms']->content  !!}</div>
		</div>
	</div>
	<div class="col-sm-2">&nbsp;</div>
</div>
</div>
<script type="text/javascript">
	document.getElementById('loader').style.display = "none";
</script>
@endsection