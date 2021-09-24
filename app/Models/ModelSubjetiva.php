<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelSubjetiva extends Model
{
    protected $table = 'subjetiva';
    protected $fillable=['id_questao','resposta'];

    public function relQuestao(){
        return $this->hasOne('App\Models\ModelQuestao', 'id', 'id_questo');
    }
}