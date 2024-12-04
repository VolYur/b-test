<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AccessLink extends Authenticatable
{
    protected $table = 'access_links';
}
