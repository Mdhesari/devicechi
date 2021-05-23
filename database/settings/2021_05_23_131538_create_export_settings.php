<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateExportSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('export.font_path', null);
    }
}
