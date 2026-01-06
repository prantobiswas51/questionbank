<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\Paper;
use App\Models\Parta;
use App\Models\Partb;
use App\Models\Partc;
use App\Models\Story;
use App\Models\Subject;
use App\Models\Summary;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query for words
        $wordsQuery = Word::query();

        // Check if a search term 'q' is present in the request
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $wordsQuery->where('english_word', 'like', '%' . $searchTerm . '%');
        }

        // Execute the query to get the filtered/unfiltered list of words
        $words = $wordsQuery->get();

        // Retrieve counts for other models
        $subjects = Subject::all()->count();
        $papers = Paper::all()->count();
        $summaries = Summary::all()->count();
        $stories = Story::all()->count();
        $parta = Parta::all()->count();
        $partb = Partb::all()->count();
        $partc = Partc::all()->count();

        return view('welcome', compact(
            'words',
            'subjects',
            'papers',
            'summaries',
            'stories',
            'parta',
            'partb',
            'partc'
        ));
    }

    public function subjects()
    {

        $subjects = Subject::all();



        return view('items.subjects', compact('subjects'));
    }

    public function papers()
    {
        $papers = Paper::all();
        return view('items.papers', compact('papers'));
    }

    public function stories()
    {
        $stories = Story::all();
        return view('items.stories', compact('stories'));
    }

    public function part_a(Request $request)
    {
        $query = Parta::with('story.paper'); // load story + paper relationships

        // 🔍 Search by question or story name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('part_a_qs', 'like', "%{$search}%")
                    ->orWhereHas('story', function ($sub) use ($search) {
                        $sub->where('story_name', 'like', "%{$search}%");
                    });
            });
        }

        // 📘 Filter by Paper (through Story)
        if ($request->filled('paper_id')) {
            $query->whereHas('story', function ($q) use ($request) {
                $q->where('paper_id', $request->paper_id);
            });
        }

        // 📖 Filter by Story
        if ($request->filled('story_id')) {
            $query->where('story_id', $request->story_id);
        }

        $papers = Paper::all();
        $stories = Story::all();
        $parta = $query->get();

        return view('items.part_a', compact('parta', 'papers', 'stories'));
    }

    public function part_b(Request $request)
    {
        $query = Partb::with('story.paper'); // load story + paper relationships

        // 🔍 Search by question or story name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('part_b_qs', 'like', "%{$search}%")
                    ->orWhereHas('story', function ($sub) use ($search) {
                        $sub->where('story_name', 'like', "%{$search}%");
                    });
            });
        }

        // 📘 Filter by Paper (through Story)
        if ($request->filled('paper_id')) {
            $query->whereHas('story', function ($q) use ($request) {
                $q->where('paper_id', $request->paper_id);
            });
        }

        // 📖 Filter by Story
        if ($request->filled('story_id')) {
            $query->where('story_id', $request->story_id);
        }

        $papers = Paper::all();
        $stories = Story::all();
        $partb = $query->get();

        return view('items.part_b', compact('partb', 'papers', 'stories'));
    }


    public function part_c(Request $request)
    {
        $query = Partc::with('story.paper'); // load story + paper relationships

        // 🔍 Search by question or story name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('part_c_qs', 'like', "%{$search}%")
                    ->orWhereHas('story', function ($sub) use ($search) {
                        $sub->where('story_name', 'like', "%{$search}%");
                    });
            });
        }

        // 📘 Filter by Paper (through Story)
        if ($request->filled('paper_id')) {
            $query->whereHas('story', function ($q) use ($request) {
                $q->where('paper_id', $request->paper_id);
            });
        }

        // 📖 Filter by Story
        if ($request->filled('story_id')) {
            $query->where('story_id', $request->story_id);
        }

        $papers = Paper::all();
        $stories = Story::all();
        $partc = $query->get();

        return view('items.part_c', compact('partc', 'papers', 'stories'));
    }


    public function parta_show($id)
    {
        $question = Parta::findOrFail($id);
        return view('items.single.single_parta', compact('question'));
    }

    public function partb_show($id)
    {
        $question = Partb::findOrFail($id);
        return view('items.single.single_partb', compact('question'));
    }

    public function partc_show($id)
    {
        $question = Partc::findOrFail($id);
        return view('items.single.single_partc', compact('question'));
    }


    public function paper_show($id)
    {
        $paper = Paper::findOrFail($id);
        $stories = Story::where('paper_id', $paper->id)->get();
        return view('items.single.single_paper', compact('paper', 'stories'));
    }

    public function summaries()
    {
        $summaries = Summary::all();
        return view('items.summaries', compact('summaries'));
    }

    public function summaries_show($id)
    {
        $summary = Summary::findOrFail($id);
        return view('items.single.single_summary', compact('summary'));
    }

    public function save_word(Request $request)
    {
        $mainWord = $request->input('main_word');

        // Check if word already exists
        if (Word::where('english_word', $mainWord)->exists()) {
            return redirect()->route('home')->with('error', 'This word already exists in the database!');
        }

        $word = new Word();

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::make()
                ->title('Word Added')
                ->body('A new word has been successfully added: ' . $mainWord)
                ->success()
                ->send();
        }

        // Assign values from the request
        $word->english_word = $mainWord;
        $word->meaning = $request->input('translate_word');
        $word->notes = $request->input('notes');
        $word->save();

        return redirect()->route('home')->with('success', 'Word added successfully!');
    }

    public function update_word(Request $request, $id)
    {
        $word = Word::findOrFail($id);
        $mainWord = $request->input('main_word');

        // Check if another word with the same name exists (but not the current word)
        if (Word::where('english_word', $mainWord)->where('id', '!=', $id)->exists()) {
            return redirect()->route('home')->with('error', 'This word already exists in the database!');
        }

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::make()
                ->title('Word Updated')
                ->body('The word "' . $mainWord . '" has been successfully updated.')
                ->success()
                ->send();
        }

        // Update values
        $word->english_word = $mainWord;
        $word->meaning = $request->input('translate_word');
        $word->notes = $request->input('notes');
        $word->save();

        return redirect()->route('home')->with('success', 'Word updated successfully!');
    }
}
