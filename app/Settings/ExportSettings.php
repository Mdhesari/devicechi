<?php

namespace App\Settings;

use App\Models\Settings;

class ExportSettings extends Settings
{
    public ?string $font_path = null;

    public static function group(): string
    {
        return 'export';
    }
}
