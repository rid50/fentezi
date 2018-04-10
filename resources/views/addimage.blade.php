@extends('layouts.app')

@section('title', 'Добавить в альбом')

@section('link')
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('navbar-brand', 'Альбомы')

@section('left-menu')
@endsection
	
@section('content')
    <div class="container" style="text-align: center;">
      <div style="display: inline-block;margin-top:100px;">
        <form name="addimagetoalbum" data-toggle="validator" role="form" method="POST" action="{{URL::route('add_image_to_album')}}" enctype="multipart/form-data">
            {{ csrf_field() }}		
          <input type="hidden" name="album_id"value="{{$album->id}}" />
          <fieldset>
            <legend>Добавить фотографию в альбом "{{$album->name}}"</legend>
            <div class="form-group">
              <textarea name="description" class="form-control" placeholder="Описание изображения" required data-error="Поле не должно быть пустым">{{old('description')}}</textarea>
			  <div class="help-block with-errors"></div>
			</div>
            <div class="form-group">
              {{Form::input('file','image',null,['accept'=>'.jpg, .jpeg, .png','class'=>'filestyle',
				'data-input'=>'false','data-buttonText'=>'Выберите файл'])}}
			</div>
            <button type="submit" class="btn btn-primary">Добавить</button>
          </fieldset>
        </form>
		
 		@if ($errors->any())
		  <div class="alert alert-warning" style="margin-top:20px;">
			<ul>
			@foreach ($errors->all() as $error)
			  <li>{{ $error }}</li>
			@endforeach
			</ul>
		  </div>
		  <script>
			//$('.alert').alert();
		  </script>
        @endif
		
      </div>
    </div>
@endsection

@section('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="{{URL::asset('js/bootstrap-filestyle.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('js/validator.min.js')}}" charset="utf-8"></script>
@endsection

