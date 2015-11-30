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
		<p><a href="/detail/{{ $page->getId() }}">{{ $page->getTitle() }}</a></p>
	</div>
@endforeach
</div>
@endsection
