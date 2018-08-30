<?php

use Illuminate\Database\Seeder;

class EmailActionTableSeeder extends Seeder
{
    private $actionNames = [
        'registration',
        'password_forgot',
        'password_reset',
        'password_change',
        'deposit_approve',
        'deposit_decline',
        'withdrawal_approve',
        'withdrawal_decline'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->actionNames as $name) {
            DB::table('email_action')->insert([
                'name' => $name,
                'enabled' => true,
            ]);
        }
    }
}
