<div class="left_menu">
<ul>
<li><?=$this->html->link("監視者情報",["controller" => "Webaccounts","action" => "index"])?></li>
<li><?=$this->Html->link("スマホユーザー",["controller" =>"Useraccounts","action" => "index"])?> </li>
<li><?=$this->Html->link("アルバム",["controller" => "Albums","action" => "index"])?></li>
<li><?=$this->Html->link("チャット",["controller" => "Message","action" => "index"])?></li>
<li><?=$this->Html->link("ログアウト",["controller" => "Webaccounts","action" =. "logout"])?></li>
</ul>
</div>
