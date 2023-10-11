<?php

namespace Database\Factories;

use App\Models\Vminfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use KartsNMS\Enum\PowerState;

/** @extends Factory<Vminfo> */
class VminfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'vm_type' => $this->faker->text(16),
            'vmwVmVMID' => $this->faker->randomDigit(),
            'vmwVmDisplayName' => $this->faker->domainWord() . '.' . $this->faker->domainName(),
            'vmwVmGuestOS' => $this->faker->text(128),
            'vmwVmMemSize' => $this->faker->randomDigit(),
            'vmwVmCpus' => $this->faker->randomDigit(),
            'vmwVmState' => $this->faker->randomElement([PowerState::OFF, PowerState::ON, PowerState::SUSPENDED, PowerState::UNKNOWN]),
        ];
    }
}
