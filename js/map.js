 // 座標系の設定

  var fx = null;
  var fy = null;
  var izoom = null;
  var maxZoomLevel = null;
  var projection3857 = new OpenLayers.Projection("EPSG:3857");
  var projection4326 = new OpenLayers.Projection("EPSG:4326");

  var map = null;
  var popup = null;


  // -------------------------------------------------------------------------
  //  マップの生成
  //
  //  fx             経度(例：富士山 138.731388) ※1
  //  fy             緯度(例：富士山 35.362222)
  //  izoom          表示倍率(用途にもよりますが10ぐらいが目安)
  //  imaxZoomLevel  最大倍率(用途にもよりますが17ぐらいが目安)
  //
  //   ※1 googleマップや地理院地図の検索では「緯度,経度」の順番です。
  function init_map(){
    fx = 139.767052;
    fy = 35.681167;
    izoom = 7;
    imaxZoomLevel = 18;

    // マップの生成
    map = new OpenLayers.Map({
      div: "map",
      projection: projection3857,
      displayProjection: projection4326,
    });

    // レイヤーの生成
    map.addLayer(new OpenLayers.Layer.XYZ(
         "標準地図",  // レイヤー名
         "https://cyberjapandata.gsi.go.jp/xyz/std/${z}/${x}/${y}.png", // url
          {
            // options(attribution:帰属,,minZoomLevel:最小倍率(未使用),maxZoomLevel:最大倍率)
            attribution  : "国土地理院",
            maxZoomLevel : imaxZoomLevel,
            wrapDateLine : true
          }
          ));

    // マップの中心を設定
    map.setCenter(new OpenLayers.LonLat(
                        fx, // X:経度
                        fy  // Y:緯度
                      ).transform(projection4326, projection3857),// 座標系
                      izoom // デフォルトズームレベル
                      );

 // パンズームバーの表示(パン：十字キー ズームバー：拡大縮小)
    map.addControl(new OpenLayers.Control.PanZoomBar());


    //位置取得
    setInterval(function() {
        navigator.geolocation.getCurrentPosition(successCallback,errorCallback);
    },10000);

    //スマホユーザーの現在地取得
    function successCallback(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        var accuracy = position.coords.accuracy;

      //スマホマーカーの生成
        var markers = new OpenLayers.Layer.Markers("Markers");
        map.addLayer(markers);

        //アイコンサイズと描画位置
        var iconsize = new OpenLayers.Size(48,48);
        var point = new OpenLayers.Pixel(-(iconsize.w/2),-(iconsize.h/2));


      //マーカーの追加
        var x = longitude;
        var y = latitude;

        console.log("緯度:"+latitude);
        console.log("経度:" + longitude);

        var marker = new OpenLayers.Marker(
            new OpenLayers.LonLat(x,y).transform(projection4326,projection3857),
            new OpenLayers.Icon("http://160.16.233.165/img/test.gif",iconsize,point)
        );

        marker.tag = "位置テストです";
        marker.x = x;
        marker.y = y;

        marker.events.register("click",marker,onMarkerClick);

        markers.addMarker(marker);

        function onMarkerClick(evt) {
            if (popup) map.removePopup(popup);
            popup = new OpenLayers.Popup.FramedCloud(
                "Popup",    //id
                new OpenLayers.LonLat(evt.object.x,evt.object.y).transform(projection4326,projection3857),
                null,    //contentHtml
                evt.object.tag,    //anchor
                null,    //anchor
                true,    //closeBox
                null    //closeBoxCallback
            );
            map.addPopup(popup);
        }

     /*
     // マップの中心を設定
        map.setCenter(new OpenLayers.LonLat(
                            longitude, // X:経度
                            latitude  // Y:緯度
                          ).transform(projection4326, projection3857),// 座標系
                          15 // デフォルトズームレベル
                          );

        $(function() {
            $.ajax({
                type:"POST",
                url:"http://160.16.233.165/cakephp3_yanagi/Useraccounts/posRegister",
                data: {
                	"longitude" : x,
                	"latitude" : y
                },
                dataType:"json",
                success: function (data) {
                    console.log(data["longitude"]);
                },
                error: function(){
                    //通信失敗時の処理
                    alert('通信失敗');
                }
            });
        });
        */
    }

    function errorCallback(error) {
        var error_msg = "";
        switch(error.code) {
            case 1:
                error_msg = "位置情報の利用がされていません";
                break;

            case 2:
                error_msg = "デバイスの位置が判定できません";
                break;

            case 3:
                error_msg = "タイムアウトしました";
                break;
        }
    }

}

