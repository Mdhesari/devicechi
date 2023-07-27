<?php

namespace App\Space\Contracts;

interface ScriptLoader
{

    /**
     * Render styles
     *
     * @param  array $styles
     * @return string
     */
    public function render(array $styles): string;
}
