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
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function index()
    {
        $words = Word::all();

        $subjects = Subject::all()->count();
        $papers = Paper::all()->count();
        $summaries = Summary::all()->count();
        $stories = Story::all()->count();
        $parta = Parta::all()->count();
        $partb = Partb::all()->count();
        $partc = Partc::all()->count();

        return view('welcome', compact('words', 'subjects', 'papers', 'summaries', 'stories', 'parta', 'partb', 'partc'));
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

    public function part_a()
    {
        $parta = Parta::all();
        return view('items.part_a', compact('parta'));
    }
    public function part_b()
    {
        $partb = Partb::all();
        return view('items.part_b', compact('partb'));
    }
    public function part_c()
    {
        $partc = Partc::all();
        return view('items.part_c', compact('partc'));
    }

    public function parta_show($id)
    {
        $question = Parta::findOrFail($id);
        return view('items.single.single_parta', compact('question'));
    }

    public function summaries()
    {
        $summaries = Summary::all();
        return view('items.summaries', compact('summaries'));
    }

    public function save_word(Request $request)
    {
        $word = new Word();

        // Assign values from the request
        $word->english_word = $request->input('main_word');
        $word->meaning = $request->input('translate_word');
        $word->notes = $request->input('notes');
        $word->save();

        return redirect()->route('home')->with('success', 'Word added successfully!');
    }
}
