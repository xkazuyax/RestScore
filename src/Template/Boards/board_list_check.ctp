<div class="card m-5">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="text-center">掲示板投稿</h4>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-12">
					<p class="text-center">メッセージ書き込み</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<?=$this->Form->create($entity,["url" => ["controller" => "boards","action" => "boardListCheck"]])?>
					<textarea name="comment" id="comment" class="form-control" rows="8" rows="30" placeholder="コメントを200文字以内で入力してください" required></textarea>
				</div>
				<div class="error text-danger"><?=$this->Form->error("comment")?></div>
			</div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div class="form-group">
						<button type="submit" class="btn btn-info form-control btn-block m-3" >送信</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card m-5">
	<?php
	   $board_datas = $boards->toArray();
	   foreach($board_datas as $board_data) {
	?>
	<div class="card border-success m-2">
		<div class="row m-1">
			<div class="col-sm-3">
				<figure class="figire float-right">
					<img src="http://160.16.233.165/img/<?=$board_data['Webaccounts']['image_name']?>" class="figure-img img-fluid rounded-circle" alt="顔写真" style="width:200px;height:200px">
					<figcaption class="figure-caption ">アカウント名：<?=h($board_data["Webaccounts"]['name'])?></figcaption>
				</figure>
			</div>
			<div class="col-sm-9">
				<div class="card border-info text-info m-1">
					<div class="card-header">
						<p class="text-success"><?=$board_data->create_date?></p>
					</div>
					<div class="card-body">
						<p><?=h($board_data->comment)?></p>
					</div>
				</div>
				<div class="col-sm-6">
					<button class="btn btn-danger btn-block mt-3" type="button" onClick="del()">削除</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	   }
	?>
</div>