@extends('layouts.master')


@section('title')
    User Generator
@stop

@section('pageTitle')
    User Generator
@stop

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

		</div>


		
		<button type="submit" class="btn btn-success">Generate </button>
	</form>

	<div class='user-container'>
		@foreach ($users as $user)
			<div>
				@if ($includePhoto === 'on')
					<img src="{{ $user['profile'] }}" />
				@endif
				{{ $user['firstName'] }}
				{{ $user['lastName'] }}, 
				{{ $user['street'] }},
				{{ $user['city'] }},
				{{ $user['state'] }}
				{{ $user['zip'] }}
				@if ($includeBirthdate === 'on')
					{{ $user['birthdate'] }}
				@endif
			</div>
		@endforeach
	</div>
@stop

