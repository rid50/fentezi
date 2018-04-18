@extends('layouts.app')

@section('title', 'Контакт форм')

@section('link')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
@endsection

@section('navbar-brand', 'Альбомы')

@section('left-menu')
@endsection
	
@section('content')
    <div class="container" style="text-align: center;">
      <div style="display: inline-block;margin-top:20px;">
		@if(Session::has('success'))
		   <div class="alert alert-success">
			 {{ Session::get('success') }}
		   </div>
		@endif	  
        <form name="createnewalbum" data-toggle="validator" role="form" method="POST" action="{{URL::route('contact.send')}}" enctype="multipart/form-data">
            {{ csrf_field() }}		
          <fieldset>
		    <legend>Введите имя, почтовый адрес и сообщение</legend>
            <div class="form-group">
              <input name="name" type="text" class="form-control" placeholder="Ваше имя" value="{{old('name')}}" required data-error="Поле не должно быть пустым">
			  <div class="help-block with-errors"></div>
			</div>
            <div class="form-group">
              <input name="email" type="text" class="form-control" placeholder="Ваш электронный почтовый адрес" value="{{old('email')}}" required data-error="Поле не должно быть пустым">
			  <div class="help-block with-errors"></div>
			</div>
            <div class="form-group">
              <textarea name="msg" class="form-control" placeholder="Сообщение" required data-error="Поле не должно быть пустым">{{old('msg')}}</textarea>
			  <div class="help-block with-errors"></div>
			</div>			
            <button type="submit" class="btn btn-info">Отправить</button>
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
        @endif	  
	  </div>
	</div>
@endsection

@section('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="{{URL::asset('js/bootstrap-filestyle.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('js/validator.min.js')}}" charset="utf-8"></script>
@endsection

