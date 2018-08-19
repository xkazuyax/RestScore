<!DOCTYPE html>
<html lang="ja">
<head>
<?=$this->Html->charset("utf-8");?>
<?=$this->Html->css('bootstrap.min.css');?>
<?=$this->Html->script("jquery-3.3.1.min.js");?>
<?=$this->Html->script("popper.min.js");?>
<?=$this->Html->script("bootstrap.min.js");?>
<title>飲食店評価アプリ</title>
</head>
<body>
<div class="container-fluid">
<?=$this->fetch("content");?>
</div>
</body>
</html>