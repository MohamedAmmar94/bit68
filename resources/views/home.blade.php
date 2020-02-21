@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Know Your Weather
					
					<form id="getweather" style="width: 100%;height: 130px;">
					{{ csrf_field() }}
						<input type="text" class="form-control" placeholder="type city" name="city" required>
						<input type="submit" class="btn btn-primary" style="margin: 20px;float: right;
">
					</form>
					<div class="loading">
						<img src="{{asset('/img/loading2.gif')}}">
					</div>
					<div class="result-container"></div>
					
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery( document ).ready( function( $ ) {
console.log("gfdssssssssssss");
    $( '#getweather' ).on( 'submit', function(e) {
        e.preventDefault();

        var form_data = $(this).serialize();

        $.ajax({
            type: "get",
            url: '/getweather',
			beforeSend: function( xhr ) {
				$('.loading').show();
				},
			 data:form_data,
			 headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
			

        }).done( 
				function(data) 
						{
							
						$('.result-container').html(data.html);
						$('.loading').hide();				 
						}

			);

    });
  });
	
</script>
@endsection
