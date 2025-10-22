<?php

namespace App\Filament\Resources\Stories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('paper_id')->options(function () {
                    return \App\Models\Paper::all()->pluck('paper_name', 'id');
                })->required(),
                Select::make('author_id')->options(function () {
                    return \App\Models\Author::all()->pluck('name', 'id');
                })->required(),
                TextInput::make('story_name')
                    ->required(),
                Select::make('story_type')
                    ->options([
                        'essay' => 'Essay',
                        'poem' => 'Poem',
                        'epic' => 'Epic',
                        'ode' => 'Ode',
                        'haiku' => 'Haiku',
                        'limerick' => 'Limerick',
                        'sonnet' => 'Sonnet',
                        'prose' => 'Prose',
                        'article' => 'Article',
                        'letter' => 'Letter',
                        'note' => 'Note',
                        'memoir' => 'Memoir',
                        'vignette' => 'Vignette',
                        'anecdote' => 'Anecdote',
                        'parable' => 'Parable',
                        'fable' => 'Fable',
                        'novel' => 'Novel',
                        'novella' => 'Novella',
                        'short story' => 'Short story',
                        'biography' => 'Biography',
                        'autobiography' => 'Autobiography',
                        'journal' => 'Journal',
                        'diary' => 'Diary',
                        'narrative' => 'Narrative',
                        'play' => 'Play',
                        'drama' => 'Drama',
                        'screenplay' => 'Screenplay',
                        'monologue' => 'Monologue',
                        'sermon' => 'Sermon',
                        'treatise' => 'Treatise',
                        'manifesto' => 'Manifesto',
                    ])
                    ->required(),
            ]);
    }
}
