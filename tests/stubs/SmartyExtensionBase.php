<?php

declare(strict_types=1);

namespace Xoops\SmartyExtensions\Test\Stubs;

/**
 * Minimal stub of \Smarty\Extension\Base for testing Smarty5Adapter.
 * Only loaded when Smarty 5 is NOT installed (Smarty 4 environment).
 */
class SmartyExtensionBaseStub
{
    public function getModifierCallback(string $modifier): ?callable
    {
        return null;
    }

    public function getFunctionHandler(string $name): ?callable
    {
        return null;
    }

    public function getBlockHandler(string $name): ?callable
    {
        return null;
    }
}

if (!class_exists(\Smarty\Extension\Base::class)) {
    class_alias(
        SmartyExtensionBaseStub::class,
        'Smarty\Extension\Base',
    );
}
