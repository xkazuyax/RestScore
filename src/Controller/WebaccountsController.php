<?php
namespace App\Controller;

use \Exception;
use Cake\Log\Log;

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

	public function detail($id = null, $error_flag = null) {
		if (!$this->request->session()->read('web_id') || $id == null) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "webaccounts","action" => "index"]);
		}
		$webaccount_data = $this->Webaccounts->find("all",[
			"conditions" => [
				"id" => $id
			]
		]);

		$this->set("error_flag",$error_flag);
		$this->set("webaccount_data",$webaccount_data);
		$this->set("id",$id);
		$this->set("login_account_id",$this->request->session()->read("web_id"));
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

		$webaccount_data = $this->Webaccounts->find("all",[
			"conditions" => [
				"id" => $id
			]
		]);
		$this->set("webaccount_data",$webaccount_data);
		$this->set("id",$id);
		try {
		$this->set("entity",$this->Webaccounts->get($id));
		} catch(Exception $e) {
			Logg::write("debug",$e->getMessage());
		}

	}

	public function updateCheck() {
		if (!$this->request->session()->read("web_id")) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "Webaccounts","action" => "index"]);
		}
		$error = "";
		if ($this->request->is('put')) {
			$new_entity = $this->Webaccounts->newEntity($this->request->data);
			try {
				$entity = $this->Webaccounts->get($this->request->data['id']);
			} catch(Exception $e) {
				Logg:write("debug",$e->getMessage());
			}
			if ($this->request->data['pass'] == $this->request->data['pass2']) {
				//パスワードが入力されている場合のみ、Entityに追加
				if ($this->request->data["pass"]) {
					$entity->password = $this->request->data['pass'];
				}
				$upload_file = $_FILES["image_path"];
				//アップロードファイルがある場合のみ、Entityに追加
				if ($upload_file) {
					//ファイルが正しくアップロードされているか
					if ($upload_file["size"] > 0 && $upload_file["tmp_name"]) {
						//ファイルを保存
						$file_path ="/var/www/html/img/".$upload_file["name"];
						if (move_uploaded_file($upload_file["tmp_name"],$file_path)) {
							if ($upload_file['name'] != $entity->image_name) {
								unlink('/var/www/html/img/'.$entity->image_name);
							}
							$entity->image_name = $upload_file["name"];
						}
					}
				}
			} else {
				$error = "パスワードが一致しません";
			}
			$entity->modified_date = time();
			$this->Webaccounts->patchEntity($entity,$this->request->data);
			if ($this->Webaccounts->save($entity)) {
				$this->redirect(["controller" => "webaccounts","action" => "updateComplete"]);
			}
		} else {
			$new_entity = $this->Form->newEntity();

		}
		$this->set("error",$error);
		$this->set("id",$this->request->data['id']);
		$this->set("entity",$new_entity);
	}

	public function updateComplete() {
		if (!$this->request->session()->read("web_id")) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "Webaccounts","action" => "index"]);
		}
	}

	public function delete($id = null) {
		if (!$this->request->session()->read('web_id') || $id == null) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "Webaccounts","action" => "index"]);
		}
		try {
			$entity = $this->Webaccounts->get($id);
			if ($this->Webaccounts->delete($entity)) {
			     $this->Webaccounts->unlink('/var/www/html/img/'.$entity->image_name);
			}
		} catch(Exception $e) {
			Log::write("debug",$e->getMessage());
		}

	}

	public function logout() {
	   $this->request->session()->destroy();
	   return $this->redirect(["controller" => "Webaccounts","action" => "index"]);
	}
}
?>