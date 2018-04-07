@extends('layouts.app')

@section('title', 'Альбомы')

@section('link')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.1/jquery.fancybox.min.css" rel="stylesheet"/>	
@endsection

@section('style')
   <style type="text/css">
		.close-icon{
			border-radius: 50%;
			position: absolute;
			right: 5px;
			top: -10px;
			padding: 5px 8px;
		}
  </style>
@endsection

@section('navbar-brand', 'Альбомы')

@section('left-menu')
	<li><a href="{{URL::route('create_album_form')}}">Создать новый альбом</a></li>
@endsection
	
@section('content')
 	<div class="container">
		<div class="row">
			<div class='list-group gallery'>
				@if($albums->count())
					@foreach($albums as $album)
						<div class='col-xs-3'>
							<a class="thumbnail" href="{{URL::route('show_album', array('id'=>$album->id))}}">
								<img class="img-responsive" alt="" src="/albums/{{$album->cover_image}}" />
							</a>
							<div class='text-center'>
								<h3  class='text-muted'>{{$album->name}}</h3>
								<p  class='text-muted'>{{$album->description}}</p>
								<p>{{count($album->Photos)}} работ.</p>
							</div>
							@auth
							<form action="{{ url('deletealbum',$album->id) }}" method="POST">
								{!! csrf_field() !!}
								<input type="hidden" name="_method" value="delete">
								<button type="submit" class="close-icon btn btn-danger" onclick="return confirm('Вы уверены?')">
									<i class="glyphicon glyphicon-remove"></i>
								</button>
							</form>
							@endauth
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>		  
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.0/jquery.fancybox.min.js"></script>
	<script type="text/javascript">
	  $(document).ready(function(){
		$(".fancybox").fancybox({
			openEffect: "none",
			closeEffect: "none"
		});
	  });
	</script>
@endsection
