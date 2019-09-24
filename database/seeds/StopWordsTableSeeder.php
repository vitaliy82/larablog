<?php

use Illuminate\Database\Seeder;

class StopWordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stop_words = [
           'бублик',
           'ревербератор',
           'кастет',
           'хорь',
           'алкоголь',
           'превысокомногорассмотрительствующий',
           'гражданин',
           'паста'
        ];
        $insertArr = array_map(function ($word){
            return [
                'word' => $word,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }, $stop_words);

        DB::table('stop_words')->insert($insertArr);
    }
}



