<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{
    public function store(Request $request)
    {
        $method = $request->method;
        $params = $request->params;
        $orderCurrency = $params['orderCurrency'];
        $orderSum = $params['orderSum'];
        $unitpayPublicKey = '441707-c74ca';

        $correctSignature = $this->verifySignature($method, $params, $unitpayPublicKey, $request->header('X-Signature'));

        if (!$correctSignature) return;

        switch ($method) {
            case 'pay':
                return response('OK');
            case 'error':
                return abort(400);
            case 'check':
                return response($request->header('X-Signature'));
            default:
                abort(400);
        }
    }

    private function verifySignature($method, $params, $publicKey, $signature)
    {
        ksort($params);
        unset($params['sign']);

        $sign = $method . '|' . implode('|', $params) . '|' . $publicKey;
        $sign = hash('sha256', $sign);

        return $sign === $signature;
    }
}
