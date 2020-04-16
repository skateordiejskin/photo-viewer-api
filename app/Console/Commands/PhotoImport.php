<?php

namespace App\Console\Commands;

use App\Models\Photo;
use Illuminate\Console\Command;

class PhotoImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downloads photos from csv and saves them to storage directory';

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

        $file = fopen(public_path() . "/photo_list.csv", "r");


        $image_path = storage_path('app/public/images');
        #create dir if it doesn't exist
        if (!file_exists($image_path)) {
            mkdir($image_path, 0777, true);
        }
        #file is small so just iterating through it
        #generator seems like overkill
        while (!feof($file)) {
            $image = fgetcsv($file);
            if (is_bool($image)) {
                continue;
            }

            #turning the url into the filename
            $url = $image[0];
            $name = str_replace('/', '_', str_replace('https://', '', $url)) . ".jpg";

            #saving all the files as pngs if it doesn't exist
            if (!file_exists("{$image_path}/{$name}.jpg")) {
                $nameArr = explode('_', str_replace('.jpg', '', $name));


                $dimensions = [
                    'height' => array_pop($nameArr),
                    'width' => array_pop($nameArr)
                ];
                file_put_contents("{$image_path}/{$name}", file_get_contents($url));
                Photo::create([
                    'name' => $name,
                    'url' => $url,
                    'storage_path' => $image_path,
                    'storage_location' => 'local',
                    'external_id' => array_pop($nameArr),
                    'dimensions' => $dimensions,
                    'metadata' => []
                ]);
                $this->info("{$name} has been downloaded successfully!");
            }
        }

        fclose($file);
    }
}
