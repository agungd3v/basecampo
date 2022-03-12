<?php

namespace Modules\V1\Repository;

use App\Models\User;

class GlobalRepository {

  public function getUserIsSameDivison($divisionId) {
    return User::where('division_id', $divisionId)
               ->orderBy('name', 'asc')
               ->get();
  }

}