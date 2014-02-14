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
	
		
	<div id="button" style="text-align:right;">
		<input type="button" id="clear" value="全消し"  disabled="true";>
		<input type="button" id="exit" value="お絵かき終了" disabled="true">
	</div>
</div>

<!--キャンバス-->

<center><br><br>
<canvas  width="800" height="600">お使いのブラウザはHTML5のCanvas要素に対応していません。</canvas>
</center>

<center>
<li style="background-color:#000"></li>
	<li style="background-color:#f00"></li>
	<li style="background-color:#0f0"></li>
	<li style="background-color:#00f"></li>
	<li style="background-color:#ff0"></li>
</center>

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
    if(i == 0){
        flag = true;
        startX = e.pageX - $(this).offset().left - offset;
        startY = e.pageY - $(this).offset().top - offset;
        return false; // for chrome
        }
    });
 
    $('canvas').mousemove(function(e) {
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