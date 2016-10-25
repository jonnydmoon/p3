@extends('layouts.master')


@section('title')
    Image Generator
@stop

@section('pageTitle')
    Image Generator
@stop

@section('pageHelp')
    Convert an image to a new size or format.
@stop


@section('content')
	<form method="POST" action="?" enctype="multipart/form-data">
		<div class="form-group image-generator-form">

			<div class="">
				<input type="file" name="photo">
			</div>
    		{{ csrf_field() }}


			<div class="">
				<label>
					<span>Width (px):</span> <input name="width" type="text" value="{{ $width }}" />
				</label>
			</div>

			<div class="">
				<label>
					<span>Height (px):</span> <input name="height" type="text" value="{{ $height }}" />
				</label>
			</div>

			<div class="">
				<label>
					<span>Quality:</span> 
					<select name="quality" class="form-control">
						@for ($i = 1; $i <= 100; $i++)
							<option value="{{ $i }}" {{ $i === $quality ? 'selected' : '' }}>{{ $i }}</option>
						@endfor
					</select>
				</label>
			</div>
		</div>


		
		<button type="submit" name="userSubmitted" class="btn btn-success">Generate </button>
	</form>

	<div class='image-generator-container'>
		
		@if ($base64)
			<h2>Base64 Encoding</h2>
			<textarea><img src="{{$base64}}" /></textarea>
		@endif

		@foreach ($images as $image)
			<div>
				<h2>{{$image["name"]}}</h2>
				<img src='{{$image["src"]}}' />
			</div>
		@endforeach
	</div>
@stop

