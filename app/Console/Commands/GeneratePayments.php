<?php

namespace App\Console\Commands;

use App\Models\Company;
use Illuminate\Console\Command;

class GeneratePayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera los registros de pagos cada inicio de mes';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $companies = Company::where('status', 1)->get();
        foreach ($companies as $company) {
            $company->pays()->create([
                'mount' => date('m'),
                'year' => date('Y'),
            ]);
        }
    }
}
