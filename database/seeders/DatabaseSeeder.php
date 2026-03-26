<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Paper;
use App\Models\Partc;
use App\Models\Story;
use App\Models\Subject;
use App\Models\User;
use App\Models\Year;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Year::create([
            'year' => '1',
        ]);
        Year::create([
            'year' => '2',
        ]);
        Year::create([
            'year' => '3',
        ]);
        Year::create([
            'year' => '4',
        ]);

        Subject::create([
            'year_id' => 4,
            'subject_name' => 'English',
        ]);

        Paper::create([
            'subject_id' => 1,
            'paper_code' => 1454,
            'paper_name' => 'English 1st Paper',
        ]);

        Author::create([
            'name' => 'Pranto',
        ]);

        Story::create([
            'author_id' => 1,
            'story_name' => 'The Story of My Life',
        ]);

        Partc::create([
            'story_id' => 1,
            'part_c_qs' => 'Who was The Story of My Life written by?',
            'part_c_ans' => 'Fate plays a vital role in the novel Tess of the D’Urbervilles. Here the novelist Thomas Hardy uses fate as a living being which dominates all the characters in the novel.

            Tess, the heroine of the novel, meets Alec after a horse accident. Tess takes responsibility for her family, and so she is sent to the D’Urbervilles to get a job. Alec tries to seduce her. On a Saturday in September, Tess is returning from the market of Chaseborough to Trantridge. Her drunken companions cheat her, and so she wants to take help from Alec. Alec takes advantage of this opportunity and seduces her. A villain acts against her will.

            Afterwards, Tess comes back home. She gives birth to a child and names her child Sorrow. Some days later, her child dies. Her family falls into financial crisis. Tess manages to get a job and dreams of a new life in a new place. Angel comes to the same place for farming. Here, fate makes Tess fall in love with Angel. Both of them enjoy their time together. But fate does not help them achieve long-lasting happiness.

            After marriage, Tess reveals her past to Angel, and so Angel leaves her and goes to Brazil. Though Tess asks him to forgive her, Angel does not forgive her. He replies:

            "O Tess, forgiveness does not apply to the case!”

            Then Tess comes to Flintcomb Ash and tries to settle her heart and soul. Unfortunately, she meets Alec once again. Fate brings great suffering to Tess, as she cannot refuse his proposal due to the economic crisis of her family. She accepts his proposal and becomes a victim of fate.

            On the other hand, Angel comes back to Tess and asks her to forgive him. Tess kills Alec, but she is later arrested and hanged for the murder.

            Thus, we can say that fate plays a hostile role in the life of Tess.',
        ]);
    }
}
