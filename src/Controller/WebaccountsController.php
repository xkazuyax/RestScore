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

	public function detail($id = null) {
		if (!$this->request->session()->read('web_id') || $id == null) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "webaccounts","action" => "index"]);
		}
		$webaccount_data = $this->Webaccounts->find("all",[
			"conditions" => [
				"id" => $id
			]
		]);
		$this->set("webaccount_data",$webaccount_data);
		$this->set("id",$id);
	}

	public function add() {
		if (!$this->request->session()->read("web_id")) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "webaccounts","action" => "index"]);
		}

		$entity = $this->Webaccounts->newEntity();
		$this->set("entity",$entity);
	}

	public function addCheck() {
		$error = "";
		if (!$this->request->session()->read("web_id")) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "webaccounts","action" => "index"]);
		}
		if ($this->request->isPost()) {
			$entity = $this->Webaccounts->newEntity($this->request->data);
			$entity->create_date = time();
			$entity->modified_date = time();
			$pass = $this->request->data["password"];
			$pass2 = $this->request->data["password2"];
			if ($pass != $pass2) {
				$error = "パスワードが異なります";
			} else {
					$upload_file = $entity->image_path;
					//ファイルが正しくアップロードされているか
					if ($upload_file["size"] > 0 && $upload_file["tmp_name"]) {
						//ファイルを保存
						$file_path ="/var/www/html/img/".$upload_file["name"];
						if (move_uploaded_file($upload_file["tmp_name"],$file_path)) {
							$entity->image_name = $upload_file["name"];
							if ($this->Webaccounts->save($entity)) {
								$this->redirect(["controller" => "webaccounts","action" => "addComplete"]);
							}
						}
					}

			}
		}
		$this->set("entity",$entity);
		$this->set("error",$error);
	}

	public function addComplete() {
		if (!$this->request->session()->read("web_id")) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "Webaccounts","action" => "index"]);
		}
	}

	public function update($id=null) {
		if (!$this->request->session()->read("web_id") || $id == null) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "Webaccounts","action" => "index"]);
		}
		$webaccount = $this->Webaccounts->find("all",[
			"conditions" => [
				"id" => $id
			]
		]);
		$this->set("entity",$this->Webaccounts->get($id));
	}
}
?>