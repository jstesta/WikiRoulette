@extends('layouts.app')

@section('title', $title)

@section('content')
<h1>WikiRoulette!</h1>
<div>
	<a href="/refresh">Spin Again</a>
</div>
<div>
	<a href="/">Back to Results</a>
</div>
<hr nospace>
<div>
	<h2>
		{!! $page->getDisplayTitle() !!}
	</h2>
@if (!empty($page->getThumbnail()))
	<div>
		<img src="{{ $page->getThumbnail()->getOriginal() }}" height="150px">
	</div>
@endif
	<div>
@foreach ($page->getCategories() as $category)
	<p>{{ $category->getTitle() }}</p>
@endforeach
	</div>
</div>
@endsection
