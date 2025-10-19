<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeSlugBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will create slug for the books';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $books = Book::where('slug', null)->get();
        foreach ($books as $book) {
            $book->slug = Str::slug($book->title);
            $book->save();
        }
        return command::SUCCESS;
    }
}
