<?php
declare(strict_types=1);

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $order_code
 * @property int $detail_no
 * @property string $item_name
 * @property int $item_price
 * @property int $quantity
 * @property int $subtotal_price
 */
final class EloquentOrderDetail extends Model
{
    protected $table = 'order_details';

    public $timestamps = false;
}
