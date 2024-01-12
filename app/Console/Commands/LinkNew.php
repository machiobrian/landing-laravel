<?php

namespace App\Console\Commands;

use App\Models\Link;
use App\Models\LinkList;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LinkNew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'link:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a New Link';

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
     * @return int
     */
    public function handle()
    {
        $url = $this->ask('Link URL:'); //user input: command line

        // the input url is validated
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error("Invalid URL. Exiting...");
            return 1;
        }
        // optionally, we are asked for a description
        $description = $this->ask('Link Description:');
        $list_name = $this->ask('Link List (Leave blank to use default)')?? "default";


        $this->info("New Link:");
        $this->info($url . ' - ' . $description);
        $this->info("Listed in: " . $list_name);

        // prompted to confirm
        if ($this->confirm('Is this information correct?')) {
            $list = LinkList::firstWhere('slug', $list_name);
            if (!$list){
                $list = new LinkList();
                $list->title = $list_name;
                $list->slug = $list_name;
                $list->save();
            }

            $link = new Link();
            $link->url = $url;
            $link->description = $description;
            $link->links()->save();
            // if yes/y it is saved & console logged
            $this->info("Saved.");
        }

        return 0;
    }
}
