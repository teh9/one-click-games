<?php

namespace App\Lib;

class Responser
{
    public function response($status, $message, $payload = []) {
        return response()->json([
            'status'  => $status,
            'message' => $message,
            'payload' => $payload,
        ]);
    }
}
