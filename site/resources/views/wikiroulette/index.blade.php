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
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Results</h3>
		</div>
		<div class="panel-body">
			<div class="list-group">
@foreach ($pages as $page)
				<a href="/detail/{{ $page->getId() }}" class="list-group-item">{{ $page->getTitle() }}</a>
@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
