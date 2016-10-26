
@extends( $mode === 'fullscreenEditor' || $mode === 'fullscreenSimple' ? 'layouts.fullscreen' : 'layouts.master')

@section('pageTitle')
    JSON Formatter
@stop

@section('pageHelp')
    A simple JSON formatter to easily view data.
@stop


@section('content')
	<form class="json-format-form" method="POST" action="?" onSubmit="return submitJSONForm()">
		{{ csrf_field() }}
		<select name="mode" class="form-control json-editor-select">
			<option value="editor"            {{ $mode === 'editor'           ? 'selected' : '' }}>Editor</option>
			<option value="fullscreenEditor"  {{ $mode === 'fullscreenEditor' ? 'selected' : '' }}>Fullscreen Editor</option>
			<option value="fullscreenSimple"  {{ $mode === 'fullscreenSimple' ? 'selected' : '' }}>Fullscreen Plain JSON</option>
		</select>
		<input type='hidden' name='text' id='hiddenTextInput'/>
		<button type="submit" class="btn btn-success">Format</button>
	</form>

	@if($mode === 'fullscreenSimple')
		<textarea id="editorTextarea">{{$text}}</textarea>
	@else
		<div id="editorAce">{{$text}}</div>
	@endif

	
	<script src="js/jsonFormatter.js"></script>
@stop

