<?php

namespace App\Jobs\Mship\Account\Ban;

use App\Jobs\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendRepealedEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    private $account;
    private $ban;

    public function __construct(Ban $ban)
    {
        $this->account = $ban->account;
        $this->ban = $ban;
    }

    public function handle()
    {
        $displayFrom = "VATSIM UK - Community Department";
        $subject = "Account Ban - Repealed";
        $body = \View::make("emails.mship.account.ban.repealed")
                     ->with("account", $this->account)
                     ->with("ban", $this->ban)
                     ->render();

        $sender = \App\Models\Mship\Account::find(VATUK_ACCOUNT_SYSTEM);
        $isHtml = true;
        $systemGenerated = true;

        \Bus::dispatch(new \App\Jobs\Messages\CreateNewMessage($sender, $this->recipient, $subject, $body, $displayFrom, $isHtml, $systemGenerated));
    }
}
