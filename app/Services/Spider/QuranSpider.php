<?php

namespace App\Services\Spider;

use Generator;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Str;

class QuranSpider extends BasicSpider
{


    public array $startUrls = [
        'https://quranicaudio.com'
    ];


    public function parse(Response $response): Generator
    {
        $items = $response->filter('li')
            ->filter('a[href]')
            ->each(function (Crawler $node) {
                $item = $node->attr('href');

                if (Str::startsWith($item, '/quran')) {
                    return [
                        'url' => $item,
                        'title' => $node->text(),
                    ];
                }
                return null;
            });


        foreach ($items as $item) {
            if (!$item) {
                continue;
            }
            yield $this->item($item);
        }
    }
}
