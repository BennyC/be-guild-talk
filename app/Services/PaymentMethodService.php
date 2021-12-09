<?php

namespace App\Services;

use App\Models\User;
use App\PaymentMethodDTO;
use Illuminate\Log\LogManager;

class PaymentMethodService
{
    public function __construct(
        protected LogManager $logger
    ) {}

    public function attachPaymentToUser(
        User $user,
        PaymentMethodDTO $method,
        bool $isPreferred = false
    ): void {
        if ($isPreferred) {
            $this->logger->info(
                'Removing preferred on all payment methods for User',
                ['user' => $user->getKey()]
            );

            $user->paymentMethods()->update(['is_preferred' => false]);
        }

        $user->paymentMethods()->create([
            'token' => $method->token,
            'is_preferred' => $isPreferred,
        ]);
    }
}
