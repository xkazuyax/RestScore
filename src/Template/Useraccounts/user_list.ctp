<div class="card mt-5 mb-5">
<div class="card-header">
<div class="row">

<div class="col-sm-9">
<h3 class=text-center>ユーザーアカウント一覧</h3>
</div>
<div class="col-sm-3">
	<a class="btn btn-info" href="<?=$this->Url->build('/Useraccounts/add');?>">新規追加</a>
</div>
</div>
</div>
<div class="card-body">
<div class="row">
<?php
	$useraccounts = $useraccount_datas->toArray();
	foreach($useraccounts as $useraccount) {
?>
	<div class="col-sm-3 m-2">
		<table class="table table-bordered">
			<tr>
				<td scope="row" class="text-center"><a href="<?=$this->Url->build("/useraccounts/detail/".$useraccount->id);?>"><?=h($useraccount->name);?></a></td>
			</tr>
			<tr>
				<td scope="row"><img src="http://160.16.233.165/img/<?=$useraccount->image_name;?>" alt="顔写真" width="300" height="300"></td>
			</tr>
		</table>
	</div>
<?php
	}
?>
</div>
</div>
</div>