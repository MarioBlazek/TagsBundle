<?php

namespace Netgen\TagsBundle\Matcher;

use eZ\Publish\API\Repository\Repository;
use eZ\Publish\Core\Helper\TranslationHelper;
use eZ\Publish\Core\MVC\Symfony\Matcher\ClassNameMatcherFactory;
use eZ\Publish\Core\MVC\Symfony\Matcher\ViewMatcherInterface;
use InvalidArgumentException;
use Netgen\TagsBundle\API\Repository\TagsService;
use Netgen\TagsBundle\Matcher\Tag\MultipleValued;
use Netgen\TagsBundle\TagsServiceAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class TagMatcherFactory extends ClassNameMatcherFactory
{
    use ContainerAwareTrait;

    /**
     * @var \Netgen\TagsBundle\API\Repository\TagsService
     */
    private $tagsService;

    /**
     * @var \eZ\Publish\Core\Helper\TranslationHelper
     */
    private $translationHelper;

    public function __construct(
        TagsService $tagsService,
        TranslationHelper $translationHelper,
        Repository $repository
    ) {
        $this->tagsService = $tagsService;
        $this->translationHelper = $translationHelper;

        parent::__construct($repository, 'Netgen\TagsBundle\Matcher\Tag');
    }

    /**
     * Returns the matcher object.
     *
     * @param string $matcherIdentifier the matcher class.
     *        If it begins with a '\' it means it's a fully qualified class name,
     *        otherwise it is relative to provided namespace (if available)
     *
     * @throws \InvalidArgumentException If no matcher could be found
     *
     * @return \eZ\Publish\Core\MVC\Symfony\Matcher\ViewMatcherInterface
     */
    protected function getMatcher($matcherIdentifier): ViewMatcherInterface
    {
        if ($this->container->has($matcherIdentifier)) {
            return $this->container->get($matcherIdentifier);
        }

        $matcher = parent::getMatcher($matcherIdentifier);
        if (!$matcher instanceof ViewMatcherInterface) {
            throw new InvalidArgumentException(
                'Matcher for tags must implement ' . ViewMatcherInterface::class . '.'
            );
        }

        if ($matcher instanceof TagsServiceAwareInterface) {
            $matcher->setTagsService($this->tagsService);
        }

        if ($matcher instanceof MultipleValued) {
            $matcher->setTranslationHelper($this->translationHelper);
        }

        return $matcher;
    }
}
