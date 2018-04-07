@extends('layouts.app')

@section('title', 'Добавить в альбом')

@section('link')
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{{URL::asset('js/bootstrap-filestyle.min.js')}}" charset="utf-8"></script>
@endsection

@section('navbar-brand', 'Альбомы')

@section('left-menu')
@endsection
	
@section('content')
    <div class="container" style="text-align: center;">
      <div class="span4" style="display: inline-block;margin-top:100px;">
 		@if ($errors->any())
          <div class="alert alert alert-danger">
		    <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
		
        <form name="addimagetoalbum" method="POST"action="{{URL::route('add_image_to_album')}}"enctype="multipart/form-data">
            {{ csrf_field() }}		
          <input type="hidden" name="album_id"value="{{$album->id}}" />
          <fieldset>
            <legend>Добавить фотографию в альбом "{{$album->name}}"</legend>
            <div class="form-group">
              <textarea name="description" type="text"class="form-control" placeholder="Описание изображения" required oninvalid="this.setCustomValidity('Поле не должно быть пустым')" onchange="this.setCustomValidity('')"></textarea>
            </div>
            <div class="form-group">
              {{Form::input('file','image',null,['accept'=>'.jpg, .jpeg, .png','class'=>'filestyle',
				'data-input'=>'false','data-buttonText'=>'Выберите файл'])}}            </div>
            <button type="submit" class="btnbtn-default">Добавить</button>
          </fieldset>
        </form>
      </div>
    </div>
@endsection
