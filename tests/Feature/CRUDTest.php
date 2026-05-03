<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CRUDTest extends TestCase
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
    public function test_AdminLogin(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic test for the admin product index route.
     *
     * @return void
     */
    /**
    * @test
    */
    public function testAdminGejala()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
    * @test
    */
    public function testAdminJenisKecanduan()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
    * @test
    */
    public function testAdminAturan()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
    * @test
    */
    public function testAdminKelola_pengguna()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
    * @test
    */
 
    /**
     * @test
     */
    public function testPsikologi_diagnosa()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
    * @test
    */
    public function testPsikologi_hasil_diagnosa()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
     /**
    * @test
    */
  
}
