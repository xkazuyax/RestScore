<?php
	namespace App\Model\Table;

	use Cake\ORM\Table;
	use Cake\ORM\Query;
	use Cake\Validation\Validator;
	use Cake\ORM\RulesChecker;

	class RestaurantsTable extends Table {
		public function initialize(array $config) {
			$this->belongsTo('Webaccounts');
		}

		public function validationDefault(Validator $validator) {
			$validator->maxLength("name",20,"20文字で入力してください");
			$validator->maxLength("appear_image",40,"40文字以内で入力してください");
			$validator->maxLenght("menu_image",40,"40文字以内で入力してください");
			$validator->maxLength("place",20,"20文字以内で入力してください");
			$validator->numeric("latitude");
			$validator->numeric("longitude");
			$validator->maxLength("oc_time",20,"20文字以内で入力してください");
			return $validator;
		}
	}

?>