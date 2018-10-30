<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testeAuthentication(){
        $user = factory(\App\User::class)->create();
        
        $response = $this->actingAs($user)
                         ->get('/home');
        
        $response->assertStatus(200);
    }
    
    public function testView()
    {
        $user = factory(\App\User::class)->create();
        
        $home = $this->actingAs($user)
                     ->get('/home');
        $home->assertStatus(200);
       
        $produtos = $this->actingAs($user)
                         ->get('/produtos');
        $produtos->assertStatus(200);
        
        $produtos_create = $this->actingAs($user)
                                ->get('/produtos/create');
        $produtos_create->assertStatus(200);
//        
//        $data = factory(\App\Produto::class,1)->create();
//        
//        $produtos_edit = $this->actingAs($user)
//                                ->get('produtos/edit/1');
//        $produtos_edit->assertStatus(200);
        
    }
}
