<?php

namespace App\Services\OpenAi\Contracts;

interface OpenAiServiceContract
{
    /**
     * @return void
     */
    public function getSummary(): void;
}
