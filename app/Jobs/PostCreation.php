<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PostCreation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $title;
    public $description;
    public $image = 'image.png';
    public $userId = 1;
    /**
     * Create a new job instance.
     */
    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        for ($i = 0; $i < 1000; $i++) {

            Post::create([
                'user_id' => $this->userId,
                'title' => $this->title,
                'description' => $this->description,
                'image' => $this->image
            ]);

        }
    }
}
