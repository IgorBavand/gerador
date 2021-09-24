<?php
//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
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelQuestao extends Model
{
    protected $table = 'questao';
    protected $fillable=['id_user','assunto','texto'];

    public function relAlt(){
        return $this->hasMany('App\Models\ModelAlternativas', 'id_questao');
    } 

    public function relSub(){
        return $this->hasOne('App\Models\ModelSubjetiva', 'id_questao');
    }
}