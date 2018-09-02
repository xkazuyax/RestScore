<div class="card m-5">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-12">
				<h4>ユーザーアカウント新規追加</h4>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12">
				<?=$this->Form->create($entity,["url" => ["controller" => "Useraccounts","action" => "updateCheck"],"enctype" => "multipart/form-data"]);?>
				<input type="hidden" name="id" value="<?=$id;?>">
				<div class="form-group">
					<label for="login_id">ログインID</label>
					<input type="text" name="login_id" value="<?=h($entity->login_id);?>" id="login_id" class="form-control form-control-lg" placeholder="半角英数20文字以内で入力してください" required>
				</div>
				<div class="error text-danger"><?=$this->Form->error("login_id");?></div>
				<div class="form-group">
					<label for="pass">パスワード</label>
					<input type="password" name="pass" id="pass" class="form-control form-control-lg" placeholder="半角英数20文字以内で入力してください">
				</div>
				<div class="error text-danger"><?=$this->Form->error("pass");?></div>
				<div class="form-group">
					<label for="pass2">パスワード再確認</label>
					<input type="password" name="pass2" id="pass2" class="form-control form-control-lg" placeholder="上記と同じ値を入力してください">
				</div>
				<div class="error text-danger"><?=$this->Form->error("pass2");?></div>
				<div class="error text-danger"><?=$this->Form->error("pass2");?></div>
				<?php if($error != "") {?>
					<p class="text-danger">パスワードが一致しません</p>
				<?php }?>
				<div class="form-group">
					<label for="name">アカウント名</label>
					<input type="text" name="name" value="<?=h($entity->name);?>" id="name" class="form-control form-control-lg" placeholder="20文字以内で入力してください" required>
				</div>
				<div class="error text-danger"><?=$this->Form->error("name");?></div>
				<div class="form-group">
					<label for="latitude">緯度</label>
					<input type="text" name="latitude" value="<?=h($entity->latitude);?>" id="latitude" class="form-control form-control-lg" placeholder="20～45の間で入力してください" required>
				</div>
				<div class="error text-danger"><?=$this->Form->error("latitude");?></div>
				<div class="form-group">
					<label for="longitude">経度</label>
					<input type="text" name="longitude" value="<?=h($entity->longitude);?>" id="longitude" class="form-control form-control-lg" placeholder="120～140の間で入力してください" requred>
				</div>
				<div class="error text-danger"><?=$this->Form->error("longitude");?></div>
				<div class="form-group">
					<label for="face">顔写真アップロード</label>
					<input type="file" name="image_path" id="face" class="form-control form-control-lg">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-lg btn-primary" name="send">追加</button>
				</div>
			</div>
		</div>
	</div>
</div>