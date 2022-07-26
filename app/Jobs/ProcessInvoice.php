<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Account;
use LangleyFoxall\XeroLaravel\XeroApp;
use League\OAuth2\Client\Token\AccessToken;

class ProcessInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $user = null;
    private $xero = null;
   

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Account $account)
    {
        //
        $this->$account = $account;
        $user = auth()->user(); 

        $xero = new XeroApp(
            new AccessToken(json_decode($user->xero_oauth_2_access_token)),
            $user->xero_tenant_id
        );
    }

    /**
     * Execute the job.
     *
     * 
     * @return void
     */
    public function handle()
    {
        //Send an email to each account with post paid pricing type
    }
}
