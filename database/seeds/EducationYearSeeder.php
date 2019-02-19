<?php

use Illuminate\Database\Seeder;
use App\EducationYearList;

class EducationYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lastYear = date('Y') - 3;
        for($year = 1962; $year <= $lastYear; $year++){
            $exist = EducationYearList::where('year', $year)->count();
            if($exist == 0){
                $newRecord = new EducationYearList;
                $newRecord->year = $year;
                $newRecord->save();
            }
        }
    }
}
