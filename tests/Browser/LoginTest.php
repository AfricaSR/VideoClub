<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    public function test_login()
    {
        $user = User::find(1);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'abcd1234')
                    ->press('Login')
                    ->assertPathIs('/VideoClub/public/catalog');
        });
    }
    public function test_movie_not_exist()
    {
        $user = User::find(1);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/catalog')
            ->assertSee('El padrino');
        });
    }
}
