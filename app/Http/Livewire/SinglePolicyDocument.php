<?php

namespace App\Http\Livewire;

use App\Models\Topic;
use App\Models\TopicDocument;
use Livewire\Component;

class SinglePolicyDocument extends Component
{
    public $topicId;
    public $topic;
    public $documents;

    public function mount()
    {
        $this->topic = Topic::findOrFail($this->topicId);
        $this->documents = TopicDocument::where('topic_id',$this->topicId)->get();
    }

    public function render()
    {
        return view('livewire.single-policy-document');
    }
}
