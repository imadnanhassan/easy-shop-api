<?php

namespace App\Repositories;

use App\Models\Faq;
use App\Repositories\Interface\FaqInterface;

class FaqRepositories implements FaqInterface
{

    public function all()
    {
        return Faq::get();
    }

    public function store(array $data): void
    {
        $faq = new Faq();
        $question['en'] = $data['question'];
        $faq->question = json_encode($question);
        $answer['en'] = $data['answer'];
        $faq->answer = json_encode($answer);
        $faq->status = $data['status'];
        $faq->priority = $data['priority'];
        $faq->save();
    }

    public function update(array $data, $id): void
    {
        $faq = Faq::where('id', $id)->first();
        if ($faq) {

            $newQuestion['en'] = json_decode($faq->question)->en;
            foreach ($data['language'] as $key => $language) {
                if ($data['question'][$key]) {
                    $newQuestion[$language] = $data['question'][$key];
                }
            }
            $faq->question = json_encode($newQuestion);

            $newAnswer['en'] = json_decode($faq->answer)->en;
            foreach ($data['language'] as $key => $language) {
                if ($data['answer'][$key]) {
                    $newAnswer[$language] = $data['answer'][$key];
                }
            }
            $faq->answer = json_encode($newAnswer);

            $faq->status = $data['status'];
            $faq->priority = $data['priority'];
            $faq->save();
        }
    }

    public function delete($id): void
    {
        Faq::where('id', $id)->first()?->delete();
    }
    public function statusChange($id)
    {
        $faq = Faq::find($id);
        if ($faq->status == 1) {
            $faq->status = 0;
        } else {
            $faq->status = 1;
        }
        $faq->save();
    }

    public function restore($id): void
    {
        Faq::withTrashed()->where('id', $id)->first()?->restore();
    }

    public function onlyTrashed(): array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
    {
        return Faq::onlyTrashed()->get();
    }

    public function forceDelete($id): void
    {
        $value = Faq::withTrashed()->find($id);
        if ($value) {
            $value->forceDelete();
        }
    }
}
