<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amout = $this->faker->numberBetween(200, 10000);
        $status = $this->faker->randomElement(["billed","paid","void"]);

        return [
            "customer_id"=> Customer::factory(),
            "amount"=> $amout,
            "status"=> $status,
            "billed_dated" => $this->faker->dateTimeThisDecade(),
            "paid_time" => $status == "paid" ? $this->faker->dateTimeThisDecade() : NULL,
        ];
    }
}
