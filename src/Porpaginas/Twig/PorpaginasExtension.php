<?php
/**
 * Porpaginas
 *
 * LICENSE
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to kontakt@beberlei.de so I can send you a copy immediately.
 */

namespace Porpaginas\Twig;

use Porpaginas\Page;

use Twig_Extension;
use Twig_SimpleFunction;
use Twig_Environment;

class PorpaginasExtension extends Twig_Extension
{
    /**
     * @var \Porpaginas\Twig\RenderingAdapter
     */
    private $adapter;

    public function __construct(RenderingAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('porpaginas_render', array($this, 'renderPagination'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new Twig_SimpleFunction('porpaginas_total', array($this, 'renderTotal')),
        );
    }

    public function renderPagination(Twig_Environment $environment, Page $page)
    {
        return $this->adapter->renderPagination($page, $environment);
    }

    public function renderTotal(Page $page)
    {
        return $page->totalCount();
    }

    public function getName()
    {
        return 'Porpaginas';
    }
}
