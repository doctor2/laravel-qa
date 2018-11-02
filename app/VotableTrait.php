<?php

namespace App;

trait VotableTrait
{
    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }
}