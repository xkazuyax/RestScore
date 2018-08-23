<!DOCTYPE html>
<html>
<head>
<title>飲食店評価アプリ</title>
<meta charset="UTF-8">
<?=$this->Html->script('OpenLayers.js')?>
<?=$this->Html->script('map.js')?>
<?=$this->Html->script('jquery-3.3.1.min.js');?>
</head>
<body>
<div id="map" style="height:1000px;width:100%;"></div>
<script>
  // マップの生成(経度、緯度、倍率、最大倍率)
init_map();
</script>
</body>
</html>