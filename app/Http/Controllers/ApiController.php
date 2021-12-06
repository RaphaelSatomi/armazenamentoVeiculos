<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Carros;

class ApiController extends Controller
{
    public function getAll()
    {
        // $carros = Carros::simplePaginate(18);
        // $array['list'] = $carros->items();
        // $array['current_page'] = $carros->currentPage();

        $array['list'] = Carros::all();

        return $array;
    }

    public function delete($id)
    {
        
        $carros = Carros::find($id);
        $carros->delete();

    }
}
