<?php
namespace App\Controller;

use \Exception;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;

class UseraccountsController extends AppController {
    public $restaurants;

	public function initialize() {
		$this->autoRender = true;
		$this->viewBuilder()->Layout('useraccounts');
	}

	public function loginCheck() {
	    $this->autoRender = false;
		$this->viewBuilder()->Layout(false);
		$entity = $this->Useraccounts->newEntity($this->request->data);
		$error = "";
		if ($this->request->isPost()) {
			$login_id = $this->request->data['login_id'];
			$pass = $this->request->data['pass'];
			$useraccounts = $this->Useraccounts->find("all",[
				"conditions" => [
					"login_id" => $login_id,
					"password" => $pass
				]
			]);
			if ($useraccounts->count() == 1) {
				$useraccount = $useraccounts->toArray();
				$user_id = $useraccount[0]["id"];
				$user_name = $useraccount[0]["name"];

				//Androidに応答を返す処理
			} else {
				$error = "IDまたはパスワードが異なります";
			}
		}
		//エラーを返す処理

	}

	public function userList() {
		if (!$this->request->session()->read('web_id')) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "webaccounts","action" => "index"]);
		}
		$useraccounts = $this->Useraccounts->find("all");
		$this->set("useraccount_datas",$useraccounts);
	}

	public function detail($id = null) {
		if (!$this->request->session()->read('web_id') || $id == null) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "webaccounts","action" => "index"]);
		}
		$useraccount_data = $this->Useraccounts->find("all",[
			"conditions" => [
				"id" => $id
			]
		]);
		$this->set("useraccount_data",$useraccount_data);
		$this->set("id",$id);
	}

	public function add() {
		if (!$this->request->session()->read("web_id")) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "webaccounts","action" => "index"]);
		}

		$entity = $this->Useraccounts->newEntity();
		$this->set("entity",$entity);
	}

	public function addCheck() {
		$error = "";
		if (!$this->request->session()->read("web_id")) {
			$this->request->session()->destroy();
			$this->redirect(["controller" => "webaccounts","action" => "index"]);
		}
		if ($this->request->isPost()) {
			$entity = $this->Useraccounts->newEntity($this->request->data);
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
							if ($this->Useraccounts->save($entity)) {
								$this->redirect(["controller" => "useraccounts","action" => "addComplete"]);
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

		$useraccount_data = $this->Useraccounts->find("all",[
			"conditions" => [
				"id" => $id
			]
		]);
		$this->set("useraccount_data",$useraccount_data);
		$this->set("id",$id);
		try {
		$this->set("entity",$this->Useraccounts->get($id));
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
			$new_entity = $this->Useraccounts->newEntity($this->request->data);
			try {
				$entity = $this->Useraccounts->get($this->request->data['id']);
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
			$this->Useraccounts->patchEntity($entity,$this->request->data);
			if ($this->Useraccounts->save($entity)) {
				$this->redirect(["controller" => "Useraccounts","action" => "updateComplete"]);
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
			$entity = $this->Useraccounts->get($id);
			if ($this->Useraccounts->delete($entity)) {
			     unlink('/var/www/html/img/'.$entity->image_name);
			}
		} catch(Exception $e) {
			Log::write("debug",$e->getMessage());
		}

	}

	public function logout() {
	   $this->request->session()->destroy();
	   return $this->redirect(["controller" => "Webaccounts","action" => "index"]);
	}

	public function getImage() {
	    $this->autoRender = false;
	    if (!$this->request->session()->read('web_id')) {
	        $this->request->session()->destroy();
	        $this->redirect(["controller" => "Webaccounts","action" => "index"]);
	    }

        $webaccount = $this->Webaccounts->find("all",[
            "conditions" => [
                "id" => $this->request->session()->read("web_id")
            ]
        ]);
        $webaccount = $webaccount->toArray();

        try {
            $entity = $this->Webaccounts->get($this->request->session()->read("web_id"));
            $entity->latitude = $this->request->data["y"];
            $entity->longitude = $this->request->data["x"];
            $entity->modified_date = time();
        } catch (Exception $e) {
            Log::write("debug",$e->getMessage());
        }

        //DBの位置情報更新
        $this->Webaccounts->save($entity);

        $data = array($webaccount[0]["image_name"]);
        echo json_encode($data);

	}
}
?>