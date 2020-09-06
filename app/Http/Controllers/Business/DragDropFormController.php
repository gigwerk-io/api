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
        $user = $request->user();
        $business = $user->ownsBusiness()->first();

        if (isSet($data, $business)) {
            $business->update([
                'application_form' => serialize($data['form']),
                'application_form_name' => $data['formHeader']['formTitle'],
                'application_form_description' => $data['formHeader']['formDescription']
            ]);

            return ResponseFactory::success('form data submitted', $data);
        } else {
            return ResponseFactory::error(
                'Invalid form data.',
                null,
                401
            );
        }
    }


}
