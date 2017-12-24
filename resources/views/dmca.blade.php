@extends('layouts.legal')

@section('page-name', 'dmca')

@section('content')


	<h1 class="section-content__title">The Digital Millennium Copyright Act</h1>

	<div class="section-content__date">
		<span>Last modified: </span>
		<time>{{ $lastModified }}</time>
	</div>

	{!! $content !!}
	
@endsection
