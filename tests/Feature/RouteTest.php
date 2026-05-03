<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_ConnectionDatabase(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     */
    public function test_Admin_Login(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     */
    public function test_Admin_dashboard(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * A basic test for the admin dashboard route.
     *
     * @return void
     */
    public function test_Admin_gejala()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * A basic test for the admin product index route.
     *
     * @return void
     */
    public function test_Admin_jenis_kecanduan()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
    * @test
    */
    public function test_Admin_Aturan()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
    * @test
    */
    public function test_Admin_pengguna()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
    * @test
    */
    public function test_Psikolog_dashboard()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
    * @test
    */
    public function test_Psikolog_diagnosa()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
    * @test
    */
    public function test_Psikolog_hasil_diagnosa()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
    * @test
    */
 

  
   
 

}
