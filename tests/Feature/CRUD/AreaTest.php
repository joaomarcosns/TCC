<?php

namespace Tests\Feature\CRUD;

use App\Models\Area;
use App\Models\Medidas;
use App\Models\Propriedade;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AreaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_area_created()
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
        $response = $this->post("{$this->url}area", [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'nome' => 'Area 1',
            'descricao' => 'Area 1 description',
            'propriedade_id' => $propriedade->id,
        ]);

        $response->assertStatus(201);
    }

    public function test_area_created_with_invalid_data()
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
        $response = $this->post("{$this->url}area", [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'nome' => '',
            'descricao' => '',
            'propriedade_id' => $propriedade->id,
        ]);

        $response->assertStatus(302);
    }

    public function test_area_created_with_invalid_data_propriedade_id()
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
        
        $response = $this->post("{$this->url}area", [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'nome' => 'Area 1',
            'descricao' => 'Area 1 description',
            'propriedade_id' => 0,
        ]);

        $response->assertStatus(302);
    }
    public function test_area_update() {
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
        
        $response = $this->put("{$this->url}area/{$area->id}", [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'nome' => 'Area 1',
            'descricao' => 'Area 1 description',
            'propriedade_id' => $propriedade->id,
        ]);

        $response->assertStatus(200);

    }

    public function test_area_update_with_invalid_data() {
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
        
        $response = $this->put("{$this->url}area/{$area->id}", [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'nome' => '',
            'descricao' => '',
            'propriedade_id' => $propriedade->id,
        ]);
        $response->assertStatus(302);

    }

    public function test_area_delete() {
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
        
        $response = $this->delete("{$this->url}area/{$area->id}", [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $response->assertStatus(200);
    }
}
