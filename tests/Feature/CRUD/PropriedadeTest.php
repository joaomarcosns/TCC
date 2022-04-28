<?php

namespace Tests\Feature\CRUD;

use App\Models\Medidas;
use App\Models\Propriedade;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PropriedadeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_propriedade()
    {
        $medidas  = Medidas::query()->create([
            "altura_total" => 20,
            "largura_total" => 100,
            "comprimento_total" => 100,
            "hectares" => 12,
            "latitude" => -14.223066,
            "longitude" => -42.779943,
            "hemisferio" => -1
        ]);

        $response = $this->postJson("{$this->url}propriedade", [
            "nome_proprietario" => "Pedro",
            "nome_propriedade" => "Mangabera",
            "rua" => "S/R",
            "numero" => "S/n",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);

        $response->assertStatus(201);
    }

    public function test_create_validate_propriedade()
    {
        $response = $this->postJson("{$this->url}propriedade", [
            "nome_proprietario" => "Pedro",
            "nome_propriedade" => "",
            "rua" => "S/R",
            "numero" => "S/n",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => null
        ]);

        $response->assertStatus(422);
    }

    public function test_show_propriedade()
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

        $propriedade = Propriedade::query()->create([
            "nome_proprietario" => "Pedro",
            "nome_propriedade" => "Mangabera",
            "rua" => "S/R",
            "numero" => "S/n",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);

        /**
         *  @var User $user
         */

        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->getJson("{$this->url}propriedade/{$propriedade->id}", [
            'Authorization' => "Bearer {$user->createToken('secret')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);
        $response->assertStatus(200);
    }

    public function test_update_propriedade()
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

        $propriedade = Propriedade::query()->create([
            "nome_proprietario" => "Pedro",
            "nome_propriedade" => "Mangabera",
            "rua" => "S/R",
            "numero" => "S/n",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);

        // /**
        //  *  @var User $user
        //  */
        
        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->putJson("{$this->url}propriedade/{$propriedade->id}", [
            'Authorization' => "Bearer {$user->createToken('secret')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "nome_proprietario" => "Pedro",
            "nome_propriedade" => "Mangabera",
            "rua" => "S/R",
            "numero" => "S/n",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_propriedade()
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

        $propriedade = Propriedade::query()->create([
            "nome_proprietario" => "Pedro",
            "nome_propriedade" => "Mangabera",
            "rua" => "S/R",
            "numero" => "S/n",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);
        /**
         *  @var User $user
         */
        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->deleteJson("{$this->url}propriedade/{$propriedade->id}", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);
        $response->assertStatus(200);
    }

    public function test_show_propriedade_not_found()
    {

        /**
         *  @var User $user
         */

        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->getJson("{$this->url}propriedade/1", [
            'Authorization' => "Bearer {$user->createToken('secret')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);
        $response->assertStatus(404);
    }

    public function test_update_propriedade_not_found()
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

        $response = $this->putJson("{$this->url}propriedade/1", [
            'Authorization' => "Bearer {$user->createToken('secret')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "nome_proprietario" => "Pedro",
            "nome_propriedade" => "Mangabera",
            "rua" => "S/R",
            "numero" => "S/n",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);
        $response->assertStatus(404);
    }

    public function test_delete_propriedade_not_found()
    {
        /**
         *  @var User $user
         */

        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->deleteJson("{$this->url}propriedade/1", [
            'Authorization' => "Bearer {$user->createToken('secret')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);
        $response->assertStatus(404);
    }

    public function test_show_propriedade_unauthorized()
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

        $propriedade = Propriedade::query()->create([
            "nome_proprietario" => "Pedro",
            "nome_propriedade" => "Mangabera",
            "rua" => "S/R",
            "numero" => "S/n",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);

        $response = $this->getJson("{$this->url}propriedade/{$propriedade->id}", [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);
        $response->assertStatus(401);
    }

    public function test_update_propriedade_unauthorized()
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

        $propriedade = Propriedade::query()->create([
            "nome_proprietario" => "Pedro",
            "nome_propriedade" => "Mangabera",
            "rua" => "S/R",
            "numero" => "S/n",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);

        $response = $this->putJson("{$this->url}propriedade/{$propriedade->id}", [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "nome_proprietario" => "Pedro",
            "nome_propriedade" => "Mangabera",
            "rua" => "S/R",
            "numero" => "S/n",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);
        $response->assertStatus(401);
    }

}
