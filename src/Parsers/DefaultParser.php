<?php

namespace Sven\FlexEnv\Parsers;

use Illuminate\Support\Collection;
use Sven\FlexEnv\Contracts\ParserInterface;

class DefaultParser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function parse(string $contents)
    {
        $parts = new Collection(explode(PHP_EOL, $contents));

        return $parts->filter(function (string $value) {
            return $value !== '' && preg_match('~[a-z0-9_]=(.+)~i', $value);
        });
    }
}
