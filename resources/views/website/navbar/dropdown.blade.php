<li class="nav-item dropdown">
	<a class="nav-link {{$active}}
			dropdown-toggle"
	        id="dd_{{$page->slug}}"
	        data-bs-toggle="dropdown" aria-expanded="false"
	        href="#" data-bs-toggle="dropdown" title="{{$page->alt_seo_title}}">
		    {{$page->nav_title}} {{icon('chevron-down ms-1')}}
	</a>
	<div class="dropdown-menu" aria-labelledby="dd_{{$page->slug}}">
		@foreach ($children as $index => $child)
			@php
				$active = (!empty($current_page) && $child->id == $current_page->id) ? 'active' : '';
			@endphp
			<a class="dropdown-item {{$active}}" href="{{$child->nav_link}}" title="{{$child->alt_seo_title}}">
				{{$child->nav_title}}
			</a>
		@endforeach
	</div>
</li>

