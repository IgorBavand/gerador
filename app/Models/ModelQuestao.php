<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelQuestao extends Model
{
    protected $table = 'questao';
    protected $fillable=['id_user','assunto','texto'];

    public function relAlt(){
        return $this->hasMany('App\Models\ModelAlternativas', 'id_questao');
    }
}
