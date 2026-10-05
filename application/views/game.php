<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="vn" />
    <link href="https://apupicosmetics.com/images/favicon.png" rel="shortcut icon" type="image/x-icon">
    <meta property="og:url" content="https://ansancosmectics.com" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Ansancosmectics - Mỹ Phẩm Chính Hãng" />
    <meta property="og:description" content="An San Cosmetic cung cấp mỹ phẩm chính hãng giá tốt, tư vấn nhiệt tình, giá luôn luôn tốt!" />
    <meta property="og:image" content="https://apupicosmetics.com/upload/banner_home.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Vòng Quay May Mắn</title>
    <style type="text/css">
        body{background:#fff;padding:0;margin:0}.modal{display:none;position:fixed;z-index:1;padding-top:100px;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:#000}.modal-content{position:relative;background-color:#fefefe;margin:auto;padding:0;width:90%;max-width:1200px}.close{color:#fff;position:absolute;top:10px;right:25px;font-size:35px;font-weight:700}.close:focus,.close:hover{color:#999;text-decoration:none;cursor:pointer}.mySlides{display:none}.next,.prev{cursor:pointer;position:absolute;top:50%;width:auto;padding:16px;margin-top:-50px;color:#fff;font-weight:700;font-size:20px;transition:.6s ease;border-radius:0 3px 3px 0;user-select:none;-webkit-user-select:none}.next{right:0;border-radius:3px 0 0 3px}.next:hover,.prev:hover{background-color:rgba(0,0,0,.8)}.numbertext{color:#f2f2f2;font-size:12px;padding:8px 12px;position:absolute;top:0}.caption-container{text-align:center;background-color:#000;padding:2px 16px;color:#fff}img.demo{opacity:.6}.active,.demo:hover{opacity:1}img.hover-shadow{transition:.3s}.hover-shadow:hover{box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19)}canvas{margin:0 auto;border:1px solid #f26d63;border-radius:5px;margin-top:20px}.blink_me{animation:blinker 1s linear infinite}@keyframes blinker{50%{opacity:0}}@media only screen and (max-width:960px){#msg_board,canvas{width:90%!important;height:auto!important;margin:0 auto}#msg_board{border:none!important}}
    </style>
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>game/phaser.min.js"></script>
</head>
<body>
    <div id="myModal" class="modal">
        <span class="close cursor" onclick="closeModal()">&times;</span>
        <div class="modal-content">
            Bạn đã hết lượt quay
        </div>
    </div>
    <div style="border: 1px dotted #ea3465;border-radius: 5px;padding: 15px;margin:10px 20px;padding:15px;width: 600px;margin: 0 auto;font:sans-serif;" id="msg_board">
        <p>
            <?php 

                  	$_var01=1;$total=0;$luot_quay =0;
                    
                  	if(isset($_SESSION["total"]))
                  		$total =$_SESSION["total"];
					
					//if($total <150000)	
                  	//	redirect(base_url()."hoan-tat");
					//else
                    if(isset($_SESSION["luot_quay"]))
						$luot_quay = $_SESSION["luot_quay"];
					
					/*
                  	 if(isset($_SESSION["_var01"]))
                  	 	if($_SESSION["_var01"]>0){
                  	 		$_var01 = 1;
                  	 		$_SESSION["_var01"]=0;
                  	 	}
                  	 	else
                  	 		$_var01 = 0;
                  	*/
                 	
                  ?>
                <?php if($luot_quay==1){?>
                    Bạn có <b><span id="pr01"><?php echo $_SESSION["luot_quay"]; ?></span></b> lần quay, Click vào vòng quay để bắt đầu!
                    <br>
                     <span id="pr02" class="blink_me" style="color: red;"></span>
						<br>
                        <br>

                    <?php }else{?>
                        Bạn đã hết hoặc không có lượt quay, hãy mua thêm gì đó để quay tiếp bạn nhé!
						<br>
                        <br>	
                        <?php }?>
        </p>
    </div>
</body>

<script type="text/javascript">
     var game,wheel,canSpin,prize,prizeText,slices=12,slicePrizes=["Mặt nạ Naruko Ý dĩ nhân đỏ mốc","Bàn chải đánh răng suree","Tẩy tế bào chết Whitening Q10 Salt scrub","kem chống nắng innisfree intensive Triple shield sunscreen 10ml","kem chống nắng kiềm dầu Biore Uv","Sữa rửa mặt kiehl's hoa cúc 30ml","Son môi Missha Dare Tint Matte Tattoo","kem chống nắng Jucy" ,"kem chống nắng Biore Uv", "Bình nước starbucks","Son môi Missha Dare Tint Matte Tattoo", "kem chống nắng Jucy"],style={font:"20px Arial",fill:"#ff0044",align:"center"};
    
	
    var _var01 = <?php echo $luot_quay ?>;
    window.onload = function() {
        <?php if($luot_quay >=1){ ?>
        game = new Phaser.Game(632, 430, Phaser.AUTO, "");
        game.state.add("PlayGame", playGame);
        game.state.start("PlayGame");
        <?php }?>
    }
    var playGame = function(game) {};
    canSpin = false;
    playGame.prototype = {
        preload: function() {
            game.load.image("wheel", "https://apupicosmetics.com/game/wheelbg4.png");
            game.load.image("pin", "https://apupicosmetics.com/game/pin4.png");
        },
        create: function() {
            game.stage.backgroundColor = "#fff";
            wheel = game.add.sprite(game.width / 2, game.width / 3, "wheel");
            wheel.anchor.set(0.5);
            var pin = game.add.sprite(game.width / 2, game.width / 3, "pin");
            pin.anchor.set(0.5);
            prizeText = game.add.text(game.world.centerX, 480, "", style);
            prizeText.anchor.set(0.5);
            prizeText.align = "center";
            canSpin = true;
            game.input.onDown.add(this.spin, this);
        },
        spin() {
            if (canSpin) {
                prizeText.text = "";
                var rounds = game.rnd.between(7, 10);
                <?php
                
				 if($total <= 100000){
                 	$x=331;$y=358;                 	
                 } else if($total > 100000 AND $total <= 200000){
                 	$x=301;$y=328;
                 } else if($total >= 201000 AND $total <= 300000){
                 	$x=268;$y=298;
                 } else if($total >= 301000 AND $total <= 400000){
                 	$x=242;$y=268;
                 } else if($total >= 401000 AND $total <= 500000){
                 	$x=214;$y=236;
                 } else if($total >= 501000 AND $total <= 600000){
                  $x=182;$y=210;
                 } else if($total >= 601000 AND $total <= 800000){
                  $x=150;$y=179;
                 } else if($total >= 801000){
                  $x=149;$y=58;
                 }
				 
				
                ?>
                console.log(<?php echo $x?>, <?php echo $y?>);
                var degrees = game.rnd.between(<?php echo $x?>, <?php echo $y?>);
                prize = slices - 1 - Math.floor(degrees / (360 / slices));
                var spinTween = game.add.tween(wheel).to({
                    angle: 360 * rounds + degrees
                }, 3000, Phaser.Easing.Quadratic.Out, true);
                spinTween.onComplete.add(this.winPrize, this);
            }
        },
        winPrize() {
            if (_var01 >= 1) {
              <?php  //$_SESSION['cart_id']=100;?>
                cart_id = "<?php echo $_SESSION['nid_order']?>";
                var01 = $("#pr01").text(); //alert(var01);
                $("#pr02").text("Chúc mừng bạn đã nhận được: "+slicePrizes[prize]+"!");
                $.post("<?php echo base_url().'ajax_game/ajax_update_gift'?>", {
                        cart_id: cart_id,
                        prize: slicePrizes[prize],
                        _var01: var01
                    })
                    .done(function(data) {
                        if (var01 < 2) {
                            canSpin = false;
                        }
                    });
                $("#pr01").text(var01 - 1);
            } else {

                canSpin = false;
            }
        }
    }
</script>
<script>
    <?php 
	if($luot_quay <1){
?>
    <?php }?>
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
</script>
</html>