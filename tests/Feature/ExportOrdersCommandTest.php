<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExportOrdersCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @var Kernel */
    private $artisan;

    protected function setUp()
    {
        parent::setUp();

        $this->artisan = app(Kernel::class);
        $this->seed();
    }

    /**
     * @test
     */
    public function execute()
    {
        $expected = file_get_contents(__DIR__ . '/export-orders-20180629.tsv');
        $this->expectOutputString($expected);

        $status = $this->artisan->call('app:export-orders', [
            'date' => '20180629',
        ]);

        $this->assertSame(0, $status);
    }

    /**
     * @test
     */
    public function execute_購入情報が無い()
    {
        $expected = file_get_contents(__DIR__ . '/export-orders-no-orders.tsv');
        $this->expectOutputString($expected);

        $status = $this->artisan->call('app:export-orders', [
            'date' => '20180701',
        ]);

        $this->assertSame(0, $status);
    }

    /**
     * @test
     * @expectedException \Symfony\Component\Console\Exception\RuntimeException
     * @expectedExceptionMessage Not enough arguments (missing: "date").
     */
    public function execute_引数が無い()
    {
        $this->artisan->call('app:export-orders');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function execute_引数指定が間違い()
    {
        $this->artisan->call('app:export-orders', [
            'date' => '2018-07-01',
        ]);
    }
}
