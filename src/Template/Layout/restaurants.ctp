<!DOCTYPE html>
<html lang="ja">
<head>
<?=$this->Html->charset("utf8");?>
<?=$this->Html->css('bootstrap.min.css');?>
<?=$this->Html->script("jquery-3.3.1.min.js");?>
<?=$this->Html->script("popper.min.js");?>
<?=$this->Html->script("bootstrap.min.js");?>
<meta charset="utf8">
<title>グルメ評価アプリ</title>
</head>
<body>
<style>
body{
	background-image : url("http://160.16.233.165/img/student_life.jpg");
}
</style>
<div class="container-fluid">
<div class="row p-5" style="background-image: url('http://160.16.233.165/img/sky.jpg');">
<div class="col-sm-12">
<div class="card">
<h2 class="text-center text-light bg-dark m-0">グルメ評価アプリ</h2>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-2 p-0">
<div class="list-group">
<a href="<?=$this->Url->build('/Maps/index');?>" class="p-5 list-group-item list-group-item-action bg-dark text-light">マップ</a>
<a href="<?=$this->Url->build('/Webaccounts/webList');?>" class="p-5 list-group-item list-group-item-action bg-dark text-light">Webアカウント管理</a>
<a href="<?=$this->Url->build('/Useraccounts/userList');?>" class="p-5 list-group-item list-group-item-action bg-dark text-light">ユーザーアカウント管理</a>
<a href="<?=$this->Url->build('/Restaurants/restList');?>" class="p-5 list-group-item list-group-item-action bg-dark text-light">グルメ評価</a>
<a href="<?=$this->Url->build('/boards/boardList');?>" class="p-5 list-group-item list-group-item-action bg-dark text-light">掲示板</a>
<a href="<?=$this->Url->build('/Webaccounts/logout');?>" class="p-5 list-group-item list-group-item-action bg-dark text-light">ログアウト</a>
</div>
</div>
<div class="col-sm-10">
<?=$this->fetch("content");?>
</div>
</div>
</div>
<footer class="footer">
<div class="container-fluid fixed-bottom  p-4" style="background-image: url('http://160.16.233.165/img/leaf.jpg');">
</div>
</footer>
</body>
</html>