<?php
namespace App\Controller;

class BoardsController extends AppController {
    public function initialize() {
        $this->autoRender = true;
        $this->viewBuilder()->Layout("boards");
    }

    public function boardList() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            return $this->redirect(["controller" => "webaccounts","action" => "index"]);
        }
        $boards = $this->Boards->find("all")->contain(["webaccounts"]);
        $this->set("entity",$this->Boards->newEntity());
        $this->set("boards",$boards);
    }

    public function boardListCheck() {
        if (!$this->request->session()->read("web_id")) {
            $this->request->session()->destroy();
            return $this->redirect(["controller" => "webaacounts","action" => "index"]);
        }

        $boards = $this->Boards->find("all")->contain(["Webaccounts"]);
        if ($this->request->isPost()) {
            $entity = $this->Boards->newEntity($this->request->data);
            $entity->create_date = time();
            $entity->webaccount_id = $this->request->session()->read("web_id");
            if ($this->Boards->save($entity)) {
                return $this->redirect(["controller" => "Boards","action" => "boardList"]);
            }
        } else {
            $entity = $this->Boards->newEntity();
        }
        $this->set("entity",$entity);
        $this->set("boards",$boards);
    }

    public function delete($id = null) {
        if (!$this->request->session()->read("web_id") || id == null) {
            $this->request->session()->destroy();
            return $this->redirect(["controller" => "Webaccounts","action" => "index"]);
        }

        try {
            $entity = $this->Boards->get($id);
            $this->Boards->delete($entity);
            return $this->redirect(["controller" => "Boards","action" => "boardList"]);
        } catch(Exception $e) {
            Log::write("debug",$e->getMessage());
        }
    }
}
?>