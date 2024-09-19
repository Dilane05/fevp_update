<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Method getFaqQuestionAttribute
     *
     * Returns the FAQ question attribute. It checks the application's locale setting and
     * returns the English version if the locale is 'en', otherwise returns the French version.
     *
     * @return string The FAQ question in the appropriate language, English or French.
     */

    public function getFaqQuestionAttribute(): string
    {
        return app()->getLocale() == 'en' ? $this->faq_question_en : $this->faq_question_fr;
    }

    public function getFaqAnswerAttribute()
    {
        return app()->getLocale() == 'en' ? $this->faq_answer_en : $this->faq_answer_fr;
    }

    public static function search($query)
    {
        return empty($query)
            ? static::query()
            : static::query()
                ->where(function ($q) use ($query) {
                    $q->where('faq_question_en', 'like', '%' . $query . '%');
                    $q->orWhere('faq_question_fr', 'like', '%' . $query . '%');
                    $q->orWhere('faq_answer_en', 'like', '%' . $query . '%');
                    $q->orWhere('faq_answer_fr', 'like', '%' . $query . '%');
                });
    }
}
