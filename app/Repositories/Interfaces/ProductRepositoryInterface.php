<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;


interface ProductRepositoryInterface
{
    public function destroy($id);

    public function update(Request $request, $id);

    public function store(Request $request);

}
