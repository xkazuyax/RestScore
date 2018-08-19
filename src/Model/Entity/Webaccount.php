<?php
	namespace App\Model\Entity;

	use Cake\ORM\Entity;

	class Webaccount extends Entity {
		protected $_accessible= [
			'*' => true,
			'id' => false
		];
	}
?>