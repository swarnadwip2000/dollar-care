<?php

namespace Database\Seeders;

use App\Models\TermsAndCondition;
use Illuminate\Database\Seeder;

class TermsAndConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $term = new TermsAndCondition();
        $term->content = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Placeat sequi aliquid amet quae, alias natus vitae dolores ipsum labore, hic obcaecati, earum impedit animi ipsa nam sint consequuntur quod aliquam?';
        $term->save();
    }
}
