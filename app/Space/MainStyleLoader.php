<?php

namespace App\Space;

use App\Space\Contracts\StyleLoader;
use Str;

class MainStyleLoader implements StyleLoader
{

    public function render(array $styles): string
    {
        $template = "";

        foreach ($styles as $style) {

            $template .= $this->getLinkElement($style);
        }

        return $template;
    }

    private function getLinkElement($style)
    {
        $style = trim($style);

        $is_local = !Str::of($style)->contains(['http', 'https']);

        if ($is_local)
            $style = asset($style);

        return sprintf('<link rel="stylesheet" href="%s">', $style) . PHP_EOL;
    }
}
