<?php

namespace App\Http\Controllers\Business;

use App\Contracts\Repositories\BusinessRepository;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\Repositories\ApplicationFormRepository;

class DragDropFormController extends Controller
{
    /**
     * @var ApplicationFormRepository
     */
    private $applicationFormRepository;

    /**
     * @var BusinessRepository
     */
    private $businessRepository;

    public function __construct(ApplicationFormRepository $applicationFormRepository, BusinessRepository $businessRepository) {
        $this->applicationFormRepository = $applicationFormRepository;
        $this->businessRepository = $businessRepository;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = $request->user();
        $owner_id = $request->user()->id;

        $this->applicationFormRepository->updateOrCreate([
            'owner_id' => $owner_id,
            'business_id' => $this->businessRepository->findWhere(["id" => $owner_id])->first()->id,
            'application_form' => serialize($data['form']),
            'application_form_name' => $data['formHeader']['formTitle'],
            'application_form_description' => $data['formHeader']['formDescription']
        ]);

            return ResponseFactory::success('form data submitted', $user);

//            return ResponseFactory::error(
//                'Invalid business or form data.',
//                null,
//                401
//            );
    }


}
