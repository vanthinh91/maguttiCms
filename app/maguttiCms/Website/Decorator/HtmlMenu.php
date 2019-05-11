<?php

namespace App\maguttiCms\Website\Decorator;

use Auth;
use StoreHelper;
use LaravelLocalization;

use App\Article;

/**
 * Class HtmlMenu
 * @package App\maguttiCms\Website\Decorator
 */
class HtmlMenu extends MaguttiCmsDecorator
{

	protected $currentPage;

	/**
	 * This method is used to set the current page.
	 */
	public function setCurrentPage($article)
	{

		$this->currentPage = $article;

		return $this;
	}

    /**
     * This method is used to create the navbar html.
     */
    public function navbar()
    {

		$html = '<ul class="navbar-nav ml-auto">';

			// Add articles in navbar.
			$html .= $this->getArticlesLinks();

			// Add auth links in navbar.
			$html .= $this->getAuthLinks();

			// Add store links in navbar.
			$html .= $this->getStoreLinks();

			// Add language selector in navbar.
			$html .= $this->getLanguageSelector();

		$html .= '</ul>';

		return $html;
    }

	/**
	 * This method is used to get the articles links html.
	 */
	protected function getArticlesLinks()
	{

		$html = '';

		$menu = Article::menuItems()->get();
		$top = $menu->where('parent_id', 0);

		foreach($top as $index => $page) {
            $children =[];
            $page_title = ($page->menu_title) ? $page->menu_title : $page->title;
			if ($page->slug == 'home') {
				$page_link = '/';
			}
			else if ($page->link) {
				$page_link = $page->link;
			}
			else {
				$page_link = $page->getPermalink();
				$children = $menu->where('parent_id',$page->id) ;
			}

			if(optional($children)->count() > 0) {

				$active = (!empty($this->currentPage) && ($this->currentPage->id == $page->id || $this->currentPage->parent_id == $page->id)) ? 'active' : '';
				$html .= '<li class="nav-item dropdown '. $active .'">';
					$html .= '<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="'. $page_title .'">'. $page_title .'</a>';

					$html .= '<div class="dropdown-menu">';
					foreach ($children as $index => $child) {

						if ($child->slug == 'home') {

							$child_link = '/';
						}
						else if ($child->link) {

							$child_link = $child->link;
						}
						else {

							$child_link = $child->getPermalink();
							$child_title = ( $child->menu_title ) ? $child->menu_title : $child->title;
						}

						$active = (!empty($this->currentPage) && $child->id == $this->currentPage->id) ? 'active' : '';
						$html .= '<a class="dropdown-item '. $active .'" href="'. $child_link .'" title="'. $child_title .'">'. $child_title .'</a>';
					}
					$html .= '</div>';
				$html .= '</li>';
			}
			else {

				$active = (!empty($this->currentPage) && $this->currentPage->id == $page->id) ? 'active' : '';
				$html .= '<li class="nav-item '. $active .'">
					<a class="nav-link" href="'. $page_link .'" title="'. $page_title .'">
						'. $page_title .'
					</a>
				</li>';
			}
		}

		return $html;
	}

	/**
	 * This method is used to get the auth links html.
	 */
	protected function getAuthLinks()
	{

		$html = '';

		if(!Auth::guard()->check()) {

			$html .= '<li class="nav-item">
				<a class="nav-link" href="'. url_locale('users/login') .'">Login</a>
			</li>';
		}
		else {

			$html .= '<li class="nav-item dropdown">';
				$html .= '<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'. Auth::guard()->user()->name .'</a>';

				$html .= '<div class="dropdown-menu">';
					$html .= '<a class="dropdown-item" href="'. url_locale('users/dashboard') .'">
						'. icon('list', '', '', false) .' Dashboard
					</a>';

					$html .= '<a class="dropdown-item" href="'. url_locale('users/profile') .'">
						'. icon('user', '', '', false) .' Profile
					</a>';

					$html .= '<a class="dropdown-item" href="'. url_locale('users/logout') .'">
						'. icon('sign-out', '', '', false) .' Logout
					</a>';
				$html .= '</div>';
			$html .= '</li>';
		}

		return $html;
	}

	/**
	 * This method is used to get the store links html.
	 */
	protected function getStoreLinks()
	{

		$html = '';

		if(StoreHelper::isStoreEnabled()) {

			$storeCartItemCount = StoreHelper::getCartItemCount();
			$cartItems = ($storeCartItemCount > 0) ? $storeCartItemCount : '';

			$html .= '<li class="nav-item">
				<a class="nav-link" href="'. url_locale('cart') .'">

					'. icon(config('maguttiCms.store.cart.icon'), '', '', false)  .'
					<span class="cart-count badge badge-primary">'. $cartItems .'</span>
				</a>
			</li>';
		}

		return $html;
	}

	/**
	 * This method is used to get the language selector html.
	 */
	protected function getLanguageSelector()
	{

		$html = '';

		if(sizeOf(LaravelLocalization::getSupportedLocales()) > 1) {

			$html .= '<li class="nav-item dropdown">';

				$html .= '<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img class="flag" src="'. asset('website/images/flags/'.LaravelLocalization::getCurrentLocale().'.png') .'" width3040" height="20" alt="'. LaravelLocalization::getCurrentLocale() .'">
						</a>';

				$html .= '<div class="dropdown-menu dropdown-menu-right">';

					foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
						if(LaravelLocalization::getCurrentLocale() != $localeCode) {
							if (isset($this->currentPage) && !$this->currentPage->ignore_slug_translation) {
								$article_locale = (isset($locale_article)) ? $locale_article : $this->currentPage;

								$html .= '<a class="dropdown-item" href="'. LaravelLocalization::getLocalizedURL($localeCode, $article_locale->getPermalink($localeCode)) .'">
									<img src="'. asset('website/images/flags/'.$localeCode.'.png') .'" width="30" height="20" alt="'. LaravelLocalization::getCurrentLocale() .'">
									'. $properties['native'] .'
								</a>';
							}
							else {

								$html .= '<a class="dropdown-item" href="'. LaravelLocalization::getLocalizedURL($localeCode) .'">
									<img src="'. asset('website/images/flags/'.$localeCode.'.png') .'" width="30" height="20" alt="'. LaravelLocalization::getCurrentLocale() .'">
									'. $properties['native'] .'
								</a>';
							}
						}
					}

				$html .= '</div>';
			$html .= '</li>';
		}

		return $html;
	}
}
