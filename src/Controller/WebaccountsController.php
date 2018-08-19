<?php
namespace App\Controller;

class WebaccountsController extends AppController {
	public function initialize() {
		$this->autoRender = true;
		$this->viewBuilder()->Layout('webaccounts');
	}

	public function index() {
		$this->viewBuilder()->Layout(false);
		$entity = $this->Webaccounts->newEntity();
		$this->set("entity",$entity);
	}

	public function loginCheck() {
		$this->viewBuilder()->Layout(false);
		$entity = $this->Webaccounts->newEntity($this->request->data);
		$error = "";
		if ($this->request->isPost()) {
			$login_id = $this->request->data['login_id'];
			$pass = $this->request->data['pass'];
			$webaccounts = $this->Webaccounts->find("all",[
				"conditions" => [
					"login_id" => $login_id,
					"password" => $pass
				]
			]);
			if ($webaccounts->count() == 1) {
				$webaccount = $webaccounts->toArray();
				$web_id = $webaccount[0]["id"];
				$web_name = $webaccount[0]["name"];
				$web_type = $webaccount[0]["type"];
				$this->request->session()->write(["web_id" => $web_id,
					"web_name" => $web_name,
					"web_role" => $web_type
				]);
				$this->redirect(["controller" => "webaccounts","action" => "webList"]);
			} else {
				$error = "IDまたはパスワードが異なります";
			}
		}
		$this->set("error","IDまたはパスワードが異なります");
		$this->set("entity",$entity);
	}

	public function webList() {
		if (!$this->request->session()->read('web_id')) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "webaccounts","action" => "index"]);
		}
		$webaccounts = $this->Webaccounts->find("all");
		$this->set("webaccount_datas",$webaccounts);
	}
}
?>