<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>タイトル</title>
	<link rel="stylesheet" type="text/css" >
	<style>
body {
    margin: 20px;
}
canvas {
    top: 20px;
    left: 20px;
    border: 5px solid #ccc;
}
#button {
		position: static;
}
#exit {
    font-size: 120%;
    width: 130px;
    height: 50px;
}
#clear {
    font-size: 120%;
    width: 80px;
    height: 50px;
}
ul {
    margin: 0;
    padding: 0;
    list-style: none;
}
li {
    cursor:pointer;
    cursor:hand;
    display:inline-block;
    border: 1px solid #000;
    width: 100px;
    height: 100px;
}
.line {
	border-bottom: solid black 3px;
}
#header {
	text-align: left;
	height: 60px;
}
</style>
</head>


<body>

<!--メニューバー-->
<div class="line" id="header" style="width: 100%;">
	<div style="float:left">
		<form name="ktimer">
		<input type="text" name="counter" disabled style="font-size: 30px;width: 80px;height: 50px; ">
		<input type="button" name="b_start" style="font-size: 30px;width: 80px;height: 50px; " value="開始" onClick="count_start()">
		</form>
	</div>
		
	<div id="button" style="text-align:right;">
		<input type="button" id="clear" value="全消し" >
		<input type="button" id="exit" value="お絵かき終了" >
	</div>
</div>

<!--キャンバス-->

<center><br><br>
<canvas  width="800" height="600">お使いのブラウザはHTML5のCanvas要素に対応していません。</canvas>
</center>

<!--カラー-->
<center>
	<li style="background-color:#000"></li>
	<li style="background-color:#f00"></li>
	<li style="background-color:#0f0"></li>
	<li style="background-color:#00f"></li>
	<li style="background-color:#ff0"></li>
</center>	
	
<!--答え-->
<center>
	<form  name="anser" action="test1.php" method="POST">
	<input type="text" name="anserIN"  style="font-size: 30px;width: 370px;height: 50px; ">
	<a hreh = "test1.php"><input type="submit"  name="anserGO" value="回答送信" style="font-size: 30px;width: 150px;height: 50px;" disabled="true;" ></a>
	</form>
</center>





<!--タイマー機能-->
<script type="text/javascript">

//初期設定
def_count = 20;
var i = 10;
document.ktimer.counter.value = def_count;

	function count_start() {
		//カウント開始
		i = 0;
		count = document.ktimer.counter.value;
		timerID = setInterval('countdown()',1000);
		document.ktimer.b_start.disabled = true;
		
	}

	function countdown() {
		//カウント表示
		count--;
		document.ktimer.counter.value = count;	
		if (count <= 0) {
			count_stop();
		}

	function count_stop() {
		//カウント停止
		clearInterval(timerID);
		i = 1;
		document.anser.anserGO.disabled = false;
		
	}
}
</script>


<!--お絵かき昨日-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">

$(function() {
    var offset = 5;
    var startX;
    var startY;
    var flag = false;
    var canvas = $('canvas').get(0);
    if (canvas.getContext) {
        var context = canvas.getContext('2d');
    }
 
    $('canvas').mousedown(function(e) {
  
        flag = true;
        startX = e.pageX - $(this).offset().left - offset;
        startY = e.pageY - $(this).offset().top - offset;
        return false; // for chrome 
        
    });
 
    $('canvas').mousemove(function(e) {
      if(i == 0){
        if (flag) {
            var endX = e.pageX - $('canvas').offset().left - offset;
            var endY = e.pageY - $('canvas').offset().top - offset;
            context.lineWidth = 2;
            context.beginPath();
            context.moveTo(startX, startY);
            context.lineTo(endX, endY);
            context.stroke();
            context.closePath();
            startX = endX;
            startY = endY;
        }
      }
    });
 
    $('canvas').on('mouseup', function() {
        flag = false;
    });
 
    $('canvas').on('mouseleave', function() {
        flag = false;
    });
 
    $('li').click(function() {
        context.strokeStyle = $(this).css('background-color');
    });
 
    $('#clear').click(function(e) {
        e.preventDefault();
        context.clearRect(0, 0, $('canvas').width(), $('canvas').height());
    });
 
    $('#save').click(function() {
        var d = canvas.toDataURL('image/png');
        d = d.replace('image/png', 'image/octet-stream');
        window.open(d, 'save');
    });
});

</script>




</body>
</html>