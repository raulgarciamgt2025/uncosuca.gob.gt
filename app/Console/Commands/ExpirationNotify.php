<?php

namespace App\Console\Commands;

use App\Mail\UserNotify;
use App\Models\Company;
use App\Models\Department;
use Dflydev\DotAccessData\Data;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ExpirationNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expiration-notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date_now = date('Y-m-d');
        $date_8_months_later = date("Y-m-d", strtotime($date_now."+ 8 months"));
        $date_6_months_later = date("Y-m-d", strtotime($date_now."+ 6 months"));
        $companies = Company::whereBetween('end_date', [$date_6_months_later, $date_8_months_later])->pluck('mercantile_name', 'id')->toArray();
        if (count($companies) > 0) {
            $data = [
                'subject' =>  'Aviso de vencimiento de licencias',
                'title' => 'La licencia de las siguientes empresas está por vencer',
                'subtitle' => '',
                'list' => $companies,
                'description' => 'Las licencias de las empresas listadas vencerán entre 6 y 8 meses',
            ];
//            $department = Department::find(1);
//            $emails_aux = $department->users()->pluck('email')->toArray();
//            $emails = array_merge($emails_aux, [$department->user->email]);
//            $emails_filtered = array_filter($emails, function ($item) {
//                return $item !== null;
//            });
            $mail_list = explode(', ', trim(env('MAILS_REGISTER_DEPARTMENT'), "[]"));
            Mail::to($mail_list)->send(new UserNotify($data));
        }
    }
}
