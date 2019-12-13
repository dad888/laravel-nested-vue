<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function destroy($id)
    {
        return $this->productRepository->destroy($id);
    }

    public function update(Request $request, $id)
    {
        return $this->productRepository->update($request, $id);
    }

    public function store(Request $request)
    {
        return $this->productRepository->store($request);
    }

}
