<?php

use Illuminate\Database\Seeder;

class EmailSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filterEmailSettings = ['driver', 'host', 'port', 'username', 'password', 'from'];
        $emailSettings = array_intersect_key(config('mail'), array_flip($filterEmailSettings));

        foreach ($emailSettings as $name => $value) {

            if($name == 'from') {
                $name = 'default sender';
                $value = array_get($value, 'address');
            }

            DB::table('email_setting')->insert([
                'name' => $name,
                'value' => $value,
            ]);
        }
    }
}
