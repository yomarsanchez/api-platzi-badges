<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait FormRequestTrait
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(
        \Illuminate\Contracts\Validation\Validator $validator
    ) {
        throw new \Illuminate\Validation\ValidationException(
            $validator,
            response()->json(
                [
                    'message' => 'The data provided was invalid...',
                    'errors' => $validator->errors()
                ],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }
}
