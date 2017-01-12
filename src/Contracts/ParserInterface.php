<?php

namespace Sven\FlexEnv\Contracts;

use Illuminate\Support\Collection;

interface ParserInterface
{
    /**
     * Parse the contents of a file into a collection object.
     *
     * @param string $contents
     *
     * @return Collection
     */
    public function parse(string $contents);
}
