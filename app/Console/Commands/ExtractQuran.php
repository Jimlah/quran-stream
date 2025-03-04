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
            ->each(function ($item) {
                $reciter = Reciter::query()->updateOrCreate([
                    'slug' => Str::slug($item['name']),
                    'name' => $item['name'],
                    'pathname' => $item['relative_path'],
                ], []);
            })
            ->dd()
            ->filter(fn($item) => Str::contains($item['name'], 'Abdur-Rahman as-Sudais'))
            ->each(function ($item) use ($http) {
                $this->info("Processing Reciter {$item['name']}");
                $relativePath = $item['relative_path'];
                $quranHttp = Http::baseUrl("https://download.quranicaudio.com/quran/{$relativePath}")
                    ->withHeader('accept', 'application/octet-stream');
                $http->get("/qaris/{$item['id']}/audio_files/mp3")
                    ->collect()
                    ->each(function ($item) use ($quranHttp, $relativePath) {
                        $fileName = $item['file_name'];
                        $this->info("Downloading {$fileName}");
                        $filepath = $relativePath . $fileName;
                        $response = $quranHttp->get($fileName);
                        Storage::disk('local')->put($filepath, $response->body());
                        $this->info("Downloaded {$fileName}");
                    });

                $this->info("Reciter {$item['name']} done");
            });

        $this->info('Command executed');
    }
}
