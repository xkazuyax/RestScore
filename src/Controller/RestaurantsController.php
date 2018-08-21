<?php
namespace App\Controller;

use \Exception;
use Cake\Log\Log;

class RestaurantsController extends AppController {
	public function initialize() {
		$this->autoRender = true;
		$this->viewBuilder()->Layout('restaurants');
	}

	public function restList() {
		if (!$this->request->session()->read('web_id')) {
			$this->request->session()->destroy();
			return $this->redirect(["controller" => "Restaurants","action" => "index"]);
		}

		$restaurants = $this->Restaurants->find("all")->contain(['Webaccounts']);
		$this->set("restaurants",$restaurants);
	}
}
