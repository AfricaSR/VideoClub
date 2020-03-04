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
    //El usuario puede acceder al login
    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }
    //El usuario no puede volver al formulario de login una vez autenticado
    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }
    //El usuario no puede enviar el formulario de login vacío
    public function test_user_cannot_send_empty_login_from()
    {
        
        $response = $this->post(route('login'), []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors('email');

    }
    //Cuando el usuario se autentica, va al catálogo
    public function test_user_looged_get_catalog()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->actingAs($user)->get('/catalog');

        $response->assertStatus(200);

        $response->assertViewIs('catalog.index');
    }
    //Cuando se obtiene un index, se muestra la información de la película
    public function test_user_looged_get_1_movie()
    {
        $user = User::find(1);

        $this->actingAs($user);

        $response = $this->actingAs($user)->get('/catalog/show/1');

        $response->assertStatus(200);

        $response->assertViewIs('catalog.show');
    }
    //No se postea una review vacía
    public function test_user_post_empty_comment()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->post('/review/create/1', []);

        $response->assertStatus(200);

    }
    //Se crea una review vía post y se comprueba en la base de datos
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
    //El usuario puede editar una película y esta se puede ver en la base de datos
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
    //Si se trata de crear una película mediante un formulario vacío, salta una redirección
    public function empty_movie()
    {
        $response = $this->withoutMiddleware()->post(route('catalog.create'));

        $response->assertStatus(302);

        $response->assertSessionHasErrors('title');

    }

    //Se puede crear una película vía API
    public function Test_API_create_Movie()
    {
        $this->withoutExceptionHandling();

        $response = $this->withoutMiddleware()->post(route('store'), [
            'title' => 'Lo que Laravel se llevó',
            'year' => '2020',
            'director' => 'Bonifacio',
            'synopsis' => 'Si esto no sirve, me #$"!/( en mi **** vida',
            'category' => 1,
            'trailer' => 'trailer'
        ]);

        $response->assertStatus(200);
    }

    //Se puede poner una película en alquiler vía API
    public function test_PUT_Rent()
    {

        $response = $this->withoutMiddleware()->put(route('putRent', ['id' => 1]));

        $response->assertStatus(200);
    }
    //Se puede devolver una película vía API
    public function test_PUT_Renturn()
    {

        $response = $this->withoutMiddleware()->put(route('putReturn', ['id' => 1]));

        $response->assertStatus(200);
    }

}

