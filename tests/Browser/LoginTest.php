<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;
use Tests\Browser\Components\StarPicker;

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
            ->type('qry','La vida es Fea')
                ->pause(2000)
                ->click('#search')
                ->pause(2000)
                ->assertDontSee('La vida es Fea');

        });
    }
    
    public function test_movie_exist()
    {
        $user = User::find(1);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/catalog')
            ->type('qry','La vida es bella')
                ->pause(2000)
                ->click('#search')
                ->pause(2000)
                ->assertSee('La vida es bella');

        });

        
    }

    public function test_view_movie_exist()
    {
        $user = User::find(1);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/catalog')
            ->type('qry','El padrino')
                ->pause(2000)
                ->click('#search')
                ->pause(2000)
                ->clickLink('El padrino')
                ->assertPathIs('/VideoClub/public/catalog/show/1');

        });

        
    }

    public function test_scroll_to_end()
    {
        $user = User::find(1);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/catalog/show/1')
            ->pause(1000)
            ->scrollToElement('#Valorar')
            ->pause(1000)
            ->assertSee('Valoración');

        });

        
    }

    public function test_add_comment()
    {
        $user = User::find(1);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/catalog/show/1')
            ->pause(1000)
            ->scrollToElement('#Valorar')
            ->pause(1000)
            ->type('title', 'Todo guay')
                ->select('stars', '5')
                ->type('review', 'A ver si este test funciona')
                ->pause(2000)
                ->press('Valorar')
                ->pause(2000)
                ->assertSee('El padrino');

        });

        
    }

    public function test_add_movie()
    {
        $user = User::find(1);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('catalog/create')
            ->pause(2000)
            ->type('title', 'Rogue One: Una historia de Star Wars')
            ->type('anio', '2016')
            ->type('aut', 'Gareth Edwards')
            ->select('Category', '7')
            ->type('img', 'https://pics.filmaffinity.com/rogue_one_a_star_wars_story-635726332-large.jpg')
            ->type('synopsis', 'El Imperio Galáctico ha terminado de construir el arma más poderosa de todas, la Estrella de la muerte, pero un grupo de rebeldes decide realizar una misión de muy alto riesgo: robar los planos de dicha estación antes de que entre en operaciones, mientras se enfrentan también al poderoso Lord Sith conocido como Darth Vader, discípulo del despiadado Emperador Palpatine. Film ambientado entre los episodios III y IV de Star Wars')
            ->pause(2000)
            ->press('Añadir película')
            ->assertPathIs('/VideoClub/public/catalog');

        });

        
    }


    public function testLogout()
    {
        $user = User::find(1);

        $this->browse(function ($browser) use ($user) {
            $browser->press('Cerrar sesión')
            ->pause(1000)
            ->assertPathIs('/VideoClub/public/login');
    });
    }
   
}
