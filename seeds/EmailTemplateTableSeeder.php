<?php

use Illuminate\Database\Seeder;

class EmailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds only after EmailAction Seeder!
     *
     * @return void
     */
    public function run()
    {

        $actions = \DB::table('email_action')->get();

        foreach ($actions as $action) {

            $actionName = explode('_', $action->name);
            $temlateName = implode(' ', array_map(function ($n) {
                return ucfirst($n);
            }, $actionName));

            DB::table('email_template')->insert([
                'name' => $temlateName,
                'action_id' => $action->id
            ]);
        }
    }
}
