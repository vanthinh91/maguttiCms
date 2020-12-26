<?php

namespace App\maguttiCms\Domain\Project;

use App\maguttiCms\Domain\Website\WebsiteViewModel;
use App\Project;


class ProjectViewModel extends WebsiteViewModel
{
    function show($slug)
    {
        $project = Project::findBySlug($slug, app()->getLocale());
        $article = $this->getCurrentPage();
        if ($project) {
            $category = $project->category;
            $locale_article = $project;
            $this->setSeo($project);
            return view('website.project', compact('article', 'project', 'category', 'locale_article'));
        }
        return $this->handleMissingPage();
    }

    function handle($slug)
    {
        return ($slug == '') ? $this->index() : $this->show($slug);
    }
}