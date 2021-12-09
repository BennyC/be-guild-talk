<?php

namespace App\Enums;

enum PostStatus: int
{
    case Draft = 0;
    case Published = 1;
    case Private = 2;

    public function visible(): bool
    {
        return match ($this) {
            self::Draft, self::Private => false,
            self::Published => true,
        };
    }
}
