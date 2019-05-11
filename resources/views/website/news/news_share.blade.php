<div class="mt-4">
    <span class="mr-2">{{ trans('website.news.share_on') }}</span>

    <a class="mx-1" href="https://www.facebook.com/sharer.php?u={{ $news->getPermalink() }}" title="Facebook" target="_blank">
        <i class="fab fa-facebook-square"></i>
    </a>

    <a class="mx-1" href="mailto:?subject={{ $news->title }}&body={{ $news->getPermalink() }}" title="Email">
        <i class="fas fa-envelope"></i>
    </a>
</div>
