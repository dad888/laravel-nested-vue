<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageInv;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return ['message'=>'destroy'];
    }


    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function update(Request $request, $id)
    {


        $request->validate([
            'name' => 'required'
        ]);
        Product::find($id)->update(['name' => $request->name]);
        return ['message'=>'update'];

    }

    /**
     * @param Request $request
     * @return Product
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image');
        $img = ImageInv::make($path)->resize(640, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('webp');
        $name = time() . '.webp';
        $save_patch = 'public/image/' . $name;
        Storage::put($name, $img);
        Storage::move($name, $save_patch);

        $product = Product::create
        ([
            'category_id' => $request->id,
            'name' => $request->name,
            'image' => '/storage/image/'.$name
        ]);
        return $product;

    }
}
