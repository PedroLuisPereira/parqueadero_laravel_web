<?php

namespace Tests\Feature;

use App\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientesTest extends TestCase
{
    use RefreshDatabase;

    // public function test_clientes_listar()
    // {
    //     $this->withoutExceptionHandling();

    //     factory(Cliente::class, 3)->create();
    //     $response = $this->get('/clientes');
    //     $response->assertOk();
    //     $response->assertViewIs('clientes_listar');
    //     $clientes = Cliente::all();
    //     $data = array(
    //         'clientes' => $clientes,
    //         'buscar' => ''
    //     );
    //     //$response->assertViewHas('data', $data);
    // }

    public function test_store()
    {

        $response = $this->post('/clientes', [
            'numero_documento' => '47485555',
            'nombre' => 'Julieta',
            'apellidos' => 'Rosa',
            'placa' => 'sdf7485',
            'tipo' => 'Moto'
        ]);

        $response->assertOk();
        //ver registros creados
        $registro = Cliente::all();
        //ver si se creo el registro
        $this->assertEquals(1, $registro->count());
        //ver si el registro creado corresponde al creado
        $this->assertEquals('47485555', $registro[0]->numero_documento);
        //
        // $response->assertRedirect(session()->previousUrl());
        // $response->assertStatus(302);
        // $response->assertRedirect(route('cliente.create'));
        $response->assertRedirect('/clientes');
        
        
    }
}
