<?php
$pageTitle = "RPS";
include("../frag/header.php");
?>
<script>
	jQuery(document).ready(function(){
    initWidgets();
    jQuery(".player1").rpsWidget();
});
function initWidgets(){
    (function($){
        $.widget("techFloor.rpsWidget",{
            options: {
                selected: false,
                selction: "",
                score: 0,
                gui: "",
                rock: "",
                paper: "",
                scissors: "",
                interval: "",
                animationSpeed: 20
            },
            _create: function(){
                var local = this;
                var options = local.options;
                local._prepare();
                var selectorArr = [
                    {gui: options.rock,rps:"rock"},
                    {gui: options.paper,rps:"paper"},
                    {gui: options.scissors,rps:"scissors"}];
                
                selectorArr[0].gui.click(function(){
                    var data ="type=rock";
                    if(!options.selected){
                        options.selected = true;
                        options.selection = "rock";
                        local._ajaxCall(local.callBack,data,"../controller/controller.php?action=submitRpsAction");
                    }
                });
                selectorArr[1].gui.click(function(){
                    var data ="type=paper";
                    if(!options.selected){
                        options.selected = true;
                        options.selection = "papaer";
                        local._ajaxCall(local.callBack,data,"../controller/controller.php?action=submitRpsAction");
                    }
                });
                selectorArr[2].gui.click(function(){
                    var data ="type=scissors";
                    if(!options.selected){
                        options.selected = true;
                        options.selection = "scissors";
                        local._ajaxCall(local.callBack,data,"../controller/controller.php?action=submitRpsAction");
                    }
                });
            },
            callBack: function(response,local){
				var options = local.options;
                var data = jQuery.parseJSON(response);
                if(data.winner == ""){
                    setTimeout(function(){local._ajaxCall(local.callBack,"","../controller/controller.php?action=submitRpsCheck");},10000);         
                }else{
                    //move player1's selection
                    switch(options.selection){
                        case "rock":
                            options.rock.css("float","right");
                            break;
                        case "paper":
                            options.paper.css("float","right");
                            break;
                        case "scissors":
                            options.scissors.css("float","right");
                            break;
                    }
                    if(options.selection == data.winner){
                        switch(options.selection){
                            case "rock":
                                jQuery(".player2").find(".scissors").css("float","left");
                                break;
                            case "paper":
                                jQuery(".player2").find(".rock").css("float","left");
                                break;
                            case "scissors":
                                jQuery(".player2").find(".paper").css("float","left");
                                break;
                        }
                        alert("You Win");
                    }else{
                        switch(options.selection){
                            case "rock":
                                jQuery(".player2").find(".paper").css("float","left");
                                break;
                            case "paper":
                                jQuery(".player2").find(".scissors").css("float","left");
                                break;
                            case "scissors":
                                jQuery(".player2").find(".rock").css("float","left");
                                break;
                        }
                        alert("You Lose");
                    }
                }
            },
            _ajaxCall: function(callback, data, url){
                var that = this;
                var d = new $.Deferred();
                var success = true;
                $.ajax({
                    cache: false,
                    complete: function(jqXHR, textStatus){
                        d.resolve(success);
                    },
                    data: data,
                    dataType: "text",
                    error: function(jqXHR, textStatus, errorThrown){
                        success = false;
                    },
                    success: function(data, textStatus, jqXHR){
                        callback(data, that);
                    },
                    url: url
                });
                return d.promise();
            },
            _prepare: function(){
                var local = this;
                local.option("gui",jQuery(local.element));
                local.option("rock",jQuery(".p1selection.rock"));
                local.option("paper",jQuery(".p1selection.paper"));
                local.option("scissors",jQuery(".p1selection.scissors"));
            }
        });
    }(jQuery));
}

</script>
<div class="pageTitle">
    Rock Paper Scissors
</div>
<div id="playingBoard" style="height:600px;width:800px;">
	<div id="scoreBoard" style="width:100%;height:10%;border:1px solid black">

	</div>
	<div class="player1" style="float:left;height:90%;width:350px;">
		<div style="width:100%;height:33%;"><img class="p1selection rock" src="../images/rock.png" style="padding-top:30px;"/></div>
		<div style="width:100%;height:33%;"><img class="p1selection paper" src="../images/paper.png"/></div>
		<div style="width:100%;height:33%;"><img class="p1selection scissors" src="../images/scissors.png" style="padding-top:30px;"/></div>
	</div>
	<div id="battleIcon" style="float:left;height:90%;width:100px;"><center style="padding-top:250px;">vs.</center></div>
	<div class="player2" style="float:left;height:90%;width:350px;">
		<div style="width:100%;height:33%;"><img class="p2selection rock" src="../images/rock.png" style="float:right;padding-top:30px;-webkit-transform:scaleX(-1);-moz-transform:scaleX(-1);"/></div>
		<div style="width:100%;height:33%;"><img class="p2selection paper" src="../images/paper.png" style="float:right;-webkit-transform:scaleX(-1);-moz-transform:scaleX(-1);"/></div>
		<div style="width:100%;height:33%;"><img class="p2selection scissors" src="../images/scissors.png" style="float:right;padding-top:30px;-webkit-transform:scaleX(-1);-moz-transform:scaleX(-1);"/></div>
	</div>
</div>
<?php
include("../frag/footer.php");
?>