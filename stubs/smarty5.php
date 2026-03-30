<?php

/**
 * PHPStan stubs for Smarty 5 classes.
 *
 * When Composer resolves Smarty 4 (lowest deps), these Smarty 5 classes
 * don't exist. This stub ensures PHPStan can still analyse the adapter.
 * When Smarty 5 is installed, PHPStan uses the real classes instead.
 */

namespace Smarty\Extension;

class Base
{
    public function getModifierCallback(string $modifierName): ?callable { return null; }

    /** @return \Smarty\FunctionHandler\FunctionHandlerInterface|null */
    public function getFunctionHandler(string $functionName): ?\Smarty\FunctionHandler\FunctionHandlerInterface { return null; }

    /** @return \Smarty\BlockHandler\BlockHandlerInterface|null */
    public function getBlockHandler(string $blockTagName): ?\Smarty\BlockHandler\BlockHandlerInterface { return null; }
}
