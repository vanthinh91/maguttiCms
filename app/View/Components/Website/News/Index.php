<?php

namespace App\View\Components\Website\News;


use App\News;
use Illuminate\View\Component;

class Index extends Component
{
    /**
     * @var News
     */
    public $news;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.news.index');
    }

    function posts(){

        $this->news = News::findPublished()->paginate(config('maguttiCms.website.option.pagination.news_index'));

        return  $this->news;
     }

    function paginate(){

        return $this->news->links();
    }
}
