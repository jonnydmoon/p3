@extends('layouts.master')

@section('title', 'Lorem Ipsum Generator')

@section('pageHelp')
	Modify the options below to generate some lorem ipsum place holder content.
@stop


@section('content')
	<form method="GET" action="?">
		<div class="form-group">
			<select name="numberOfParagraphs" class="form-control">
				<option value="1" <?= $numberOfParagraphs === 1 ? 'selected' : '' ?>>1 paragraph</option>
				@for ($i = 2; $i <= 99; $i++)
				    <option value="{{ $i }}" {{ $i === $numberOfParagraphs ? 'selected' : '' }}>{{ $i }} paragraphs</option>
				@endfor
			</select>

			<select name="paragraphLength" class="form-control">
				<option value="1" <?= $paragraphLength === 1 ? 'selected' : '' ?>>Small Paragraphs</option>
				<option value="4" <?= $paragraphLength === 4 ? 'selected' : '' ?>>Medium Paragraphs</option>
				<option value="6" <?= $paragraphLength === 6 ? 'selected' : '' ?>>Large Paragraphs</option>

			</select>
		</div>
		
		<button type="submit" class="btn btn-success">Generate </button>
	</form>

	<div class='lorem-ipsum-container'>
		{!! nl2br($words) !!}
	</div>
@stop

