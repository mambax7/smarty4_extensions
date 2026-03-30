<?php

/**
 * PHPStan stubs for Smarty 5 interfaces.
 */

namespace Smarty\FunctionHandler;

interface FunctionHandlerInterface
{
    /** @param array<string, mixed> $params */
    public function handle($params, \Smarty\Template $template): mixed;

    public function isCacheable(): bool;
}

namespace Smarty\BlockHandler;

interface BlockHandlerInterface
{
    /** @param array<string, mixed> $params */
    public function handle($params, $content, \Smarty\Template $template, &$repeat): mixed;

    public function isCacheable(): bool;
}

namespace Smarty;

class Template {}
