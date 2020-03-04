<?php

namespace Tests\Feature\Http\Controllers\Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;
use App\Movie;

class LoginControllerTest extends TestCase
{

    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }

    public function test_user_cannot_send_empty_login_from()
    {
        
        $response = $this->post(route('login'), []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors('email');

    }

    public function test_user_looged_get_catalog()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->actingAs($user)->get('/catalog');

        $response->assertStatus(200);

        $response->assertViewIs('catalog.index');
    }

    public function test_user_looged_get_1_movie()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->actingAs($user)->get('/catalog/show/1');

        $response->assertStatus(200);

        $response->assertViewIs('catalog.show');
    }

    public function test_user_post_empty_comment()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->post('/review/create/1', []);

        $response->assertStatus(200);

    }

    public function test_user_post_comment()
    {
        $this->withoutExceptionHandling();

        $user = User::find(1);
        
        $response = $this->actingAs($user)->post('/review/create/1', [
            'title' => 'Guay',
            'review' => 'Todo en orden',
            'stars' => 5
        ]);

        $this->assertDatabaseHas('reviews', [
            'title' => 'Guay',
            'review' => 'Todo en orden',
            'stars' => 5
        ]);

    }

    public function test_user_edit_movie()
    {
        $this->withoutExceptionHandling();

        $user = User::find(1);
        
        $response = $this->actingAs($user)->put('/catalog/edit/1', [
            'title' => 'El padrasso',
            'anio' => 2000,
            'aut' => 'Mi abuela',
            'category' => 1,
            'img' => 'https://ia.media-imdb.com/images/M/MV5BMjEyMjcyNDI4MF5BMl5BanBnXkFtZTcwMDA5Mzg3OA@@._V1_SX214_AL_.jpg',
            'trailer' => '',
            'synopsis' => 'A ver si esto funciona'
        ]);

        $this->assertDatabaseHas('movies', [
            'title' => 'El padrasso',
            'year' => 2000,
            'director' => 'Mi abuela',
            'category_id' => 1,
            'poster' => 'https://ia.media-imdb.com/images/M/MV5BMjEyMjcyNDI4MF5BMl5BanBnXkFtZTcwMDA5Mzg3OA@@._V1_SX214_AL_.jpg',
            'trailer' => NULL,
            'synopsis' => 'A ver si esto funciona'
        ]);

    }

    public function empty_movie()
    {
        $response = $this->withoutMiddleware()->post(route('catalog.create'));

        $response->assertStatus(302);

        $response->assertSessionHasErrors('title');

    }


    public function test_PUT_Rent()
    {

        $response = $this->withoutMiddleware()->put(route('putRent', ['id' => 1]));

        $response->assertStatus(200);
    }

    public function test_PUT_Renturn()
    {

        $response = $this->withoutMiddleware()->put(route('putReturn', ['id' => 1]));

        $response->assertStatus(200);
    }

    public function Test_API_create_Movie()
    {
        $this->withoutExceptionHandling();

        $response = $this->withoutMiddleware()->post(route('store'), [
            'title' => 'Test',
            'year' => '2020',
            'director' => 'director',
            'synopsis' => 'synopsis',
            'category' => 1,
            'trailer' => 'trailer'
        ]);

        $response->assertStatus(200);
    }
}

