<?php

namespace App\Helpers;

use DOMDocument;
use DOMXPath;

class WordTranslationHelper
{
    /**
     * Wraps words in the answer text with translation tooltips
     * while preserving HTML structure
     */
    public static function wrapWordsWithTooltips($html, $words)
    {
        if (empty($words) || empty($html)) {
            return $html;
        }

        // Sort words by length (longest first) to avoid partial matches
        $wordsSorted = $words->sortByDesc(function ($word) {
            return strlen($word->english_word);
        })->values();

        $result = $html;

        foreach ($wordsSorted as $word) {
            $wordText = $word->english_word;
            $meaning = htmlspecialchars($word->meaning, ENT_QUOTES, 'UTF-8');
            $displayWord = htmlspecialchars($wordText, ENT_QUOTES, 'UTF-8');

            // Word boundary regex pattern - matches whole words only (case-insensitive)
            $pattern = '/\b(' . preg_quote($wordText, '/') . ')\b/i';
            
            // Replacement that wraps the word in a span with tooltip attributes
            $replacement = '<span class="word-tooltip" data-word="' . $displayWord . '" data-meaning="' . $meaning . '" title="' . $meaning . '">$1</span>';
            
            $result = preg_replace($pattern, $replacement, $result);
        }

        return $result;
    }
}
