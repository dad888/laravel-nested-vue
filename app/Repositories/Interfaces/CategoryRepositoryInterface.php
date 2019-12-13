<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;


interface CategoryRepositoryInterface
{
    public function index();

    public function store(Request $request);

    public function destroy($id);

    public function getProducts();
}
