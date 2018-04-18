@extends('layouts.app')

@section('title', 'Создать новый альбом')

@section('link')
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('navbar-brand', 'Альбомы')

@section('left-menu')
	<li><a href="{{URL::route('create_album_form')}}">Создать новый альбом</a></li>
@endsection
	
@section('content')
    <div class="container" style="text-align:center;">
      <div style="display: inline-block;margin-top:100px;">
        <form name="createnewalbum" data-toggle="validator" role="form" method="POST" action="{{URL::route('create_album')}}" enctype="multipart/form-data">
            {{ csrf_field() }}		
          <fieldset>
            <div class="form-group">
              <input name="name" type="text" class="form-control" placeholder="Имя альбома" value="{{old('name')}}" required data-error="Поле не должно быть пустым">
			  <div class="help-block with-errors"></div>
			</div>
            <div class="form-group">
              <textarea name="description" class="form-control" placeholder="Описание альбома" required data-error="Поле не должно быть пустым">{{old('description')}}</textarea>
			  <div class="help-block with-errors"></div>
			</div>			
            <div class="form-group">
              <!--<label for="cover_image">Выберете обложку альбома</label>-->
			  <!--<input type="file" class="filestyle" data-buttonText="kuku">-->
              {{Form::input('file','cover_image',null,['accept'=>'.jpg, .jpeg, .png','class'=>'filestyle',
				'data-input'=>'false','data-buttonText'=>'Выберите обложку альбома'])}}
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
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

