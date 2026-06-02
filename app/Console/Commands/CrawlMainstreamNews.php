<?php

namespace App\Console\Commands;

use App\Services\NewsCrawlerService;
use Illuminate\Console\Command;

class CrawlMainstreamNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:crawl-mainstream';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl disaster-related news from mainstream media RSS feeds';

    /**
     * Execute the console command.
     */
    public function handle(NewsCrawlerService $crawler): int
    {
        $this->info('Starting mainstream news crawler...');
        
        $count = $crawler->handle();
        
        $this->info("Crawling completed. Added {$count} new disaster-related news articles.");
        
        return Command::SUCCESS;
    }
}
