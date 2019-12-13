<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;


//
    public function test_delete_product()
    {
        $this->withoutExceptionHandling();

        $product = factory(Product::class)->create();
        $this->assertDatabaseHas('products', ['id' => 1]);
        $this->json('delete', '/api/product/1', []);
        $this->assertDatabaseMissing('products', ['id' => 1]);

    }

//
    public function test_update_product()
    {
        $this->withExceptionHandling();
        $product = factory(Product::class)->create();
        $this->assertDatabaseHas('products', ['id' => 2]);
        $attr = ['id' => 2, 'name' => 'Test'];
        $this->call('patch', '/api/product/2', $attr)->assertStatus(200);
        $this->assertDatabaseHas('products', $attr);
    }

    public function test_store_product()
    {
        $this->withExceptionHandling();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $attr = [
            'id' => factory(Category::class)->create()->id,
            'name' => 'TestName',
            'image' => $file
        ];
        $this->json('POST', '/api/product', $attr);
        $this->assertDatabaseHas('products', ['category_id' => $attr['id'], 'name' => $attr['name']]);
//        Storage::disk('avatars')->assertExists($file->hashName());

    }


}
