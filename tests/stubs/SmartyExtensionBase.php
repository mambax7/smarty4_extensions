<?php

declare(strict_types=1);

namespace Xoops\SmartyExtensions\Test\Stubs;

/**
 * Minimal stub of \Smarty\Extension\Base for testing Smarty5Adapter.
 * Only loaded when Smarty 5 is NOT installed (Smarty 4 environment).
 *
 * Signatures must match the real Smarty 5 Extension\Base class
 * so that Smarty5Adapter's overrides are compatible.
 */
class SmartyExtensionBaseStub
{
    public function getModifierCallback(string $modifier): ?callable
    {
        return null;
    }

    public function getFunctionHandler(string $name): ?\Smarty\FunctionHandler\FunctionHandlerInterface
    {
        return null;
    }

    public function getBlockHandler(string $name): ?\Smarty\BlockHandler\BlockHandlerInterface
    {
        return null;
    }
}

// Provide Smarty 5 interface/class stubs when Smarty 5 is not installed
if (!interface_exists(\Smarty\FunctionHandler\FunctionHandlerInterface::class)) {
    eval('namespace Smarty\FunctionHandler; interface FunctionHandlerInterface { public function handle($params, \Smarty\Template $template); public function isCacheable(): bool; }');
}
if (!interface_exists(\Smarty\BlockHandler\BlockHandlerInterface::class)) {
    eval('namespace Smarty\BlockHandler; interface BlockHandlerInterface { public function handle($params, $content, \Smarty\Template $template, &$repeat); public function isCacheable(): bool; }');
}
if (!class_exists(\Smarty\Template::class)) {
    eval('namespace Smarty; class Template {}');
}

if (!class_exists(\Smarty\Extension\Base::class)) {
    class_alias(
        SmartyExtensionBaseStub::class,
        'Smarty\Extension\Base',
    );
}
