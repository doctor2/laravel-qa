<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Question extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = ['title', 'body'];
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

   public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        // $this->attributes['slug'] = str_slug($value);
    }
    public function getUrlAttribute()
    {
    	return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute()
    {
    	// return $this->created_at->format('d/m/Y');
    	return $this->created_at->diffForHumans();

    }

    public function getStatusAttribute()
    {
        if($this->answers_count > 0)
        {
            if($this->best_answer_id)
            {
                return "answered-accepted";
            }
            return "answered";
        }

        return "unanswered";
    }
    
    public function getBodyHtmlAttribute()
    {
        return parsedown($this->body);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
