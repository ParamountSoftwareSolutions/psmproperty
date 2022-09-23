<?php

namespace Database\Seeders;

use App\Models\SocietyCategoryData;
use Illuminate\Database\Seeder;

class SocietyCategoryDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocietyCategoryData::insert([
            [
                'society_id' => mt_rand(1, 10),
                'category_id' => mt_rand(1, 4),
                'category_name' => 'Plot',
                'created_by' => 3,
                'status_id' => 1,
                'data_array' => '[{"size":"3","Residential":"300","Corner":"100","Main-Boulevard":"100","installment_details":{"processing_amount":"3000","down_payment":"200000","monthly_installment":"12500","total_installment":"60","large_payment":"100000","large_payment_period_per_year":"2","possession_fee":"200000","belting_fee":"200000","start_date":"2021-06-01T11:17","development_amount":"200000","premium":{"Residential":"0","Corner":"200000","Main-Boulevard":"200000"}}},{"size":"5","Residential":"500","Corner":"100","Main-Boulevard":"100","installment_details":{"processing_amount":"5000","down_payment":"300000","monthly_installment":"17000","total_installment":"60","large_payment":"100000","large_payment_period_per_year":"2","possession_fee":"300000","start_date":"2021-06-01T11:17","belting_fee":"300000","development_amount":"300000","premium":{"Residential":"0","Corner":"0","Main-Boulevard":"0"}}}]',
            ],
            [
                'society_id' => mt_rand(1, 10),
                'category_id' => mt_rand(1, 4),
                'category_name' => 'Villa',
                'created_by' => 3,
                'status_id' => 1,
                'data_array' => '[{"size":"3","Residential":"5","Commercial":"5","Corner":"5","installment_details":{"processing_amount":0,"down_payment":0,"monthly_installment":0,"total_installment":0,"large_payment":0,"large_payment_period_per_year":0,"possession_fee":0,"belting_fee":0,"start_date":0,"development_amount":0,"premium":{"Residential":"0","Commercial":"0","Corner":"0"}}},{"size":"5","Residential":"5","Commercial":"5","Corner":"5","installment_details":{"processing_amount":0,"down_payment":0,"monthly_installment":0,"total_installment":0,"large_payment":0,"large_payment_period_per_year":0,"possession_fee":0,"belting_fee":0,"start_date":0,"development_amount":0,"premium":{"Residential":"0","Commercial":"0","Corner":"0"}}}]',
            ],
            [
                'society_id' => mt_rand(1, 10),
                'category_id' => mt_rand(1, 4),
                'category_name' => 'Commercial',
                'created_by' => 3,
                'status_id' => 1,
                'data_array' => '[{"size":"3","Residential":"5","Commercial":"5","Corner":"5","installment_details":{"processing_amount":0,"down_payment":0,"monthly_installment":0,"total_installment":0,"large_payment":0,"large_payment_period_per_year":0,"possession_fee":0,"belting_fee":0,"start_date":0,"development_amount":0,"premium":{"Residential":"0","Commercial":"0","Corner":"0"}}},{"size":"5","Residential":"5","Commercial":"5","Corner":"5","installment_details":{"processing_amount":0,"down_payment":0,"monthly_installment":0,"total_installment":0,"large_payment":0,"large_payment_period_per_year":0,"possession_fee":0,"belting_fee":0,"start_date":0,"development_amount":0,"premium":{"Residential":"0","Commercial":"0","Corner":"0"}}}]',
            ],
            [
                'society_id' => mt_rand(1, 10),
                'category_id' => mt_rand(1, 4),
                'category_name' => 'Apartment',
                'created_by' => 3,
                'status_id' => 1,
                'data_array' => '[{"size":"3","Residential":"19","Top-floor":"12","installment_details":{"processing_amount":0,"down_payment":0,"monthly_installment":0,"total_installment":0,"large_payment":0,"large_payment_period_per_year":0,"possession_fee":0,"belting_fee":0,"start_date":0,"development_amount":0,"premium":{"Residential":"0","Top-floor":"0"}}}]',
            ],
        ]);
    }
}
