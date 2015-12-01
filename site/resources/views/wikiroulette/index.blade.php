@extends('layouts.app')

@section('title', $title)

@section('custom_nav')
<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Language<span class="caret"></span></a>
	<ul class="dropdown-menu">
@foreach ($languages as $code => $language)
		<li><a href="/locale/{{ $code }}">{{ $language }}</a></li>
@endforeach
	</ul>
</li>
@endsection

@section('content')
<div>
@foreach ($pages as $page)
	<div>
		<p><a href="/detail/{{ $page->getId() }}">{{ $page->getTitle() }}</a></p>
	</div>
@endforeach
</div>
@endsection
