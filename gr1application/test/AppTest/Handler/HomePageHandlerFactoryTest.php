<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\RequestTokenHandler;
use App\Handler\RequestTokenHandlerFactory;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;

class HomePageHandlerFactoryTest extends TestCase
{
    use ProphecyTrait;

    /** @var ContainerInterface|ObjectProphecy */
    protected $container;

    protected function setUp(): void
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $router          = $this->prophesize(RouterInterface::class);

        $this->container->get(RouterInterface::class)->willReturn($router);
    }

    public function testFactoryWithoutTemplate()
    {
        $factory = new RequestTokenHandlerFactory();
        $this->container->has(TemplateRendererInterface::class)->willReturn(false);

        self::assertInstanceOf(RequestTokenHandlerFactory::class, $factory);

        $homePage = $factory($this->container->reveal());

        self::assertInstanceOf(RequestTokenHandler::class, $homePage);
    }

    public function testFactoryWithTemplate()
    {
        $this->container->has(TemplateRendererInterface::class)->willReturn(true);
        $this->container
            ->get(TemplateRendererInterface::class)
            ->willReturn($this->prophesize(TemplateRendererInterface::class));

        $factory = new RequestTokenHandlerFactory();

        $homePage = $factory($this->container->reveal());

        self::assertInstanceOf(RequestTokenHandler::class, $homePage);
    }
}
