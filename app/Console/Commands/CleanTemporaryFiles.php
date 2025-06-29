<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanTemporaryFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-temporary-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean the app/temp directory';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $directory = storage_path('app/public/temp');
        $files = scandir($directory);
        foreach($files as $file) {
            if ($file != '.' && $file != '..') {
                $file_path = $directory . '/' . $file;
                if (is_file($file_path)) {
                    unlink($file_path);
                }
            }
        }
    }
}
