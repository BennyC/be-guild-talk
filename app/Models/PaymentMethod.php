<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\PaymentMethodFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $token
 * @property bool $is_preferred
 * @property-read User $user
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @method static PaymentMethodFactory factory()
 */
class PaymentMethod extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'payment_methods';
    protected $guarded = ['id'];
    protected $casts = ['is_preferred' => 'boolean'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
