<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelAlternativas extends Model
{
    protected $table = 'alternativa';
    protected $fillable=['id_questao','alternativa','check'];


    public function relQuest(){
        return $this->hasOne('App\Models\ModelQuestao', 'id', 'id_questo');
    }
}
