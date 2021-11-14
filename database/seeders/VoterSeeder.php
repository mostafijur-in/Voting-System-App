<?php

namespace Database\Seeders;

use App\Models\Voter;
use Illuminate\Database\Seeder;

class VoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $range  = range(1, 20);
        foreach($range as $n) {
            $mobile = 90000000 . sprintf('%02d', $n);
            Voter::create([
                'voter_name' => "Voter ". $n,
                'mobile' => $mobile,
            ]);
        }
    }
}
