var ticker = $("#ticker");
	var t;

	var li_count = 1;
	var li_length = $("ul.news-list li").length;
						
	var li = $("li").first();

	var runTicker = function(trans_width) {
		$(li).css({"left":+trans_width+"px"});
		t = setInterval(function(){
			if (parseInt($(li).css("left")) > -$(li).width()) {
				$(li).css({"left":parseInt($(li).css("left")) - 1 + "px","display":"block"});
			} else {
				clearInterval(t);
				li = $(li).next();				
				if(li_count == li_length){
					li_count = 1;
					li = $("li").first();
					runTicker(trans_width);
				} else if (li_count < li_length) {
					li_count++;
					setTimeout(function(){
					runTicker(trans_width);
					},500);					
				}
			}
		},5);	
	}	
	$(ticker).hover(function(){
		clearInterval(t);
	},
	function(){
		runTicker(parseInt($(li).css("left")));
	});
	runTicker(ticker.width());