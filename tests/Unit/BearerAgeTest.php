<?php

namespace Tests\Unit;

use App\Models\Beverage;
use PHPUnit\Framework\TestCase;

class BearerAgeTest extends TestCase
{
    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function beverage_has_age()
    {
        $beverage = \App\Models\Beverage::factory(1)->create();
        $name = $beverage->name;
        $this->assertNotEmpty($name);
    }
}
