<?php

namespace StancerLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Stancer\Card;
use Stancer\Payment;
use StancerLaravel\Traits\HandlesStancerErrors;

class PaymentController
{
    use HandlesStancerErrors;
    public function createPayment(Request $request)
    {
        // Validate form
        $validator = \Validator::make($request->all(), [
            'card_number' => 'required|regex:/^\d{16}$/', // Numéro de carte (16 chiffres)
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'], // Format MM/YY
            'cvc'         => 'required|digits:3', // Code CVC (3 chiffres)
        ]);

        // If fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation des données échouée.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Parse et format valid data
        $validated = $validator->validated();
        [$expMonth, $expYear] = explode('/', $validated['expiry_date']);
        $expYear = (int)('20' . $expYear);

        try {
            // Config card
            $card = new Card();
            $card->setNumber($validated['card_number'])
                 ->setExpMonth((int)$expMonth)
                 ->setExpYear((int)$expYear)
                 ->setCvc($validated['cvc']);

            // set payment
            $payment = new Payment();
            $payment->setAmount(1000) // amoutn in cents
                    ->setCurrency('EUR')
                    ->setDescription('Paiement pour votre abonnement Rentilot+')
                    ->setCard($card);

            $payment->send();

            return response()->json([
                'status' => 'success',
                'payment_id' => $payment->getId(),
            ]);

        } catch (\Throwable $exception) {
            // Use trait to handle stancer errors
            return $this->handleStancerException($exception);
        }
    }
}