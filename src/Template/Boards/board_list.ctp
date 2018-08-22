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
					<button class="btn btn-danger btn-block mt-3" type="button"  data-whatever="<?=$board_data->id?>" data-toggle="modal" data-target="#delete">削除</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	   }
	?>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="modal fade" id="delete">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title text-center">コメント削除確認</h4>
					</div>
					<div class="modal-body">
						<p class="text-center">コメントを削除してもよろしいですか</p>
						<input type="hidden" name="num" id="num" value="">
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
<script>
	$(function() {
		$('#delete').on('show.bs.modal',function(event){
			var recipient = $(event.relatedTarget).data('whatever');
			$('#num').val(recipient);
		});
	});

		function doOK() {
			var id = $('#num').val();
			window.location.href="<?=$this->Url->build('/Boards/delete/');?>"+id;
			exit();
		}
 	</script>