@if(Session::has('success_message'))

<script type="text/javascript">
	$(document).ready(function (){
		showSwal('success-message',"{{ Session::get('success_message') }}");
	});
</script>  
@endif

@if(Session::has('error_message'))
<script type="text/javascript">
	$(document).ready(function (){
		showSwal('error-message',"{{ Session::get('error_message') }}");
	});
</script>
@endif
