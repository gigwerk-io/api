<?php

namespace App\Http\Controllers\Business;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DragDropFormController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        return ResponseFactory::success('form data submitted', $data);

    }
}
