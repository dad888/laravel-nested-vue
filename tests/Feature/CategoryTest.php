<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_a_category_can_get()
    {
        $this->get('/api/category')->assertStatus(200);
    }

    public function test_create_a_category_id_notnull()
    {

        $category = factory(Category::class)->create();
        $this->assertDatabaseHas('categories', ['id' => 1]);
        $name = 'Test2Name';
        $attr = ['menu' => ['id' => 1], 'newMenu' => $name];
        $this->post('/api/category', $attr)->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => $name, 'parent_id' => 1]);
    }

    public function test_create_a_category_menu_null()
    {
        $name = 'name';
        $attr = ['newMenu' => $name];
        $this->post('/api/category', $attr)->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => $name]);
    }

    public function test_del_category()
    {
        $category = factory(Category::class)->create();
        $this->assertDatabaseHas('categories', ['id' => 4]);
        $response = $this->json('delete', '/api/category/4' , []);
        $response->assertStatus(200);
    }

    public function test_get_Products_id_null()
    {

        $this->get(' api/category/get_products/', [])->assertStatus(200);
    }

    public function test_get_Products_id_notnull()
    {
        $this->get(' api/category/get_products/1', [])->assertStatus(200);
    }
}
