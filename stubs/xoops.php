<?php

/**
 * PHPStan stubs for XOOPS framework classes used by smartyextensions.
 *
 * These stubs exist solely so static analysis can resolve types.
 * They are NOT loaded at runtime.
 */

class XoopsUser
{
    /** @return mixed */
    public function getVar(string $name, string $format = 's') {}

    /** @return list<string> */
    public function getGroups(): array { return []; }

    public function isAdmin(int $moduleId = 0): bool { return false; }

    public function hasPermission(string $permission): bool { return false; }
}

class XoopsModule
{
    /** @return mixed */
    public function getVar(string $name, string $format = 's') {}

    /** @return list<array{link: string, title: string}> */
    public function getAdminMenu(): array { return []; }

    public static function getByDirname(string $dirname): ?self { return null; }
}

class XoopsSecurity
{
    public function getTokenHTML(): string { return ''; }

    public function check(bool $clearIfValid = true): bool { return false; }
}

class XoopsGroupPermHandler
{
    /**
     * Check if a group has a specific permission.
     *
     * @param string       $gperm_name   Permission name
     * @param int          $gperm_itemid Item ID
     * @param list<string> $gperm_groupid Group IDs
     * @param int          $gperm_modid  Module ID
     */
    public function checkRight(string $gperm_name, int $gperm_itemid, array $gperm_groupid, int $gperm_modid = 1): bool
    {
        return false;
    }
}

/**
 * @return object
 */
function xoops_getHandler(string $name, bool $optional = false) {}
