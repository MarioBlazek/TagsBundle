<?php

namespace Netgen\TagsBundle\View\Provider;

use eZ\Publish\Core\MVC\Symfony\Matcher\MatcherFactoryInterface;
use eZ\Publish\Core\MVC\Symfony\SiteAccess;
use eZ\Publish\Core\MVC\Symfony\SiteAccess\SiteAccessAware;
use eZ\Publish\Core\MVC\Symfony\View\View;
use eZ\Publish\Core\MVC\Symfony\View\ViewProvider;
use Netgen\TagsBundle\View\TagView;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

class TagViewProvider implements ViewProvider, SiteAccessAware
{
    /**
     * @var \eZ\Publish\Core\MVC\Symfony\Matcher\MatcherFactoryInterface
     */
    protected $matcherFactory;

    public function __construct(MatcherFactoryInterface $matcherFactory)
    {
        $this->matcherFactory = $matcherFactory;
    }

    /**
     * Matches the view with the matching config.
     */
    public function getView(View $view): View
    {
        if (($configHash = $this->matcherFactory->match($view)) === null) {
            return null;
        }

        return $this->buildTagView($configHash);
    }

    /**
     * Changes the site access.
     */
    public function setSiteAccess(?SiteAccess $siteAccess = null): void
    {
        if ($this->matcherFactory instanceof SiteAccessAware) {
            $this->matcherFactory->setSiteAccess($siteAccess);
        }
    }

    /**
     * Builds a TagView object from $viewConfig.
     */
    protected function buildTagView(array $viewConfig): TagView
    {
        $view = new TagView();
        $view->setConfigHash($viewConfig);

        if (isset($viewConfig['template'])) {
            $view->setTemplateIdentifier($viewConfig['template']);
        }

        if (isset($viewConfig['controller'])) {
            $view->setControllerReference(new ControllerReference($viewConfig['controller']));
        }

        return $view;
    }
}
