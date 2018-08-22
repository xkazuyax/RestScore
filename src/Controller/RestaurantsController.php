<?php
namespace App\Controller;

use \Exception;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;

class RestaurantsController extends AppController {
    public $webaccounts;

	public function initialize() {
		$this->autoRender = true;
		$this->viewBuilder()->Layout('restaurants');
		$this->webaccounts = TableRegistry::get('webaccounts');
	}

	public function restList() {
		if (!$this->request->session()->read('web_id')) {
			$this->request->session()->destroy();
			return $this->redirect(["controller" => "Webaccounts","action" => "index"]);
		}

		$restaurants = $this->Restaurants->find("all")->contain(['Webaccounts']);
		$this->set("restaurants",$restaurants);
	}

	public function add() {
	    if (!$this->request->session()->read('web_id')) {
	           $this->request->session()->destroy();
	           return $this->redirect(["controller" => "Restaurants","action" => "index"]);
	    }
	    $webaccounts = $this->webaccounts->find("all");
	    $this->set("webaccounts",$webaccounts);
	    $this->set("entity",$this->Restaurants->newEntity());
	}

	public function addCheck() {
	    if (!$this->request->session()->read("web_id")) {
	       $this->request->session()->destroy();
	       return $this->redirect(["controller" => "webaccounts","action" => "index"]);
	    }

	    if ($this->request->is("post")) {
	       $entity = $this->Restaurants->newEntity($this->request->data);
           $appear_image = $entity->appearance_image;
           $menu_image = $entity->menu;
           //外観の画像が正しくアップロードされているか
           if ($appear_image["size"] > 0 &&  $appear_image["tmp_name"]) {
                //メニューの画像が正しくアップロードされているか
               if ($menu_image["size"] > 0 && $menu_image["tmp_name"]) {
                    //画像を保存
                    $appear_image_path = "/var/www/html/img/".$appear_image["name"];
                    $menu_image_path = "/var/www/html/img/".$menu_image["name"];
                    if (move_uploaded_file($appear_image["tmp_name"],$appear_image_path) && move_uploaded_file($menu_image["tmp_name"],$menu_image_path)) {
                        $entity->appear_image = $appear_image["name"];
                        $entity->menu_image = $menu_image["name"];
                        $entity->create_date = time();
                        $entity->modified_date = time();
                        if ($this->Restaurants->save($entity)) {
                            return $this->redirect(["controller" => "Restaurants" , "action" => "addComplete"]);
                        }
                    }
               }
           }
	    } else {
	       $entity = $this->Restaurants->newEntity();
	    }
	    $this->set("entity",$entity);
	}

	public function addComplete() {
	    if (!$this->request->session()->read("web_id")) {
	       $this->request->session()->destroy();
	       return $this->redirect(["controller" => "Webaccounts","action" => "index"]);
	    }
	}

	public function detail($id = null){
	    if (!$this->request->session()->read('web_id') || $id == null) {
	        $this->request->session()->destroy();
	        return $this->redirect(["controller" => "Webaccounts","action" => "index"]);
	    }

	    $restaurant = $this->Restaurants->find("all",[
	        "conditions" => [
	            "Restaurants.id" => $id
	        ]
	    ])->contain(["Webaccounts"]);
        $this->set("id",$id);
	    $this->set("restaurant",$restaurant);
	}

	public function update($id = null) {
	    if (!$this->request->session()->read('web_id') || $id == null) {
	       $this->request->session()->destroy();
	       return $this->redirect(["controller" => "Webaccounts","action" => "index"]);
	    }

	    try {
	        $entity = $this->Restaurants->get($id);
	    } catch(Excepton $e) {
	       Log::write("debug",$e->getMessage());
	    }
	    $webaccounts = $this->webaccounts->find("all");

	    $this->set("entity",$entity);
	    $this->set("webaccounts",$webaccounts);
	    $this->set("id",$id);
	}

	public function updateCheck() {
	    if (!$this->request->session()->read("web_id")) {
	       $this->request->session()->destroy();
	       return $this->redirect(["controller" => "Webaccounts","action" => "index"]);
	    }

	    if ($this->request->is("put")) {
	       $new_entity = $this->Restaurants->newEntity($this->request->data);
	       try {
	           $entity = $this->Restaurants->get($this->request->data['id']);
	       } catch(Exception $e) {
	           Log:write("debug",$e->getMessage());
	       }
	       $appearance_image = $_FILES["appearance_image"];
	       $menu = $_FILES["menu"];

	       //外観のアップロードファイルがある場合のみEntityに代入
	       if ($appearance_image) {
	           //登録中のファイルと同じ場合はアップロードなし
	           if ($appearance_image["name"] != $entity->appear_image) {
	               if ($appearance_image["size"] > 0 && $appearance_image["tmp_name"]) {
	                   //ファイルを保存
	                   $appearance_image_path = "/var/www/html/img/".$appearance_image["name"];
	                   if (move_uploaded_file($appearance_image["tmp_name"],$appearance_image_path)) {
	                       unlink('/var/www/html/img/'.$entity->appear_image);
	                       $entity->appear_image = $new_entity->appearance_image;
	                   }
	               }
	           }
	       }

	       //メニューのアップロードファイルがある場合のみEntityに代入
	       if ($menu) {
	           //登録中のメニューと同じ場合はアップロードなし
	           if ($menu["name"] != $entity->menu_image) {
	               if ($menu["size"] > 0 && $menu["tmp_name"]) {
	                   //ファイルを保存
	                   $menu_image_path = '/var/www/html/img/'.$menu["name"];
	                   if (move_uploaded_file($menu["tmp_name"],$menu_image_path)) {
	                       unlink("/var/www/html/img/".$entity->menu_image);
	                       $entity->menu_image = $new_entity->menu;
	                   }
	               }
	           }
	       }

	       $entity->modified_date = time();

	       $this->Restaurants->patchEntity($entity,$this->request->data);
	       if ($this->Restaurants->save($entity)) {
	           return $this->redirect(["controller" => "Restaurants","action" => "updateComplete"]);
	       }
	    } else {
	        $new_entity = $this->Restaurants->newEntity();
	    }
	    $this->set("entity",$new_entity);
	    $this->set("id",$this->request->data['id']);
	}

	public function updateComplete() {
	    if (!$this->request->session()->read("web_id")) {
	       $this->request->session()->destroy();
	       return $this->redirect(["controller" => "Webaccounts","action" => "index"]);
	    }
	}

	public function delete($id = null) {
	    if (!$this->request->session()->read("web_id")) {
	        $this->request->session()->destroy();
	        return $this->redirect(["controller" => "Webaccounts","action" => "index"]);
	    }

	    try {
	        $entity = $this->Restaurants->get($id);
	        if ($this->Restaurants->delete($entity)) {
	           unlink('/var/www/html/img/'.$entity->appear_image);
	           unlink('/var/www/html/img/'.$entity->menu_image);
	        }
	    } catch(Exception $e) {
	        Log::write("debug",$e->getMessage());
	    }

	}
}
