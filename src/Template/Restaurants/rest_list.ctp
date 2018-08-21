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
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php
							$restaurant_datas = $restaurants->toArray();
							foreach($restaurant_datas as $restaurant) {
							?>
								<td scope="row"><?=h($restaurant_data->rest_name);?></td>
								<td scope="row"><img src="http://160.16.233.165/img/<?=$restaurant_data->appear_image;?>" alt="外観"></td>
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
								<td scope="row"><?=h($restaurant_data->name);?></td>
							<?php
							}
							?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>