<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class WebaccountsTable extends Table {
	public function validationDefault(Validator $validator) {
		$validator->maxlength("login_id",20,"20文字以内で入力してください")->ascii("login_id","半角英数字のみです");
		$validator->maxLength("password",20,"20文字以内で入力してください")->ascii("password","半角英数字のみです")->minLength("password",8,"8文字以上で入力してください");
		$validator->maxLength("name",20,"20文字以内で入力してください");
		$validator->numeric("latitude")->range("latitude",20,45);
		$validator->numeric("longitude")->range("longitude",120,140);
		return $validator;
	}
}

?>