<?php

namespace App\maguttiCms\Builders;

class ArticleBuilder extends LaraCmsBuilder
{
    public  function menuItems(){
        return $this->published()->menu()
            ->with(['parentPage' => function($query) {
                $query->published()->menu();
            }])
            ->orderBy('sort','Asc');
    }

    public function childrenMenu($id) {
        return $this->where('parent_id', $id)->where('top_menu', 1)->orderBy('sort', 'asc');
    }
    public function pageChildren($id = '') {
        return $this->where('parent_id', $id)->orderBy('sort', 'asc');
    }

    public function top() {
        return $this->where('parent_id', 0);
    }

    public function menu() {
        return $this->where('top_menu', 1);
    }
}
