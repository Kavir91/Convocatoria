$(document).ready(function(){
var pasa = true;
    $(document).keydown(function(event){
	console.log(event);
        if(event.shiftKey&&(event.key=="z"||event.key=="Z")){
		if(pasa){
			$('body').css("background","#888").css("color","#fff");
			pasa=false;
		}else{
			$('body').css("background","#000").css("color","#fff");
			pasa=true;
		}	
	}
    });
});
