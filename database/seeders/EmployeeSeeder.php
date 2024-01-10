<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Generate 10 random user records
        for ($i = 0; $i < 10; $i++) {
            $name = $this->generateRandomName();
            $gender = $this->generateRandomGender();
            $email = $this->generateRandomEmail($name);

            DB::table('employees')->insert([
                'name' => $name,
                'gender' => $gender,
                'email' => $email,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function generateRandomName()
    {
        $names = ['John Doe', 'Jane Smith', 'Mike Johnson', 'Emily Brown', 'David Lee', 'Sarah Wilson'];
        return $names[array_rand($names)];
    }

    private function generateRandomGender()
    {
        $genders = ['man', 'woman'];
        return $genders[array_rand($genders)];
    }

    private function generateRandomEmail($name)
    {
        $emailDomains = ['gmail.com', 'yahoo.com', 'hotmail.com'];
        $nameParts = explode(' ', $name);
        $randomName = strtolower($nameParts[0]) . rand(100, 999); // Extract first name and add random numbers
        $randomDomain = $emailDomains[array_rand($emailDomains)];
        return $randomName . '@' . $randomDomain;
    }
}
