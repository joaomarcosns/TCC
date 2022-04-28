<?php

namespace Tests\Feature\CRUD;

use App\Models\Medidas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Tests\TestCase;

class MedidasTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_validate_all_type_numeric_to_medidas()
    {
        $response = $this->postJson("{$this->url}medidas", [
            "altura_total" => "teste",
            "largura_total" => "teste",
            "comprimento_total" => 'teteste',
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);

        $response->assertStatus(422);
    }
    public function test_create_medidas()
    {
        $response = $this->postJson("{$this->url}medidas", [
            "altura_total" => 20,
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);
        $response->assertStatus(201);
    }

    public function teste_show_medidas()
    {
        $medidas = Medidas::query()->create([
            "altura_total" => 20,
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);
        /**
         *  @var User $user
         */
        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->getJson("{$this->url}medidas/{$medidas->id}", [
            'Authorization' => "Bearer {$user->createToken('secret')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(200);
    }

    public function test_update_medidas()
    {
        $medidas = Medidas::query()->create([
            "altura_total" => 20,
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);
        /**
         *  @var User $user
         */
        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->putJson("{$this->url}medidas/{$medidas->id}", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "altura_total" => 20,
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_medidas()
    {
        $medidas = Medidas::query()->create([
            "altura_total" => 20,
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);
        /**
         *  @var User $user
         */
        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->deleteJson("{$this->url}medidas/{$medidas->id}", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(200);
    }

    public function test_show_medidas_not_found()
    {
        /**
         *  @var User $user
         */
        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->getJson("{$this->url}medidas/1", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(404);
    }

    public function test_update_medidas_not_found()
    { 
        /**
         *  @var User $user
         */
        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->putJson("{$this->url}medidas/1", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);
        $response->assertStatus(404);
    }

    public function test_delete_medidas_not_found()
    {
        /**
         *  @var User $user
         */
        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->deleteJson("{$this->url}medidas/1", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(404);
    }

    public function test_show_medidas_unauthorized()
    {
        $medidas = Medidas::query()->create([
            "altura_total" => 20,
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);

        $response = $this->getJson("{$this->url}medidas/{$medidas->id}");

        $response->assertStatus(401);
    }

    public function test_update_medidas_unauthorized()
    {
        $medidas = Medidas::query()->create([
            "altura_total" => 20,
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);

        $response = $this->putJson("{$this->url}medidas/{$medidas->id}", [
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);

        $response->assertStatus(401);
    }

    public function test_delete_medidas_unauthorized()
    {
        $medidas = Medidas::query()->create([
            "altura_total" => 20,
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);

        $response = $this->deleteJson("{$this->url}medidas/{$medidas->id}");

        $response->assertStatus(401);
    }

    public function test_show_medidas_not_found_unauthorized()
    {
        /**
         *  @var User $user
         */
        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->getJson("{$this->url}medidas/1", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(404);
    }

    public function test_update_medidas_not_found_unauthorized()
    {
        /**
         *  @var User $user
         */
        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->putJson("{$this->url}medidas/1", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);

        $response->assertStatus(404);
    }
    
}
