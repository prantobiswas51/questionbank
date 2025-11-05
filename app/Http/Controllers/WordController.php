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
        $query = PartA::with('story'); // include story relationship

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('part_a_qs', 'like', "%{$search}%")
                ->orWhereHas('story', function ($q) use ($search) {
                    $q->where('story_name', 'like', "%{$search}%");
                });
        }
        $parta = $query->get();

        return view('items.part_a', compact('parta'));
    }
    public function part_b(Request $request)
    {
        $query = PartB::with('story'); // include story relationship

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('part_b_qs', 'like', "%{$search}%")
                ->orWhereHas('story', function ($q) use ($search) {
                    $q->where('story_name', 'like', "%{$search}%");
                });
        }

        $partb = $query->get();

        return view('items.part_b', compact('partb'));
    }
    public function part_c(Request $request)
    {
        $query = PartC::with('story'); // include story relationship

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('part_c_qs', 'like', "%{$search}%")
                ->orWhereHas('story', function ($q) use ($search) {
                    $q->where('story_name', 'like', "%{$search}%");
                });
        }

        $partc = $query->get();

        return view('items.part_c', compact('partc'));
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
        $word = new Word();

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::make()
                ->title('Subjects Loaded')
                ->body('All subjects have been successfully loaded.')
                ->success()
                ->send();                 // optional: also show real-time notification
        }

        // Assign values from the request
        $word->english_word = $request->input('main_word');
        $word->meaning = $request->input('translate_word');
        $word->notes = $request->input('notes');
        $word->save();

        return redirect()->route('home')->with('success', 'Word added successfully!');
    }
}
