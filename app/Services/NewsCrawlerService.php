<?php

namespace App\Services;

use App\Models\SafetyGuide;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewsCrawlerService
{
    /**
     * List of RSS Feeds to crawl
     */
    protected array $feeds = [
        'Antara News' => 'https://www.antaranews.com/rss/terkini.xml',
        'CNN Indonesia' => 'https://www.cnnindonesia.com/nasional/rss',
        'CNBC Indonesia' => 'https://www.cnbcindonesia.com/news/rss',
    ];

    /**
     * Keywords to filter disaster related news
     */
    protected array $keywords = [
        'gempa', 'banjir', 'longsor', 'tsunami', 'gunung meletus', 
        'erupsi', 'bencana', 'angin puting beliung', 'cuaca ekstrem', 
        'kebakaran hutan', 'kekeringan', 'bmkg', 'basarnas', 'bnpb', 'bpbd'
    ];

    public function handle(): int
    {
        $count = 0;

        foreach ($this->feeds as $source => $url) {
            try {
                $response = Http::timeout(15)->get($url);

                if ($response->successful()) {
                    $xml = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
                    
                    if ($xml === false || !isset($xml->channel->item)) {
                        continue;
                    }

                    foreach ($xml->channel->item as $item) {
                        $title = (string) $item->title;
                        $description = (string) $item->description;
                        $link = (string) $item->link;
                        $pubDate = (string) $item->pubDate;

                        if ($this->isDisasterRelated($title, $description)) {
                            $saved = $this->saveNews($title, $description, $link, $source, $pubDate);
                            if ($saved) {
                                $count++;
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error("Failed to crawl news from {$source}: " . $e->getMessage());
            }
        }

        return $count;
    }

    protected function isDisasterRelated(string $title, string $description): bool
    {
        $text = strtolower($title . ' ' . $description);
        
        foreach ($this->keywords as $keyword) {
            if (str_contains($text, strtolower($keyword))) {
                return true;
            }
        }

        return false;
    }

    protected function saveNews(string $title, string $description, string $link, string $source, string $pubDate): bool
    {
        // Hindari duplikasi berdasarkan judul
        $exists = SafetyGuide::query()
            ->where('category', 'news')
            ->where('title', $title)
            ->exists();

        if ($exists) {
            return false;
        }

        // Tentukan tipe bencana dari judul/deskripsi jika memungkinkan
        $type = 'other';
        $textForType = strtolower($title . ' ' . $description);
        $typesMapping = [
            'banjir' => 'flood',
            'gempa' => 'earthquake',
            'longsor' => 'landslide',
            'tsunami' => 'tsunami',
            'gunung' => 'volcano',
            'erupsi' => 'volcano',
            'kebakaran' => 'fire',
        ];

        foreach ($typesMapping as $word => $mappedType) {
            if (str_contains($textForType, $word)) {
                $type = $mappedType;
                break;
            }
        }

        // Simpan ke database menggunakan SafetyGuide (karena category news disimpan di sini)
        SafetyGuide::create([
            'title' => $title,
            'disaster_type' => $type,
            'category' => 'news',
            'content' => strip_tags($description) . "\n\nSumber: {$source}\nTanggal: {$pubDate}",
            'video_url' => $link, // Gunakan video_url untuk link sumber
            'is_published' => true,
        ]);

        return true;
    }
}
