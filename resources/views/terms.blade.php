@extends('layouts.legal')

@section('page-name', 'terms')

@section('content')



	<h1 class="section-content__title">General terms and conditions</h1>


	<div class="section-content__date">
		<span>Last modified: </span>
		<time>{{ $lastModified }}</time>
	</div>

	{!! $content !!}



@endsection
