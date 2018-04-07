@extends('layouts.app')

@section('title', 'Создать новый альбом')

@section('link')
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{{URL::asset('js/bootstrap-filestyle.min.js')}}" charset="utf-8"></script>
@endsection

@section('navbar-brand', 'Альбомы')

@section('left-menu')
	<li><a href="{{URL::route('create_album_form')}}">Создать новый альбом</a></li>
@endsection
	
@section('content')
    <div class="container" style="text-align:center;">
      <div class="span4" style="display:inline-block;margin-top:100px;">
		@if ($errors->any())
          <div class="alert alert alert-danger">
		    <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form name="createnewalbum" method="POST" action="{{URL::route('create_album')}}" enctype="multipart/form-data">
            {{ csrf_field() }}		
          <fieldset>
            <div class="form-group">
              <input name="name" type="text" class="form-control" placeholder="Имя альбома" value="{{old('name')}}" required 
				oninvalid="this.setCustomValidity('Поле не должно быть пустым')" onchange="this.setCustomValidity('')">
            </div>
            <div class="form-group">
              <textarea name="description" type="text"class="form-control" placeholder="Описание альбома" required oninvalid="this.setCustomValidity('Поле не должно быть пустым')" onchange="this.setCustomValidity('')"></textarea>
            </div>
            <div class="form-group">
              <!--<label for="cover_image">Выберете обложку альбома</label>-->
			  <!--<input type="file" class="filestyle" data-buttonText="kuku">-->
              {{Form::input('file','cover_image',null,['accept'=>'.jpg, .jpeg, .png','class'=>'filestyle',
				'data-input'=>'false','data-buttonText'=>'Выберите обложку альбома'])}}
            </div>
            <button type="submit" class="btnbtn-default">Создать</button>
          </fieldset>
        </form>
      </div>
    </div>
@endsection
