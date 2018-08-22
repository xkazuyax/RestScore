<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class BoardsTable extends Table {
    public function initialize(array $config) {
        $this->belongsTo("Webaccounts");
    }

    public function validationDefault(Validator $validator) {
        $validator->maxLength("comment",200,"200文字以内で入力してください");
        return $validator;
    }
}


?>