<div class="card m-5">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="center-text">飲食店更新</h4>
			</div>
		</div>
	</div>
	<div class="card-body">
			<div class="row">
			<div class="col-sm-12">
				<?=$this->Form->create($entity,["url" => ["controller" => "restaurants","action" => "updateComplete"],"enctype" => "multipart/form-data"]);?>
				<input type="hidden" name="id" value="<?=$id?>">
				<div class="form-group">
					<label for="rest_name">店名</label>
					<input type="text" name="rest_name" id="rest_name" class="form-control form-control-lg" placeholder="20文字以内で入力してください" value="<?=h($entity->rest_name)?>"required>
				</div>
				<div class="error text-danger"><?=$this->Form->error("rest_name")?></div>
				<div class="form-group">
					<label for="appearance_image">外観画像</label>
					<input type="file" name="appearance_image" id="appearance_image" class="form-control form-control-lg">
				</div>
				<?php
				$type=$entity->type;
				?>
				<div class="form-group">
					<div class="col-sm-4">
					<label for="type">種別</label>
					<select name="type" class="form-control">
						<option value="0" <?php if($type == 0) {?> selected <?php }?>>和食</option>
						<option value="1" <?php if($type == 1) {?> selected <?php }?>>洋食</option>
						<option value="2" <?php if($type == 2) {?> selected <?php }?>>カレー</option>
						<option value="3" <?php if($type == 3) {?> selected <?php }?>>ラーメン</option>
						<option value="4" <?php if($type == 4) {?> selected <?php }?>>ファーストフード</option>
						<option value="5" <?php if($type == 5) {?> selected <?php }?>>居酒屋</option>
						<option value="6" <?php if($type == 6) {?> selected <?php }?>>カフェ</option>
						<option value="7" <?php if($type == 7) {?> selected <?php }?>>バー</option>
					</select>
					</div>
				</div>
				<div class="form-group">
					<label for="menu">メニュー画像</label>
					<input type="file" name="menu" id="menu" class="form-control form-control-lg" placeholder="アップロードするファイルを選択してください">
				</div>
				<div class="form-group">
					<label for="place">場所</label>
					<input type="text" name="place" id="place" class="form-control form-control-lg" placeholder="20文字以内で入力してください" value="<?=h($entity->place)?>" required>
				</div>
				<div class="error text-danger"><?=$this->Form->error("place")?></div>
				<div class="form-group">
					<label for="latitude">緯度</label>
					<input type="text" name="latitude" id="latitude" class="form-control form-control-lg" placeholder="数値で入力してください" value="<?=$entity->latitude?>" required>
				</div>
				<div class="error text-danger"><?=$this->Form->error("latitude")?></div>
				<div class="form-group">
					<label for="longitude">経度</label>
					<input type="text" name="longitude" id="longitude" class="form-control form-control-lg" placeholder="数値で入力してください" value="<?=$entity->longitude?>" required>
				</div>
				<div class="error text-danger"><<?=$this->Form->error("longitide")?></div>
				<div class="form-group">
					<label for="oc_time">営業時間</label>
					<input type="text" id="oc_time" name="oc_time" class="form-control form-control-lg" placeholder="例)9:00～19:00" value="<?=h($entity->oc_time)?>" required>
				</div>
				<div class="error text-danger"><?=$this->Form->error("oc_time")?></div>
				<div class="form-group">
					<label for="score">評価</label><br>
					<label for="score"><input type="radio" name="score" id="score" value="1" <?php if($entity->score == "1") {?> checked <?php } ?> required> <img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"></label><br>
					<label for="score"><input type="radio" name="score" id="score"  value="2" <?php if($entity->score == "2") {?> checked <?php } ?> required> <img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"><img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"></label><br>
					<label for="score"><input type="radio" name="score" id="score"  value="3" <?php if($entity->score == "3") {?> checked <?php } ?> required> <img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"><img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"><img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"></label><br>
					<label for="score"><input type="radio" name="score" id="score"  value="4" <?php if($entity->score == "4") {?> checked <?php } ?> required> <img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"><img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"><img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"><img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"></label><br>
					<label for="score"><input type="radio" name="score" id="score"  value="5" <?php if($entity->score == "5") {?> checked <?php } ?> required> <img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"><img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"><img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"><img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"><img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30"></label><br>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
					<label for="webaccount_id">訪問者</label>
					<select name="webaccount_id" class="form-control">
					<?php
					$webaccount_datas = $webaccounts->toArray();
					foreach($webaccount_datas as $num => $webaccount_data) {
					?>
						<option value="<?=$webaccount_data->id?>" <?php if($entity->webaccounts_id == 0) {?> selected <?php } ?>><?=h($webaccount_data->name)?></option>
					<?php
					}
					?>
					</select>
					</div>
				</div>
				<div class="form-group">
					<button class="btn btn-info" type="submit" name="submit">追加</button>
				</div>
			</div>
		</div>
	</div>
</div>