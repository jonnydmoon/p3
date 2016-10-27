@extends('layouts.master')

@section('title', 'Password Generator')

@section('pageHelp')
    Modify the options below to create a password inspired by the XKCD web comic.
@stop

@section('content')
	<form method="GET" action="?">
		<div class="form-group">
			<select name="numberOfWords" class="form-control">
				<option value="1" <?= $numberOfWords === 1 ? 'selected' : '' ?>>1 word</option>
				@for ($i = 2; $i <= 9; $i++)
				    <option value="{{ $i }}" {{ $i === $numberOfWords ? 'selected' : '' }}>{{ $i }} words</option>
				@endfor
			</select>

			<select name="delimiter" class="form-control">
				<option value="hyphen"  {{ $delimiter === 'hyphen'  ? 'selected' : '' }}>hyphenate-words</option>
				<option value="nospace" {{ $delimiter === 'nospace' ? 'selected' : '' }}>nospaces</option>
				<option value="space"   {{ $delimiter === 'space'   ? 'selected' : '' }}>space words</option>
			</select>

			<select name="textTransform" class="form-control">
				<option value="camel"    {{ $textTransform === 'camel'    ? 'selected' : '' }}>camelCase</option>
				<option value="upper"    {{ $textTransform === 'upper'    ? 'selected' : '' }}>UPPERCASE</option>
				<option value="lower"    {{ $textTransform === 'lower'    ? 'selected' : '' }}>lowercase</option>
				<option value="title"    {{ $textTransform === 'title'    ? 'selected' : '' }}>Title Case</option>
				<option value="sentence" {{ $textTransform === 'sentence' ? 'selected' : '' }}>Sentence Case</option>
			</select>
		</div>
		<div class="checkbox">
			<label>
			  <input name="includeNumber" type="checkbox" {{ $includeNumber === 'on' ? 'checked' : '' }}> Add a number
			</label>
		</div>
		<div class="checkbox">
			<label>
			  <input name="includeSymbol" type="checkbox" {{ $includeSymbol === 'on' ? 'checked' : '' }}> Add a symbol
			</label>
		</div>

		<button type="submit" class="btn btn-success">Generate New Password</button>
	</form>

	<div class='password-holder'>
		<h1 class="password">{{ $password }}</h1>
	</div>
@stop

