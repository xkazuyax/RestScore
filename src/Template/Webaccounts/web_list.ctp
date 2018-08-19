<div class="card mt-5">
<div class="card-header">
<div class="row">

<div class="col-sm-9">
<h3 class=text-center>Webアカウント一覧</h3>
</div>
<div class="col-sm-3">
	<a class="btn btn-info" href="<?=$this->Url->build('/Webaccounts/detail');?>">新規追加</a>
</div>
</div>
</div>
<div class="card-body">
<?php
	$webaccounts = $webaccount_datas->toArray();
	foreach($webaccounts as $webaccount) {
?>
	<div class="col-sm-3">
		<table class="table">
			<tr">
				<td scope="row" class="text-center"><a href="<?=$this->Url->build("/webaccounts/detail".$webaccount->id);?>"><?=h($webaccount->name);?></a></td>
			</tr>
			<tr>
				<td scope="row"><img src="http://160.16.233.165/img/<?=$webaccount->image_path;?>" alt="顔写真" width="200" height="200"></td>
			</tr>
			<tr>
				<td scope="row" class="text-center">
					<?php
						switch($webaccount->type) {
							case 0:
								echo h("管理者アカウント");
								break;

							case 1:
								echo h("一般ユーザーアカウント");
								break;
						}
					?>
				</td>
			</tr>
		</table>
	</div>
<?php
	}
?>
</div>
</div>