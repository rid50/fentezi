@extends('layouts.app')

@section('title', $album->name)

@section('link')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.1/jquery.fancybox.min.css" rel="stylesheet"/>	
@endsection

@section('style')
   <style type="text/css">
	/* http://mediaqueriestest.com/	*/
	@media (-webkit-min-device-pixel-ratio:1), (min--moz-device-pixel-ratio:1) {}
		.row.is-flex {
			display: flex;
			flex-wrap: wrap;
		}
	/*	
		.row.is-flex > [class*='col-'] {
			display: flex;
			flex-direction: column;
		}
	*/
		/*
		* And with max cross-browser enabled.
		* Nobody should ever write this by hand. 
		* Use a preprocesser with autoprefixing.
		*/
	/*
		.row.is-flex {
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-flex-wrap: wrap;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
		}

		.row.is-flex > [class*='col-'] {
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-orient: vertical;
			-webkit-box-direction: normal;
			-webkit-flex-direction: column;
			-ms-flex-direction: column;
			flex-direction: column;
		}
	*/
		
		hr { 
			display: block;
			margin-top: 0.5em;
			margin-bottom: 2em;
			margin-left: auto;
			margin-right: auto;
			border-style: inset;
			border-width: 1px;
		}		
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
      <div class="col-xs-4">	
		<a class="thumbnail" data-fancybox="gallery{{$album->id}}" href="{{url(config('upload_folder'),$album->cover_image)}}">
		  <img class="img-responsive" alt="{{$album->name}}" src="{{url(config('upload_folder'),$album->cover_image)}}">
		</a>
	  </div>
      <div class="col-xs-4 col-xs-offset-2">
		<div>
		  <h2>{{$album->name}}</h2>
		</div>
        <div>
		  <h3>{{$album->description}}</h3><br/>
		</div>
		@auth
		<div>
		  <a href="{{route('add_image',array('id'=>$album->id))}}">
			<button type="button"class="btn btn-primary btn-large">Добавить в альбом</button>
		  </a>
		</div>
		@endauth
	  </div>
    </div>
	<hr>
	  <div class="row is-flex">
    @foreach($album->Photos as $photo)
		<div class='col-xs-3'>
			<a class="img-thumbnail" data-fancybox="gallery{{$album->id}}" href="{{url(config('upload_folder'),$photo->image)}}" 
				data-caption="{{$photo->description}}">
			  <img class="img-responsive" alt="" src="{{url(config('upload_folder'),$photo->image)}}"/>
			</a>

			<div class="caption" style="height:20px; margin:0px 5px 40px;">
			  {{$photo->description}}
			</div>
			  
			@auth
			<form action="{{ url('deleteimage', array('id'=>$photo->id)) }}" method="POST">
				{!! csrf_field() !!}
				<input type="hidden" name="_method" value="delete">
				<button type="submit" class="close-icon btn btn-danger" onclick="return confirm('Вы уверены?')">
				  <i class="glyphicon glyphicon-remove"></i>
				</button>
			</form>			  
            @endauth
		</div>
    @endforeach
	</div>
  </div>
@endsection

@section('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.1/jquery.fancybox.min.js"></script>
	
	<script type="text/javascript">
	  $(document).ready(function(){
		 $("[data-fancybox]").fancybox({
			 loop:true
		  // afterLoad : function(instance, current) {
			// var pixelRatio = window.devicePixelRatio || 1;

			// if ( pixelRatio > 1.5 ) {
              // current.width  = current.width  / pixelRatio;
              // current.height = current.height / pixelRatio;
			// }
		  // }
		 });
	  });
	</script>
@endsection
