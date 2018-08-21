<div class="card m-5">
	<div class="card-header">
		<div class="row">
			<div class="col-sm-8">
				<h4 class="text-center">Webアカウント詳細画面</h4>
			</div>
			<div class="col-sm-2">
				<a class="btn btn-info" href="<?=$this->Url->build('/Webaccounts/update/'.$id);?>">編集</a>
			</div>
			<div class="col-sm-2">
				<button class="btn btn-danger" onClick="del()">削除</button>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
		<table class="table table-bordered">
			<?php
			$webaccount = $webaccount_data->toArray();
			?>
			<tr>
				<th scope="col" class="text-center">名前</th>
				<td scope="row" class="text-center"><?=h($webaccount[0]['name']);?></td>
			</tr>
			<tr>
				<td scope="row" colspan="2"><img src="http://160.16.233.165/img/<?=$webaccount[0]['image_name'];?>" alt="顔写真" width="500" height="500"></td>
			</tr>
			<tr>
				<th scope="col" class="text-center">アカウント種別</th>
				<td scope="row" class="text-center">
					<?php
						switch($webaccount[0]["type"]) {
							case 0:
								echo ("管理者アカウント");
								break;

							case 1:
								echo ("一般ユーザーアカウント");
								break;
						}
					?>
				</td>
			</tr>
			<tr>
				<th scope="col" class="text-center">緯度</th>
				<td scope="row" class="text-center"><?=$webaccount[0]["latitude"];?></td>
			</tr>
			<tr>
				<th scope="col" class="text-center">経度</th>
				<td scope="row" class="text-center"><?=$webaccount[0]["longitude"];?></td>
			</tr>
			<tr>
				<th scope="col" class="text-center">登録日</th>
				<td scope="row" class="text-center"><?=$webaccount[0]["create_date"];?></td>
			</tr>
			<tr>
				<th scope="col" class="text-center">更新日</th>
				<td scope="row" class="text-center"><?=$webaccount[0]["modified_date"];?></td>
			</tr>
		</table>
		</div>
		</div>
		<div class="row">
		<div class="col-sm-12">
			<div class="modal fade" id="delete">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title text-center">Webアカウント削除確認</h4>
						</div>
						<div class="modal-body">
							<p class="text-center">「アカウント名:<?=h($webaccount[0]['name']);?>」</p>
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
<script>
		function del() {
			$("#delete").modal();
		}

		function doOK() {
			window.location.href="<?=$this->Url->build('/Webaccounts/delete/'.$id);?>";
		}
 	</script>