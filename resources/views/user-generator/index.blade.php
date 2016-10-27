@extends('layouts.master')

@section('title', 'User Generator')

@section('pageHelp')
    Modify the options below to generate user profiles.
@stop

@section('content')
	<form method="GET" action="?">
		<div class="form-group">
			<select name="numberOfUsers" class="form-control">
				<option value="1" <?= $numberOfUsers === 1 ? 'selected' : '' ?>>1 user</option>
				@for ($i = 2; $i <= 99; $i++)
					<option value="{{ $i }}" {{ $i === $numberOfUsers ? 'selected' : '' }}>{{ $i }} users</option>
				@endfor
			</select>
		
			<div class="checkbox">
				<label>
					<input name="includeBirthdate" type="checkbox" {{ $includeBirthdate === 'on' ? 'checked' : '' }}> Include Birthdate
				</label>
			</div>

			<div class="checkbox">
				<label>
					<input name="includePhoto" type="checkbox" {{ $includePhoto === 'on' ? 'checked' : '' }}> Include Photo
				</label>
			</div>

			<select name="format" class="form-control">
				<option value="html" <?= $format === 'html' ? 'selected' : '' ?>>HTML Format</option>
				<option value="json" <?= $format === 'json' ? 'selected' : '' ?>>JSON Format</option>
			</select>
		</div>
		<button type="submit" class="btn btn-success">Generate</button>
	</form>

	<div class='user-container'>
		@if($format === 'html')
			@foreach ($users as $user)
				<div class="user-card">
					@if ($includePhoto === 'on')
						<img class='user-profile' src="{{ $user['profile'] }}" />
					@endif
					<span class="user-name">{{ $user['firstName'] }} {{ $user['lastName'] }}</span><br /> 
					{{ $user['address'] }}<br />
					{{ $user['city'] }}, {{ $user['state'] }} {{ $user['zip'] }}<br /><br />
					@if ($includeBirthdate === 'on')
						Birthdate: {{ $user['birthdate'] }}
					@endif
				</div>
			@endforeach
		@endif

		@if($format === 'json')
			<textarea class="user-content-json">{{ json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</textarea>
		@endif
	</div>

	<span class="small-text">* All user information and addresses are randomly generated. Profile pictures are from <a href="http://uifaces.com">uifaces.com</a></span>
@stop

