<?php

declare(strict_types=1);

namespace Xoops\SmartyExtensions;

/**
 * Base class for all XOOPS Smarty extensions.
 *
 * Subclasses override getModifiers(), getFunctions(), and/or getBlockHandlers()
 * to declare their plugins. The register() method handles Smarty 4 registration
 * via registerPlugin(). For Smarty 5, use Smarty5Adapter to wrap extensions.
 *
 * @copyright (c) 2000-2026 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 (https://www.gnu.org/licenses/gpl-2.0.html)
 */
abstract class AbstractExtension
{
    /**
     * @return array<string, callable> modifier name => callable
     */
    public function getModifiers(): array
    {
        return [];
    }

    /**
     * @return array<string, callable> function name => callable
     */
    public function getFunctions(): array
    {
        return [];
    }

    /**
     * @return array<string, callable> block name => callable
     */
    public function getBlockHandlers(): array
    {
        return [];
    }

    /**
     * Register all plugins with a Smarty 4 instance.
     *
     * @param \Smarty|\Smarty\Smarty $smarty
     */
    public function register(object $smarty): void
    {
        foreach ($this->getModifiers() as $name => $callback) {
            $smarty->registerPlugin('modifier', $name, $callback);
        }
        foreach ($this->getFunctions() as $name => $callback) {
            $smarty->registerPlugin('function', $name, $callback);
        }
        foreach ($this->getBlockHandlers() as $name => $callback) {
            $smarty->registerPlugin('block', $name, $callback);
        }
    }
}
