<?php

namespace App\Http\Controllers\Business;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Solomon04\Documentation\Annotation\BodyParam;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;

/**
 * @Group(name="Form", description="We provide businesses forms for when their applicants apply to their business.")
 */
class FormController extends Controller
{
    /**
     * @Meta(name="Display Form", href="display-form", description="Display the structure of a business form.")
     * @ResponseExample(status=200, example="responses/business/form/show.form-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        /** @var Business $business */
        $business = $request->get('business');

        return ResponseFactory::success('Show business form', $business->form->form);
    }

    /**
     * @Meta(name="Update Form", href="update-form", description="Update a business form for their applicants.")
     * @BodyParam(name="formHeader", type="array", status="required", description="This is the meta data for your form.")
     * @BodyParam(name="formComponents", type="array", status="required", description="This is the array of form components.")
     * @ResponseExample(status=200, example="responses/business/form/update.form-200.json")
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'formHeader' => ['required', 'array'],
            'formComponents' => ['required', 'array']
        ]);
        /** @var Business $business */
        $business = $request->get('business');

        $business->form()->update([
            'form' => [
                'formHeader' => $request->formHeader,
                'formComponents' => $request->formComponents
            ]
        ]);

        return ResponseFactory::success('Your business form has been updated.');
    }
}
