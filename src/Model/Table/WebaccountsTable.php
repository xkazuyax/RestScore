<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class WebaccountsTable extends Table {
	public function validationDefault(Validator $validator) {
		$validator->maxlength("login_id",20,"20文字以内で入力してください")->ascii("login_id","半角英数字のみです");
		$validator->maxLength("password",20,"a20文字以内で入力してください")->ascii("password","半角英数字のみです");
		return $validator;
	}
}

?>