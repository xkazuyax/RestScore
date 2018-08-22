<div class="card m-5">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-8">
				<h4 class="text-center">飲食店一覧</h4>
			</div>
			<div class="col-sm-4">
				<a class="btn btn-info" href="<?=$this->Url->build('/Restaurants/add');?>">新規追加</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row m-5">
			<div class="col-sm-12">
				<table class="table">
					<thead class="thread-dark">
						<tr>
							<th scope="col">店名</th>
							<th scope="col">外観</th>
							<th scope="col">分類</th>
							<th scope="col">場所</th>
							<th scope="col">訪問者</th>
							<th scope="col">スコア</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$restaurant_datas = $restaurants->toArray();
						foreach($restaurant_datas as $restaurant_data) {
						?>
							<tr>
								<td scope="row"><a href="<?=$this->Url->build('/Restaurants/detail/'.$restaurant_data->id)?>"><?=h($restaurant_data->rest_name)?></a></td>
								<td scope="row"><img src="http://160.16.233.165/img/<?=$restaurant_data->appear_image;?>" alt="外観" width="100" height="100"></td>
								<td scope="row">
									<?php
									switch($restaurant_data->type) {
										case 0:
											echo "和食";
											break;
										case 1:
											echo "洋食";
											break;
										case 2:
											echo "カレー";
											break;
										case 3:
											echo "ラーメン";
											break;
										case 4:
											echo "ファーストフード";
											break;
										case 5:
											echo "居酒屋";
											break;
										case 6:
											echo "カフェ";
											break;
										case 7:
											echo "バー";
											break;
									}
									?>
								</td>
								<td scope="row"><?=h($restaurant_data->place);?></td>
								<td scope="row"><?=h($restaurant_data["webaccount"]["name"]);?></td>
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
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>