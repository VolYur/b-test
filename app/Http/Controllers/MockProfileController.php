<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class MockProfileController
{
    public function sourceOne(): JsonResponse
    {
        return new JsonResponse(
            ['data' => [
                'email' => 'test@test.com',
                'name' => 'Bar Dor',
            ]]
        );
    }

    public function sourceTwo(): JsonResponse
    {
        return new JsonResponse(
            ['data' => [
                'name' => 'John Foo',
            ]]
        );
    }

    public function sourceThree(): JsonResponse
    {
        return new JsonResponse(
            ['data' => [
                'name' => 'John Bar',
                'avatar_url' => 'https://i.pravatar.cc/300',
            ]]
        );
    }
}