<?php

namespace App\Filament\Resources\Partas\Pages;

use App\Filament\Resources\Partas\PartaResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\PartA;

class CreateParta extends CreateRecord
{
    protected static string $resource = PartaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remove top-level fields that would trigger auto-insert
        return [
            'story_id' => $data['story_id'], // keep story_id for afterCreate only
            'questions' => $data['questions'] ?? [], // keep repeater
        ];
    }

    protected function afterCreate(): void
    {
        $data = $this->form->getState(); // get all submitted form data

        foreach ($data['questions'] as $item) {
            // Only save if question text isn't empty
            if (!empty(trim($item['part_a_qs'] ?? ''))) {
                PartA::create([
                    'story_id'   => $data['story_id'],
                    'part_a_qs'  => $item['part_a_qs'],
                    'part_a_ans' => $item['part_a_ans'] ?? null,
                    'part_a_note' => $item['part_a_note'] ?? null,
                ]);
            }
        }
    }
}
