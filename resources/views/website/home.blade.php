@inject('pages','App\Article')
<?php $items = $pages::published()->get();?>
<x-website.layout>
    {{-- Header --}}
    <x-website.home.slider class="owl-theme"></x-website.home.slider>
	<x-website.partial.section :class="'bg-accent py-5'" classCaption="text-primary">
		<x-slot name="caption">{{$article->subtitle}}</x-slot>
		<h1 class="h1 text-white">{{$article->title}}</h1>
		<div class="px-0 px-lg-4 text-justify text-white">{!!  $article->description !!}</div>
	</x-website.partial.section>
	<x-website.ui.product-carousel :item="$items->find(13)" class="bg-color-5"></x-website.ui.product-carousel>
	<x-website.widgets.tags
		:item="$article->blockById(2)"
		class="bg-color-4 tags"
		classCaption="text-accent"
		color="text-white"
		buttonClass="btn-outline-accent"
	>
	</x-website.widgets.tags>
	<x-website.widgets.home_about :item="$items->find(2)" class="bg-white home_about"/>
</x-website.layout>
