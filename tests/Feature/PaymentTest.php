<?php

namespace Tests\Feature;

use App\Models\PaymentMethod;
use App\Models\User;
use App\PaymentMethodDTO;
use App\Services\PaymentMethodService;
use Database\Factories\PaymentMethodFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShowHasOneOfManyRelationship()
    {
        $user = User::factory()
            ->has(
                PaymentMethod::factory()
                    ->state(new Sequence(
                        ['is_preferred' => false],
                        ['is_preferred' => true],
                    ))
                    ->count(2)
            )
            ->create();

        $this->assertCount(2, $user->paymentMethods);
        $this->assertNotNull($user->preferredPaymentMethod);
    }

    public function testAddingPaymentMethodToUser()
    {
        /** @var PaymentMethodService $service */
        $service = app(PaymentMethodService::class);
        $user = User::factory()
            ->has(PaymentMethod::factory()->preferred())
            ->create();

        $service->attachPaymentToUser($user, new PaymentMethodDTO('random-token'), true);
        $user->refresh();

        $this->assertEquals('random-token', $user->preferredPaymentMethod->token);
        $this->assertCount(1, $user->paymentMethods()->where('is_preferred', true)->get());
    }
}
