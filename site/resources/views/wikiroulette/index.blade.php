@extends('layouts.app')

@section('title', $title)

@section('content')
<h1>WikiRoulette!</h1>
<div>
	<a href="/refresh">Spin Again</a>
</div>
<hr nospace>
<div>
@foreach ($pages as $page)
	<div>
		<p>{{ $page->getId() }}</p>
		<p>{{ $page->getTitle() }}</p>
	</div>
@endforeach
</div>
@endsection
