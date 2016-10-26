@extends('layouts.master')


@section('pageTitle')
    Welcome To The Toolbox
@stop


@section('content')

	<p>This website contains a few tools to make web development a little more easy.</p>

	<div class="row home-page-links">
		@foreach ($links as $link)
		<div class="col-sm-6">
			<a class="project-block" href="{{ $link['url'] }}">
				<i class="fa {{ $link['icon'] }} fa-4 project-screenshot" aria-hidden="true"></i>
				<h2>{{ $link['title'] }}</h2>
				<p>{{ $link['description'] }}</p>
			</a>
		</div>
		@endforeach
	</div>
@stop


