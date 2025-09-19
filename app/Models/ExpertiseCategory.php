<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExpertiseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_de',
        'slug',
        'description',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function mentors(): BelongsToMany
    {
        return $this->belongsToMany(Mentor::class, 'mentor_expertise', 'expertise_category_id', 'mentor_id');
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }

    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('name');
    }

    #[Scope]
    protected function popular(Builder $query): void
    {
        $query->withCount('mentors')
            ->orderByDesc('mentors_count');
    }

    #[Scope]
    protected function withMentors(Builder $query): void
    {
        $query->whereHas('mentors', function (Builder $mentorQuery) {
            $mentorQuery->approved();
        });
    }

    public function getDisplayNameAttribute(): string
    {
        return app()->getLocale() === 'de' && $this->name_de
            ? $this->name_de
            : $this->name;
    }
}
