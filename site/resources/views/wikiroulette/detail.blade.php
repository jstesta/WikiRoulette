@extends('layouts.app')

@section('title', $title)

@section('custom_nav')
<li><a href="/">Go Back</a></li>
@endsection

@section('content')
<div>
	<h2>
		{!! $page->getDisplayTitle() !!}
	</h2>
	<p><a href="{{ $page->getFullUrl() }}" target="_new">view on Wikipedia</a></p>
@if (!empty($page->getThumbnail()))
	<div>
		<img src="{{ $page->getThumbnail()->getOriginal() }}" height="250px" class="img-thumbnail" style="height:250px;">
		<br />
		<br />
	</div>
@endif
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Categories</h3>
		</div>
		<div class="panel-body">
			<div class="list-group">
@foreach ($page->getCategories() as $category)
				<a href="{{ $categoryUrl }}{{ htmlentities(str_replace(' ', '_', $category->getTitle())) }}" class="list-group-item" target="_new">{{ substr($category->getTitle(), strpos($category->getTitle(), ':') + 1) }}</a>
@endforeach
			</div>
		</div>
	</div>
</div>
@endsection
