<?php

/**
 * PHPStan stubs for spatie/ray.
 */

namespace Spatie\Ray {
    class Ray
    {
        /** @return $this */
        public function label(string $label): self { return $this; }

        /** @return $this */
        public function color(string $color): self { return $this; }

        /** @return $this */
        public function table(mixed ...$args): self { return $this; }
    }
}

namespace {
    /**
     * @param mixed ...$args
     * @return \Spatie\Ray\Ray
     */
    function ray(mixed ...$args): \Spatie\Ray\Ray { return new \Spatie\Ray\Ray(); }
}
