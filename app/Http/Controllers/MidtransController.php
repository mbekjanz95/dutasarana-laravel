<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MidtransController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $transaction = Transaction::create([
            'invoice_number' => '980823432',
            'amount' => $request->amount,
            'status' => 'CREATED',
        ]);

        $resp = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withBasicAuth('xxx', '')
            ->post('https://api.sandbox.midtrans.com/v2/charge', [
                'payment_type' => 'gopay',
                'transaction_details' => [
                    'order_id' => '5200',
                    'gross_amount' => $transaction->amount
                ]
            ]);

        if ($resp->status() == 201 || $resp->status() == 200) 
        {
            $actions = $resp->json('actions');
            if (empty($actions))
            {
                return response()->json(['message' => $resp['status_message']], 500);        
            }
            $actionMap = [];
            foreach ($actions as $action) {
                $actionMap[$action['name']] = $action['url'];
            }

            return response()->json(['qr' => $actionMap['generate-qr-code']]);
        }
        return response()->json(['message' => $resp->body()], 500);
    }
}
