$(document).ready(function(){
	Reset();
	var media = new MediaType();
});

function MediaType(){
	var that = this;
	$("#mediaType").change(function(){
		switch($(this).val()){
			case "image":
				that.Show(["local"]);
				that.Hide(["youtube"]);
				new Image(that.Show, that.Hide);
			break;
			
			case "youtube":
				that.Show(["youtube"]);
				that.Hide(["local"]);
				new Youtube(that.Show, that.Hide);
			break;
			
			case "empty":
			default:
				Reset();
			break;
		}
	});
}
MediaType.prototype.Show = function(ids){
	for(i = 0; i < ids.length; ++i){
		$("#" + ids[i]).show();
	}
}
MediaType.prototype.Hide = function(ids){
	for(i = 0; i < ids.length; ++i){
		$("#" + ids[i]).hide();
	}
}

function Image(showFunction, hideFunction){
	this.ShowFunction = showFunction;
	this.HideFunction = hideFunction;
	var that = this;
	
	$("input[name=localImage]").change(function(){
		switch($(this).val()){
			case "local":
				that.ShowFunction(["image", "imageFileDiv"]);
				that.HideFunction(["urlImageDiv"]);
				$("#imageFile").change(function(){ //When an image is selected
					that.ShowFunction(["settingsField", "settings", "submit" , "duration", "priority", "startSettings"]);
					new Settings(that.ShowFunction, that.HideFunction);
				});
			break;
			
			case "url":
				that.ShowFunction(["image", "urlImageDiv", "imageName"]);
				$("#urlImage").change(function(){
					
					that.ShowFunction(["settingsField", "settings", "submit" , "duration", "priority", "startSettings"]);
					new Settings(that.ShowFunction, that.HideFunction);
				});
				that.HideFunction(["imageFileDiv"]);
			break;
		}
	});
}
function Youtube(showFunction, hideFunction){
	this.ShowFunction = showFunction;
	this.HideFunction = hideFunction;
	
	var that = this;
	
	$("#youtubeUrl").change(function(){
		that.ShowFunction(["settingsField", "settings", "videoSettings", "submit" , "priority", "startSettings"]);
		new Settings(that.ShowFunction, that.HideFunction);
	});
	
}
function Settings(showFunction, hideFunction){
	this.ShowFunction = showFunction;
	this.HideFunction = hideFunction;
	var that = this;
	
	$("#startNow").change(function(){
		if($(this).prop('checked')){
			that.HideFunction(["timeAndDate"]);
		}
		else{
			that.ShowFunction(["timeAndDate"]);
		}
	});
}

function Reset(){
	document.getElementById("slideForm").reset();
	$("#slideForm fieldset").hide();
	$("#slideForm div").hide();
	$("#slideForm #media").show();
}