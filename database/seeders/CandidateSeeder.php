<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $range  = range('A', 'E');
        foreach($range as $a) {
            Candidate::create([
                'candidate_name' => "Candidate ". $a,
            ]);
        }
    }
}
