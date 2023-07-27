<?php

namespace App\Space;

use App\Space\Contracts\ScriptLoader;
use Str;

class MainScriptLoader implements ScriptLoader
{

    public function render(array $scripts): string
    {
        $template = "";

        foreach ($scripts as $script) {

            $template .= $this->getLinkElement($script);
        }

        return $template;
    }

    private function getLinkElement($script)
    {
        $script = trim($script);

        $is_local = !Str::of($script)->contains(['http', 'https']);

        if ($is_local)
            $script = asset($script);

        return sprintf('<script src="%s"></script>', $script) . PHP_EOL;
    }
}
