<?php
declare(strict_types=1);

use App\Eloquent\EloquentOrder;
use App\Eloquent\EloquentOrderDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** @var \Illuminate\Database\Connection */
    private $db;

    /**
     * @param \Illuminate\Database\Connection $db
     */
    public function __construct(\Illuminate\Database\Connection $db)
    {
        $this->db = $db;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Throwable
     */
    public function run()
    {
        $this->db->transaction(function () {
            $this->db->statement('SET FOREIGN_KEY_CHECKS=0;');
            EloquentOrderDetail::truncate();
            EloquentOrder::truncate();
            $this->db->statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->orders();
            $this->orderDetails();
        });
    }

    private function orders()
    {
        EloquentOrder::create([
            'order_code'             => '1111-1111-1111-1111',
            'order_date'             => '2018-06-29 00:00:00',
            'customer_name'          => '大阪 太郎',
            'customer_email'         => 'osaka@example.com',
            'destination_name'       => '送付先 太郎',
            'destination_zip'        => '1234567',
            'destination_prefecture' => '大阪府',
            'destination_address'    => '送付先住所1',
            'destination_tel'        => '06-0000-0000',
            'total_quantity'         => 1,
            'total_price'            => 1000,
        ]);

        EloquentOrder::create([
            'order_code'             => '1111-1111-1111-1112',
            'order_date'             => '2018-06-29 23:59:59',
            'customer_name'          => '神戸 花子',
            'customer_email'         => 'kobe@example.com',
            'destination_name'       => '送付先 太郎',
            'destination_zip'        => '1234567',
            'destination_prefecture' => '兵庫県',
            'destination_address'    => '送付先住所2',
            'destination_tel'        => '078-0000-0000',
            'total_quantity'         => 3,
            'total_price'            => 2500,
        ]);

        EloquentOrder::create([
            'order_code'             => '1111-1111-1111-1113',
            'order_date'             => '2018-06-30 00:00:00',
            'customer_name'          => '奈良 次郎',
            'customer_email'         => 'nara@example.com',
            'destination_name'       => '送付先 次郎',
            'destination_zip'        => '1234567',
            'destination_prefecture' => '奈良県',
            'destination_address'    => '送付先住所3',
            'destination_tel'        => '0742-0000-0000',
            'total_quantity'         => 1,
            'total_price'            => 2000,
        ]);
    }

    private function orderDetails()
    {
        EloquentOrderDetail::create([
            'order_code'     => '1111-1111-1111-1111',
            'detail_no'      => 1,
            'item_name'      => '商品1',
            'item_price'     => 1000,
            'quantity'       => 1,
            'subtotal_price' => 1000,
        ]);

        EloquentOrderDetail::create([
            'order_code'     => '1111-1111-1111-1112',
            'detail_no'      => 1,
            'item_name'      => '商品1',
            'item_price'     => 1000,
            'quantity'       => 2,
            'subtotal_price' => 2000,
        ]);
        EloquentOrderDetail::create([
            'order_code'     => '1111-1111-1111-1112',
            'detail_no'      => 2,
            'item_name'      => '商品2',
            'item_price'     => 500,
            'quantity'       => 1,
            'subtotal_price' => 500,
        ]);

        EloquentOrderDetail::create([
            'order_code'     => '1111-1111-1111-1113',
            'detail_no'      => 1,
            'item_name'      => '商品3',
            'item_price'     => 2000,
            'quantity'       => 1,
            'subtotal_price' => 2000,
        ]);
    }
}
