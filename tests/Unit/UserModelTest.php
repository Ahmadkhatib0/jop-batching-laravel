<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserModelTest extends TestCase
{

    // use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    /** @test */
    public function user_has_full_name_attribute()
    {
        $user = User::create([
            'name' => 'ahmad', 'email' => 'ali@ali.com', 'password' => 'password12345678'
        ]);

        $this->assertEquals("ahmad khatib", $user->fullName);
    }
}
