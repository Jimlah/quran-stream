<?php

namespace App\Console\Commands;

use App\Models\Reciter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExtractQuran extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:extract-quran';

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
        $http = Http::baseUrl('https://quranicaudio.com/api');

        // $items = Roach::collectSpider(QuranSpider::class);

        // foreach ($items as $item) {
        //     Roach::collectSpider(
        //         ChapterSpider::class,
        //         new Overrides(startUrls: [sprintf('https://quranicaudio.com%s', $item['url'])])
        //     );
        // }

        // 'https://quranicaudio.com/api/qaris/1/audio_files/mp3'

        // https://download.quranicaudio.com/quran/abdullaah_3awwaad_al-juhaynee/002.mp3

        $http->get('/qaris')
            ->collect()
            ->each(function ($item) use ($http) {
                $reciter = Reciter::query()->updateOrCreate([
                    'slug' => Str::slug($item['name']),
                    'name' => $item['name'],
                    'pathname' => $item['relative_path'],
                ], []);
                $this->info("Processing Reciter {$reciter->name}");
                $relativePath = $item['relative_path'];
                $quranHttp = Http::baseUrl("https://download.quranicaudio.com/quran/{$relativePath}")
                    ->withHeader('accept', 'application/octet-stream');

                $http->get("/qaris/{$item['id']}/audio_files/mp3")
                    ->collect()
                    ->each(function ($item) use ($quranHttp, $relativePath) {
                        $fileName = $item['file_name'];
                        $this->info("Downloading {$fileName}");
                        $filepath = $relativePath . $fileName;

                        $url = "https://download.quranicaudio.com/quran/{$filepath}";
                        // dd(Storage::get($url), $url);
                        Storage::disk('s3')->put($filepath, file_get_contents("https://download.quranicaudio.com/quran/{$filepath}"));
                        $this->info("Downloaded {$fileName}");
                    });
            });

        $this->info('Command executed');
    }
}
