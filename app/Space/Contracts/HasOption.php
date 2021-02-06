<?php

namespace App\Space\Contracts;

interface HasOption
{

    /**
     * Get option value
     *
     * @return string
     */
    public function getOptionValue(): string;

    /**
     * Get option text
     *
     * @return string
     */
    public function getOptionText(): string;
}
