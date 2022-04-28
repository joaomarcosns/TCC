<?php

namespace Tests\Feature\CRUD;

use App\Models\Area;
use App\Models\Medidas;
use App\Models\Propriedade;
use App\Models\Setor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class SetorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_setor_created()
    {
        $medida = Medidas::query()->create([
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
            "medida_id" => $medida->id
        ]);

        $area = Area::query()->create([
            "nome" => "Area 1",
            "descricao" => "Area 1 description",
            "propriedade_id" => $propriedade->id,
        ]);

        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->post("{$this->url}setor", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "identificador" => "Setor 01",
            "area_id" => $area->id
        ]);

        $response->assertStatus(201);
    }

    public function test_setor_created_with_invalid_area_id()
    {
        $medida = Medidas::query()->create([
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
            "medida_id" => $medida->id
        ]);

        $area = Area::query()->create([
            "nome" => "Area 1",
            "descricao" => "Area 1 description",
            "propriedade_id" => $propriedade->id,
        ]);

        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->post("{$this->url}setor", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "identificador" => "Setor 01",
            "area_id" => 0
        ]);

        $response->assertStatus(302);
    }

    public function test_setor_created_with_invalid_identificador()
    {
        $medida = Medidas::query()->create([
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
            "medida_id" => $medida->id
        ]);

        $area = Area::query()->create([
            "nome" => "Area 1",
            "descricao" => "Area 1 description",
            "propriedade_id" => $propriedade->id,
        ]);

        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->post("{$this->url}setor", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "identificador" => "",
            "area_id" => $area->id
        ]);

        $response->assertStatus(302);
    }

    public function test_setor_update()
    {
        $medida = Medidas::query()->create([
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
            "medida_id" => $medida->id
        ]);

        $area = Area::query()->create([
            "nome" => "Area 1",
            "descricao" => "Area 1 description",
            "propriedade_id" => $propriedade->id,
        ]);

        $setor = Setor::query()->create([
            "identificador" => "Setor 01",
            "area_id" => $area->id,
        ]);

        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->put("{$this->url}setor/{$setor->id}", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "identificador" => "Setor 02",
            "area_id" => $area->id
        ]);

        $response->assertStatus(200);
    }
    public function test_setor_delete()
    {
        $medida = Medidas::query()->create([
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
            "medida_id" => $medida->id
        ]);

        $area = Area::query()->create([
            "nome" => "Area 1",
            "descricao" => "Area 1 description",
            "propriedade_id" => $propriedade->id,
        ]);

        $setor = Setor::query()->create([
            "identificador" => "Setor 01",
            "area_id" => $area->id,
        ]);

        Passport::actingAs(
            $user  = User::factory()->createOne(),
            ['create-servers']
        );

        $response = $this->delete("{$this->url}setor/{$setor->id}", [
            'Authorization' => "Bearer {$user->createToken('Personal Access Token')->accessToken}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $response->assertStatus(200);
    }
}
