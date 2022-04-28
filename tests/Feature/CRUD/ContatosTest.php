<?php

namespace Tests\Feature\CRUD;

use App\Models\Contatos;
use App\Models\Medidas;
use App\Models\Propriedade;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ContatosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_create_contato()
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
            "nome_proprietario" => "tetse",
            "nome_propriedade" => "teste",
            "rua" => "stetse",
            "numero" => "teste",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);

        $respose = $this->postJson("{$this->url}contatos", [
            "telefone" => "(77) 93899-9192",
            "email" => "magabeira@gmail.com",
            "propriedade_id" => $propriedade->id
        ]);
        $respose->assertStatus(201);
    }

    public function test_create_contato_with_invalid_data()
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
            "nome_proprietario" => "tetse",
            "nome_propriedade" => "teste",
            "rua" => "stetse",
            "numero" => "teste",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);

        $respose = $this->postJson("{$this->url}contatos", [
            "telefone" => "(77) 93899-9192",
            "email" => "",
            "propriedade_id" => $propriedade->id
        ]);
        $respose->assertStatus(422);
    }

    public function test_update_contato()
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
            "nome_proprietario" => "tetse",
            "nome_propriedade" => "teste",
            "rua" => "stetse",
            "numero" => "teste",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);

        $contato = Contatos::query()->create([
            "telefone" => "(77) 93899-9192",
            "email" => "teste@gmail.com",
            "propriedade_id" => $propriedade->id
        ]);

        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $respose = $this->putJson("{$this->url}contatos/{$contato->id}", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "telefone" => "(77) 93899-9192",
            "propriedade_id" => $propriedade->id]
        );

        $respose->assertStatus(200);
    }

    public function test_delete_contato()
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
            "nome_proprietario" => "tetse",
            "nome_propriedade" => "teste",
            "rua" => "stetse",
            "numero" => "teste",
            "bairro" => "Ceraíma",
            "cidade" => "Guanambi",
            "cep" => "46430-000",
            "estado" => "BA",
            "medida_id" => $medidas->id
        ]);

        $contato = Contatos::query()->create([
            "telefone" => "(77) 93899-9192",
            "email" => "teste@gmail.com",
            "propriedade_id" => $propriedade->id
        ]);

        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $respose = $this->deleteJson("{$this->url}contatos/{$contato->id}", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $respose->assertStatus(200);

    }

    
}
