<?php

namespace App\Console\Commands;

use App\Models\Photo;
use Illuminate\Console\Command;


class PhotoProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Applies Processing to downloaded photos';

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
        $photos = Photo::all();
        foreach ($photos as $photo) {
            #open image
            $photo_path = "{$photo->storage_path}/{$photo->name}";

            $image = \Image::make($photo_path);

            #create base64
            $base64 = $image->encode('data-url')->encoded;

            #convert to grayscale
            $grayscale = $image->greyscale()->encode('data-url')->encoded;
            #save to cache
            \Redis::hmset("images:{$photo->external_id}", 'original', $base64, 'grayscale', $grayscale);

            $this->info("{$photo->name} has been cached!");

        }
    }
}
