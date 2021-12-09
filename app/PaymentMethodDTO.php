<?php

namespace App;

class PaymentMethodDTO
{
    public function __construct(
        public readonly string $token
    ) {}
}
