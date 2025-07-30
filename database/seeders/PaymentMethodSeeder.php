<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            [
                'name' => 'Cash',
                'description' => 'Cash payment',
                'status' => 'active',
            ],
            [
                'name' => 'Bankily',
                'description' => 'Bankily payment',
                'status' => 'active',
            ],
            [
                'name' => 'Sedad',
                'description' => 'Sedad payment',
                'status' => 'active',
            ],
            [
                'name' => 'Paypal',
                'description' => 'Paypal payment',
                'status' => 'active',
            ],
            [
                'name' => 'Stripe',
                'description' => 'Stripe payment',
                'status' => 'active',
            ],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            PaymentMethod::firstOrCreate($paymentMethod);
        }
    }
}
