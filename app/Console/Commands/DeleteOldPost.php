<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class DeleteOldPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will delete older posts.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('status', 0)->take(50)->get();

        if (! $posts->count() > 0) {
            $this->info('Unable to find the posts');
            return;
        }

        foreach ($posts as $post) {
            $post->delete();
        }

        $this->info('posts are deleted successfully');

        return;

    }
}
