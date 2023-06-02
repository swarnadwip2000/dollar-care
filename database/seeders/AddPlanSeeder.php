<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\PlanSpecfication;
use Illuminate\Database\Seeder;

class AddPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'plan_name' => 'Basic',
                'plan_price' => '100',
                'plan_type' => 'Basic',
                'specification' => [
                    [
                        'specification_name' => 'Domain Name                        ',
                    ],
                    [
                        'specification_name' => 'Upto 8 Pages',
                    ],
                    [
                        'specification_name' => 'Direct Call Integration',
                    ],
                    [
                        'specification_name' => 'SEO Friendly Design',
                    ],
                    [
                        'specification_name' => 'Whatsapp Integration',
                    ],
                    [
                        'specification_name' => 'Responsive Design',
                    ],
                ],
            ],
            [
                'plan_name' => 'Standard',
                'plan_price' => '200',
                'plan_type' => 'Gold',
                'specification' => [
                    [
                        'specification_name' => 'Domain Name                        ',
                    ],
                    [
                        'specification_name' => 'Upto 8 Pages',
                    ],
                    [
                        'specification_name' => 'Direct Call Integration',
                    ],
                    [
                        'specification_name' => 'SEO Friendly Design',
                    ],
                    [
                        'specification_name' => 'Whatsapp Integration',
                    ],
                    [
                        'specification_name' => 'Responsive Design',
                    ],
                ],
            ],
            [
                'plan_name' => 'Quality',
                'plan_price' => '300',
                'plan_type' => 'Platinum',
                'specification' => [
                    [
                        'specification_name' => 'Domain Name                        ',
                    ],
                    [
                        'specification_name' => 'Upto 8 Pages',
                    ],
                    [
                        'specification_name' => 'Direct Call Integration',
                    ],
                    [
                        'specification_name' => 'SEO Friendly Design',
                    ],
                    [
                        'specification_name' => 'Whatsapp Integration',
                    ],
                    [
                        'specification_name' => 'Responsive Design',
                    ],
                ],
            ],
        ];

        foreach ($plans as $plan) {
            $planModel = new Plan();
            $planModel->plan_name = $plan['plan_name'];
            $planModel->plan_price = $plan['plan_price'];
            $planModel->plan_type = $plan['plan_type'];
            $planModel->save();

            foreach ($plan['specification'] as $specification) {
                $specificationModel = new PlanSpecfication();
                $specificationModel->plan_id = $planModel->id;
                $specificationModel->specification_name = $specification['specification_name'];
                $specificationModel->save();
            }
        }                                                                                                                                                           
    }
}