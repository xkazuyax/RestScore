<div class="card m-5">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-12">
				<h4>Webアカウント新規追加</h4>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12">
				<?=$this->Form->create($entity,["url" => ["controller" => "Webaccounts","action" => "updateCheck"],"enctype" => "multipart/form-data"]);?>
				<input type="hidden" name="id" value="<?=$id;?>">
				<div class="form-group">
					<label for="login_id">ログインID</label>
					<input type="text" name="login_id" value="<?=h($entity->login_id);?>" id="login_id" class="form-control form-control-lg" placeholder="半角英数20文字以内で入力してください" required>
				</div>
				<div class="form-group">
					<label for="pass">パスワード</label>
					<input type="password" name="pass" id="pass" class="form-control form-control-lg" placeholder="半角英数20文字以内で入力してください">
				</div>
				<div class="form-group">
					<label for="pass2">パスワード再確認</label>
					<input type="password" name="pass2" id="pass2" class="form-control form-control-lg" placeholder="上記と同じ値を入力してください">
				</div>
				<div class="form-group">
					<label for="name">アカウント名</label>
					<input type="text" name="name" value="<?=h($entity->name);?>" id="name" class="form-control form-control-lg" placeholder="20文字以内で入力してください" required>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
					<label>アカウント種別</label>
					<?php
						$type = $entity->type
					?>
						<select name="type" class="form-control">
							<option value="0" <? if($type == 0){ echo 'selected'; }?>管理アカウント</option>
							<option value="1" <? if($type == 1){ echo 'selected'; }?>一般ユーザー</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="latitude">緯度</label>
					<input type="text" name="latitude" value="<?=h($entity->latitude);?>" id="latitude" class="form-control form-control-lg" placeholder="20～45の間で入力してください" required>
				</div>
				<div class="form-group">
					<label for="longitude">経度</label>
					<input type="text" name="longitude" value="<?=h($entity->longitude);?>" id="longitude" class="form-control form-control-lg" placeholder="120～140の間で入力してください" requred>
				</div>
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