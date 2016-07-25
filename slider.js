var settings = {audioFile : "MoveMove.wav", blinkTime : 1000};
$(document).ready(function(){
	//Set width and height of canvas
	var width = $(document).width();
	var height = $(document).height();
	$("#MKslide").css({"width":width+"px","height":height+"px"});


	slideShow = new SlideShow(width, height, "2d");
	slideShow.LoadNextSlide(null);
	slideShow.NextSlide();
});

function SlideShow(canvasWidth, canvasHeight, dimension){
	var that = this;

	//Create canvas
	this.canvas = document.getElementById("MKslide");
	this.canvas.width = canvasWidth;
	this.canvas.height = canvasHeight;
	this.context = this.canvas.getContext(dimension);
	this.image = new Image();
	this.image.onload = function(){
		that.context.drawImage(this,0,0,canvasWidth,canvasHeight);
	};
	this.currentSlide;
	this.nextSlide;
}
SlideShow.prototype.LoadNextSlide = function(currentSlideNumber){

	var data = $.parseJSON($.ajax({
		type: "POST",
		url: "/mkSlide/cms/php/request.php",
		dataType: "json",
		data: {slideNumber : currentSlideNumber},
		async: false
	}).responseText);
	this.nextSlide = data;
}
SlideShow.prototype.NextSlide = function(){
	this.currentSlide = this.nextSlide; //Swap to next slide.

	if(this.currentSlide.effect != "none"){
		var effect = this.currentSlide.effect.split(',');
		for(var i = 0; i < effect.length; ++i){

			switch(effect[i]){
				case "blink":
					this.Blink(this.currentSlide.duration);
				break;
				case "horn":
					this.Horn();
				break;
			}
		}
	}

	switch(this.currentSlide.type){
		case "image":
			this.Image();
		break;
		case "youtube":
			this.Youtube();
		break;
        case "website":
            this.Website();
        break;
	}
	this.LoadNextSlide(this.currentSlide.id); //Preload next slide
	window.setTimeout(this.NextSlide.bind(this),this.currentSlide.duration * 1000);//wait x seconds before swapping
}
SlideShow.prototype.Hide = function(){
    $("#youtube").hide(0);
    $("#website").hide(0);
}
SlideShow.prototype.Image = function(){
    this.Hide();
	if(beginsWithHTTP(this.currentSlide.data)){
		this.image.src = this.currentSlide.data;
	}
	else{
		this.image.src = "http://" + this.currentSlide.data; //Set the current slide.
	}
}
SlideShow.prototype.Youtube = function(){
    this.Hide();
	this.image.src = "";
	$("#youtube").show(0);
	this.currentSlide.data = CleanYoutubeUrl(this.currentSlide.data);
	console.log(this.currentSlide.data);
	$("#youtube").attr("src", this.currentSlide.data);
}
SlideShow.prototype.Website = function(){
    this.Hide();
    this.image.src = "";
    $("#website").show(0);
    console.log(this.currentSlide.data);
    $("#website").attr("src", this.currentSlide.data);
}
SlideShow.prototype.Blink = function(duration){
	var that = this;
	for(var i = 0; i < duration * 1000; i += settings.blinkTime){
		$(".blinker").toggle(settings.blinkTime);
	}
}
SlideShow.prototype.Horn = function(){
	var audio = new Audio(settings.audioFile);
	audio.play();
}

function CleanYoutubeUrl(url){

	var vidId;
	var out;
	if(url.indexOf("youtube.com/watch?v=") !== -1){
		vidId = url.substr(url.indexOf("youtube.com/watch?v=") + 20);
		out = "https://www.youtube.com/embed/"+vidId;
	}
	else if(url.indexOf("youtube.com/watch/?v=") !== -1)
	{
		vidId = url.substr(url.indexOf("youtube.com/watch/?v=") + 21);
		out = "https://www.youtube.com/embed/"+vidId;
	}
	else if(url.indexOf("youtu.be") !== -1)
	{
		vidId = url.substr(url.indexOf("youtu.be") + 9);
		out = "https://www.youtube.com/embed/"+vidId;
	}
	else if(url.indexOf("www.youtube.com/embed/") !== -1)
	{
		out = url;
	}

	//add auto play
	if(out.indexOf("?autoplay=1") <= -1){
		out += "?autoplay=1";
	}
	if(out.indexOf("&vq=hd1080") <= -1){
		out += "&vq=hd1080";
	}
	return out;
}
function beginsWithHTTP(imageUrl){
	if(imageUrl.substring(0, 7) == "http://") return true;
	else return false;
}
function imageExists(imageUrl){
	var http = new XMLHttpRequest();

    http.open('HEAD', imageUrl, false);
    http.send();

    return http.status != 404;
}
