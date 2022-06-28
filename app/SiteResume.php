<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteResume extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'site_resumes';
    protected $guarded = [];
}
