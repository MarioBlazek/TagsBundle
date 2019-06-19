<?php

namespace Netgen\TagsBundle\Core\REST\Output\ValueObjectVisitor;

use eZ\Publish\Core\MVC\ConfigResolverInterface;
use eZ\Publish\Core\MVC\Symfony\RequestStackAware;
use EzSystems\EzPlatformRest\Output\Generator;
use EzSystems\EzPlatformRest\Output\ValueObjectVisitor;
use EzSystems\EzPlatformRest\Output\Visitor;
use Symfony\Component\HttpFoundation\Request;

class CachedValue extends ValueObjectVisitor
{
    use RequestStackAware;

    /**
     * @var \eZ\Publish\Core\MVC\ConfigResolverInterface
     */
    private $configResolver;

    /**
     * Constructor.
     *
     * @param \eZ\Publish\Core\MVC\ConfigResolverInterface $configResolver
     */
    public function __construct(ConfigResolverInterface $configResolver)
    {
        $this->configResolver = $configResolver;
    }

    /**
     * Visit struct returned by controllers.
     *
     * @param \EzSystems\EzPlatformRest\Output\Visitor $visitor
     * @param \EzSystems\EzPlatformRest\Output\Generator $generator
     * @param \Netgen\TagsBundle\Core\REST\Values\CachedValue $data
     */
    public function visit(Visitor $visitor, Generator $generator, $data)
    {
        $visitor->visitValueObject($data->value);

        if ($this->getParameter('tag_view.cache', 'eztags') !== true) {
            return;
        }

        $response = $visitor->getResponse();
        $response->setPublic();
        $response->setVary('Accept');

        if ($this->getParameter('tag_view.ttl_cache', 'eztags') === true) {
            $response->setSharedMaxAge($this->getParameter('tag_view.default_ttl', 'eztags'));

            $request = $this->getCurrentRequest();
            if ($request instanceof Request && $request->headers->has('X-User-Hash')) {
                $response->setVary('X-User-Hash', false);
            }
        }

        if (isset($data->cacheTags['tagId'])) {
            $response->headers->set('X-Tag-Id', $data->cacheTags['tagId']);
        }

        if (isset($data->cacheTags['tagKeyword'])) {
            $response->headers->set('X-Tag-Keyword', $data->cacheTags['tagKeyword']);
        }
    }

    /**
     * Returns the parameter value from config resolver.
     *
     * @param string $parameterName
     * @param string $namespace
     * @param mixed $defaultValue
     *
     * @return mixed
     */
    private function getParameter($parameterName, $namespace, $defaultValue = null)
    {
        if ($this->configResolver->hasParameter($parameterName, $namespace)) {
            return $this->configResolver->getParameter($parameterName, $namespace);
        }

        return $defaultValue;
    }
}
