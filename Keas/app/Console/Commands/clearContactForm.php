<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mediapress\Modules\Heraldist\Models\Message;

class clearContactForm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:clear-contact-form';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $messages = Message::where('form_id', 1)
            ->where('is_crm', 0)
            ->whereDate('created_at', '<=', \Carbon\Carbon::now()->subDay(1))
            ->get();

        foreach($messages as $message){
            $message->forceDelete();
        }
        $this->info('Operation completed successfully');
    }
}
