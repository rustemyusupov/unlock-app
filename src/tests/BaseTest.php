<?php

namespace App\Tests;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;

class BaseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test success scenario for unlock
     *
     * @return void
     */
    public function testSuccessUnlock()
    {
        Passport::actingAs(
            factory(\App\User::class)->create(),
            ['open-tunnel']
        );

        $this->post('/unlock/open-tunnel')
            ->seeStatusCode(200);
    }

    /**
     * Test not success scenario for unlock
     *
     * @return void
     */
    public function testNotSuccessUnlock()
    {
        Passport::actingAs(
            factory(\App\User::class)->create(),
            ['wrong-scope']
        );

        $this->post('/unlock/open-tunnel')
            ->seeStatusCode(403);
    }

    /**
     * Test success scenario for history
     *
     * @return void
     */
    public function testSuccessHistory()
    {
        Passport::actingAs(factory(\App\User::class)->create());

        $this->get('/history')
            ->seeStatusCode(200);
    }

    /**
     * Test not success scenario for history
     *
     * @return void
     */
    public function testNotSuccessHistory()
    {
        $this->get('/history')
            ->seeStatusCode(401);
    }
}
