<?php
	namespace App\Model\Entity;

	use Cake\ORM\Entity;

	class Restaurant extends Entity {
		protected $_accessible = [
			'*' => true,
			'id' => false
		];
	}
?>