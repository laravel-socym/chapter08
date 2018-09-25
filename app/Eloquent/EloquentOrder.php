<?php
declare(strict_types=1);

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $order_code
 * @property string $order_date
 * @property string $customer_name
 * @property string $customer_email
 * @property string $destination_name
 * @property string $destination_zip
 * @property string $destination_prefecture
 * @property string $destination_address
 * @property string $destination_tel
 * @property int $total_quantity
 * @property int $total_price
 */
final class EloquentOrder extends Model
{
    protected $table = 'orders';
}
