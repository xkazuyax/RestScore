<!DOCTYPE html>
<html lang="ja">
<head>
<?=$this->Html->charset('utf-8');?>
<?=$this->Html->css('bootstrap.min.css');?>
<?=$this->Html->script('jquery-3.3.1.min.js');?>
<?=$this->Html->script('popper.min.js');?>
<?=$this->Html->script('bootstrap.min.js');?>
<title>飲食店評価アプリ</title>
</head>
<body>
<div class="container">
<div class="row mt-5">
<div class="col-sm-12">
<h2 class="text-center">飲食店評価アプリ</h2>
</div>
</div>
<div class="row mt-5">
<div class="col-sm-12">
<?=$this->Form->create($entity,["url" => ["controller" => "Webaccounts","action" => "loginCheck"]]);?>
<div class="form-group">
<label for="login_id">ID</label>
<input type="text" name="login_id" id="login_id" class="form-control form-control-lg" placeholder="IDを入力してください" required>
</div>
<div class="form-group">
<label for="pass">Password</label>
<input type="password" name="pass" id="pass" class="form-control form-control-lg" placeholder="passwordを入力してください" required>
</div>
<div class="form-group mt-5">
<input type="submit" class="btn btn-primary btn-lg" value="ログイン">
</div>
</div>
</div>
</div>
</body>
</html>