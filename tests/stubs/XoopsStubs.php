<?php

declare(strict_types=1);

/**
 * Minimal stubs for XOOPS classes used by SecurityExtension tests.
 * Only loaded when the real XOOPS classes are not available (standalone test env).
 *
 * @copyright (c) 2000-2026 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 (https://www.gnu.org/licenses/gpl-2.0.html)
 */

if (!class_exists('XoopsSecurity', false)) {
    class XoopsSecurity
    {
        public function getTokenHTML(): string
        {
            return '<input type="hidden" name="token" value="test-token">';
        }

        public function check(bool $clearIfValid = false): bool
        {
            return true;
        }
    }
}

if (!class_exists('XoopsGroupPermHandler', false)) {
    class XoopsGroupPermHandler
    {
        /**
         * @param string       $gperm_name
         * @param int          $gperm_itemid
         * @param list<string> $gperm_groupid
         * @param int          $gperm_modid
         */
        public function checkRight(string $gperm_name, int $gperm_itemid, array $gperm_groupid, int $gperm_modid = 1): bool
        {
            return false;
        }
    }
}

if (!class_exists('XoopsUser', false)) {
    class XoopsUser
    {
        public function isAdmin(int $moduleId = 0): bool
        {
            return false;
        }

        /**
         * @return list<int|string>
         */
        public function getGroups(): array
        {
            return [];
        }
    }
}
