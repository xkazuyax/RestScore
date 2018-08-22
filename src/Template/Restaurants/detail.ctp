<div class="card m-5">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-8">
				<h4 class="text-center">飲食店詳細</h4>
			</div>
			<div class="col-sm-2">
				<a href="<?=$this->Url->build('/Restaurants/update/'.$id)?>" class="btn btn-info">編集</a>
			</div>
			<div class="col-sm-2">
				<button class="btn btn-info" type="button" onClick="del()">削除</button>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<table class="table">
					<?php
					$restaurant_datas = $restaurant->toArray();
					foreach($restaurant_datas as $restaurant_data) {
					?>
						<tr>
							<th class="col">店名</th>
							<td class="row"><?=h($restaurant_data->rest_name)?></td>
						</tr>
						<tr>
							<td colspan="2"><img src="http://160.16.233.165/img/<?=$restaurant_data->appear_image?>" alt="外観画像" width="400" height="400"></td>
						</tr>
						<tr>
							<th class="col">分類</th>
							<td class="row">
								<?php
									switch($restaurant_data->type) {
										case 0:
											echo "　和食";
											break;
										case 1:
											echo "　洋食";
											break;
										case 2:
											echo "　カレー";
											break;
										case 3:
											echo "　ラーメン";
											break;
										case 4:
											echo "　ファーストフード";
											break;
										case 5:
											echo "　居酒屋";
											break;
										case 6:
											echo "　カフェ";
											break;
										case 7:
											echo "　バー";
											break;
									}
									?>
							</td>
						</tr>
						<tr>
							<th scope="col">場所</th>
							<td scope="row"><?=h($restaurant_data->place)?></td>
						</tr>
						<tr>
							<th class="col">営業時間</th>
							<td scope="row"><?=h($restaurant_data->oc_time)?></td>
						</tr>
						<tr>
							<th scope="col">評価</th>
							<td scope="row">
							<?php
								for ($i=1;$i<=$restaurant_data->score;$i++) {
								?>
									<img src="http://160.16.233.165/img/star.jpg" alt="★" width="30" height="30">
								<?php
								}
								?>
							</td>
						</tr>
						<tr>
							<th colspan="2">メニュー写真</th>
						</tr>
						<tr>

							<td><button class="button" type="button"><img src="http://160.16.233.165/img/button_previous.jpg" alt="前へボタン" width="70" height="70"></button></td>


							<td><img src="http://160.16.233.165/img/<?=$restaurant_data->menu_image?>" alt="メニュー画像" width="300" height="200"></td>

							<td><button class="button" type="button"><img src="http://160.16.233.165/img/button_next.jpg" alt="次へボタン" width="70" height="70"></button></td>

						</tr>
						<tr>
							<th scope="col">登録日</th>
							<td scope="row"><?=$restaurant_data->create_date?></td>
						</tr>
						<tr>
							<th scope="col">更新日</th>
							<td scope="row"><?=$restaurant_data->modified_date?></td>
						</tr>
					<?php
					}
					?>
				</table>
			</div>
			<div class="col-sm-3"></div>
			<div class="row">
		<div class="col-sm-12">
			<div class="modal fade" id="delete">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title text-center">飲食店削除確認</h4>
						</div>
						<div class="modal-body">
							<p class="text-center">「店名:<?=h($restaurant_datas[0]['rest_name']);?>」</p>
						</div>
						<div class="modal-footer">
							<button class="btn btn-info  float-left mr-5" type="button" data-dismiss="modal" onClick="doOK()">削除</button>
							<button class="btn btn-info  ml-5" type="button" data-dismiss="modal">キャンセル</</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		</div>
	</div>
</div>
<script>
		function del() {
			$("#delete").modal();
		}

		function doOK() {
			window.location.href="<?=$this->Url->build('/Restaurants/delete/'.$id);?>";
		}
 	</script>