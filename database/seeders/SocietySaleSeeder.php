<?php

namespace Database\Seeders;

use App\Models\ClientPlot;
use App\Models\SocietyInstallmentData;
use App\Models\SocietySale;
use Illuminate\Database\Seeder;

class SocietySaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocietySale::create([
            'society_id' => 1,
            'society_cat_data_id' => 1,
            'created_by' => 1,
            'plot_size' => 5,
            'total_installment' => 60,
            'processing_fee' => 5000,
            'monthly_installments' => 17000,
            'mid_term_installment' => 100000,
            'mid_term_per_year' => 2,
            'possession_fee' => 300000,
            'belting_fee' => 300000,
            'down_payment' => 300000,
            'sold_to_id' => 6,
            'registration_number' => 'ABC-5-MARLA',
            'hidden_file_number' => 1919,
            'status_id' => 1,
        ]);

    }
}
