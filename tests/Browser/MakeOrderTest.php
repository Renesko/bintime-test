<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MakeOrderTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testMakeOrderExample()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->type('username', 'User1')
                ->type('surname', 'Surname1')
                ->type('email', 'user1@site.com')
                ->select('line[0][product]', 'boots(saucony)')
                ->type('line[0][count]', 1)
                ->select('line[1][product]', 'hat(adidas)')
                ->type('line[1][count]', 2)
                ->press('Make order')
                ->assertPathIs('/');
        });
    }
}
