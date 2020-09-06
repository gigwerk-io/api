<?php

namespace App\Http\Controllers\Business;

use App\Contracts\Repositories\UserRepository;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DragDropFormController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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
