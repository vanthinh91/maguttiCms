<aside class="mt-5 mt-md-0">
<h5 class="text-accent">{{__('website.news.latest')}}</h5>
    @foreach ( $getLatestPost(6) as $latest_post)
        <div class="d-flex news__sidebar">
            <a href="{{ $latest_post->getPermalink() }}" class="flex-shrink-0">
                <img class="img-fluid me-2"
                     src="{{ ImgHelper::get(optional($latest_post->imageMedia)->file_name,config('maguttiCms.image.small')) }}">
            </a>
            <div class="flex-grow-1 ms-3 news__sidebar-body">
                <small><b>{{ $latest_post->getFormattedDate() }}</b></small>
                <a class="d-block" href="{{ $latest_post->getPermalink() }}">{{ $latest_post->title }}</a>
            </div>
        </div>
    @endforeach
</aside>