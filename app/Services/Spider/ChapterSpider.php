<?php

namespace App\Services\Spider;

use Generator;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Str;

class ChapterSpider extends BasicSpider
{

    public array $startUrls = [];

    public function parse(Response $response): Generator
    {
        $items = $response->getBody();
        dd($items);

        foreach ($items as $item) {
            if (!$item) {
                continue;
            }
            yield $this->item($item);
        }
    }
}
