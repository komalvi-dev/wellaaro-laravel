<?php

namespace App\Services;

use App\Models\Condition;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Hospital;
use App\Models\Package;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ChatContextBuilder
{
    private const STOPWORDS = [
        'the', 'a', 'an', 'is', 'are', 'was', 'were', 'what', 'how', 'why', 'when',
        'where', 'which', 'who', 'do', 'does', 'did', 'can', 'could', 'would', 'should',
        'i', 'you', 'my', 'me', 'in', 'on', 'at', 'for', 'of', 'to', 'and', 'or', 'it',
        'this', 'that', 'about', 'want', 'need', 'get', 'please', 'tell',
    ];

    private const MAX_BLURBS = 10;

    public function build(string $message): string
    {
        $keywords = $this->extractKeywords($message);

        if (empty($keywords)) {
            return '';
        }

        $blurbs = array_merge(
            $this->matchTreatments($keywords),
            $this->matchHospitals($keywords),
            $this->matchPackages($keywords),
            $this->matchConditions($keywords),
            $this->matchDestinations($keywords),
            $this->matchFaqs($keywords)
        );

        return implode("\n\n", array_slice($blurbs, 0, self::MAX_BLURBS));
    }

    private function extractKeywords(string $message): array
    {
        $words = preg_split('/[^a-zA-Z0-9]+/', strtolower($message), -1, PREG_SPLIT_NO_EMPTY);

        $words = array_values(array_unique(array_filter($words, function ($word) {
            return strlen($word) >= 3 && !in_array($word, self::STOPWORDS, true);
        })));

        return array_slice($words, 0, 6);
    }

    private function likeAny(Builder $query, array $columns, array $keywords): Builder
    {
        return $query->where(function (Builder $outer) use ($columns, $keywords) {
            foreach ($keywords as $keyword) {
                $outer->orWhere(function (Builder $inner) use ($columns, $keyword) {
                    foreach ($columns as $column) {
                        $inner->orWhere($column, 'like', "%{$keyword}%");
                    }
                });
            }
        });
    }

    private function matchTreatments(array $keywords): array
    {
        return $this->likeAny(Treatment::published(), ['name', 'short_description'], $keywords)
            ->limit(3)->get()
            ->map(function (Treatment $t) {
                $usaNote = $t->cost_usa ? " (vs \${$t->cost_usa} in the US)" : '';
                $cost = $t->cost_india_min && $t->cost_india_max
                    ? " Cost in India: \${$t->cost_india_min}-\${$t->cost_india_max}{$usaNote}."
                    : '';
                $rate = $t->success_rate ? " Success rate: {$t->success_rate}%." : '';

                return "Treatment: {$t->name}. " . Str::limit($t->short_description, 200) . "{$cost}{$rate}";
            })->all();
    }

    private function matchHospitals(array $keywords): array
    {
        return $this->likeAny(Hospital::published(), ['name', 'tagline'], $keywords)
            ->limit(3)->get()
            ->map(fn (Hospital $h) => "Hospital: {$h->name}. " . Str::limit($h->tagline, 200))
            ->all();
    }

    private function matchPackages(array $keywords): array
    {
        return $this->likeAny(Package::published(), ['name', 'tagline'], $keywords)
            ->limit(3)->get()
            ->map(function (Package $p) {
                $price = $p->price_usd_from ? " From \${$p->price_usd_from}." : '';

                return "Package: {$p->name}. " . Str::limit($p->tagline, 200) . $price;
            })->all();
    }

    private function matchConditions(array $keywords): array
    {
        return $this->likeAny(Condition::published(), ['name', 'short_description'], $keywords)
            ->limit(2)->get()
            ->map(fn (Condition $c) => "Condition: {$c->name}. " . Str::limit($c->short_description, 200))
            ->all();
    }

    private function matchDestinations(array $keywords): array
    {
        return $this->likeAny(Destination::published(), ['name', 'tagline'], $keywords)
            ->limit(2)->get()
            ->map(fn (Destination $d) => "Destination: {$d->name}. " . Str::limit($d->tagline, 200))
            ->all();
    }

    private function matchFaqs(array $keywords): array
    {
        return $this->likeAny(Faq::published(), ['question', 'answer'], $keywords)
            ->limit(3)->get()
            ->map(fn (Faq $f) => "FAQ: {$f->question} — " . Str::limit($f->answer, 250))
            ->all();
    }
}
