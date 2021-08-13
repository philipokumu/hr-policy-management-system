<?php

namespace Database\Factories;

use App\Models\TopicDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicDocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TopicDocument::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'topic_id'=>1,
            'document_name'=>'General-Principles',
        ];
    }
}
