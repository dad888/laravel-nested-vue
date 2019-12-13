<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use PhpParser\Node\Expr\New_;

class  CategoryRepository implements CategoryRepositoryInterface
{

    /**
     * @param Request $request
     * @return Category
     */
    public function store(Request $request)
    {
        if (!$request->menu) {
            return Category::create(['name' => $request->newMenu]);
        }
        $node = Category::find($request->menu['id']);
        return Category::create(['name' => $request->newMenu], $node);
    }

    /**
     * @return Category
     */
    public function index()
    {
        return Category::get()->toTree();
    }

    /**
     * @param null $id
     * @return array
     */
    public function getProducts($id = null)
    {

        if (!isset($id)) {
            $category = new Category();
            $category->name = 'Лучшие товары';
            $products = Product::orderBy(DB::raw('RAND()'))->take(10)->get();
            return ['category' => $category, 'products' => $products];
        }
        if (isset($id)) {
            $category = Category::find($id);
            $categories = $category->descendants()->pluck('id');
            $categories[] = $category->getKey();
            $products = Product::whereIn('category_id', $categories)->get();
        }
        return ['category' => $category, 'products' => $products];
    }

    public function destroy($id)
    {
        $node = Category::find($id);
        $node->delete();
        return '';
    }
}
