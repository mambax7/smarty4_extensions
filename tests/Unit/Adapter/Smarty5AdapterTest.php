<?php

declare(strict_types=1);

namespace Xoops\SmartyExtensions\Test\Unit\Adapter;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Xoops\SmartyExtensions\AbstractExtension;
use Xoops\SmartyExtensions\Adapter\Smarty5Adapter;

#[CoversClass(Smarty5Adapter::class)]
final class Smarty5AdapterTest extends TestCase
{
    private function createTestExtension(): AbstractExtension
    {
        return new class extends AbstractExtension {
            public function getModifiers(): array
            {
                return ['test_upper' => strtoupper(...)];
            }
            public function getFunctions(): array
            {
                return ['test_func' => fn(array $p, object $t): string => 'hello'];
            }
            public function getBlockHandlers(): array
            {
                return ['test_block' => fn(array $p, ?string $c, object $t, bool &$r): string => $c ?? ''];
            }
        };
    }

    #[Test]
    public function getModifierCallbackReturnsCallableForKnownModifier(): void
    {
        $adapter = new Smarty5Adapter($this->createTestExtension());

        $callback = $adapter->getModifierCallback('test_upper');
        $this->assertNotNull($callback);
        $this->assertSame('HELLO', $callback('hello'));
    }

    #[Test]
    public function getModifierCallbackReturnsNullForUnknownModifier(): void
    {
        $adapter = new Smarty5Adapter($this->createTestExtension());
        $this->assertNull($adapter->getModifierCallback('unknown'));
    }

    #[Test]
    public function getFunctionHandlerReturnsCallableForKnownFunction(): void
    {
        $adapter = new Smarty5Adapter($this->createTestExtension());

        $handler = $adapter->getFunctionHandler('test_func');
        $this->assertNotNull($handler);
    }

    #[Test]
    public function getFunctionHandlerReturnsNullForUnknownFunction(): void
    {
        $adapter = new Smarty5Adapter($this->createTestExtension());
        $this->assertNull($adapter->getFunctionHandler('unknown'));
    }

    #[Test]
    public function getBlockHandlerReturnsCallableForKnownBlock(): void
    {
        $adapter = new Smarty5Adapter($this->createTestExtension());

        $handler = $adapter->getBlockHandler('test_block');
        $this->assertNotNull($handler);
    }

    #[Test]
    public function getBlockHandlerReturnsNullForUnknownBlock(): void
    {
        $adapter = new Smarty5Adapter($this->createTestExtension());
        $this->assertNull($adapter->getBlockHandler('unknown'));
    }
}
