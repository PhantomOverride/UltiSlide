//Fields that should be shown when local image is selected
var show_local = ["local", "image", "imageFileDiv", "settingsField", "settings", "submit" , "duration", "priority", "startSettings", "effects"];
//Fields that should be hidden when local image is selected
var hide_local = ["youtube", "website"];

//Fields that should be shown when youtube is selected
var show_youtube = ["youtube", "settingsField", "settings", "videoSettings", "submit" , "priority", "startSettings"];
//Fields that should be hidden when youtube is selected
var hide_youtube = ["local", "website", "image"];

//Fields that should be shown when website is selected
var show_website = ["website", "settingsField", "settings", "submit" , "duration", "priority", "startSettings", "effects"];
//Fields that should be hidden when website is selected
var hide_website = ["local", "youtube", "image"];

$(document).ready(function(){
	Reset();

	var media = new MediaType();

    //Trigger the onchange event for the #mediaType
    $("#mediaType").change();

    //Update duration slide
    $("#durationRange").on("change", function(){
        $("#durationLabel").html($(this).val());
    });

    //Make the checkbox radiobutton combo work
    $("#effects #effectNone").on("click", function(){
        if($(this).prop("checked") == true){
            $("#effects #effectBlink").prop("checked",false);
            $("#effects #effectHorn").prop("checked",false);
        }
    });
    $("#effects #effectBlink, #effects #effectHorn").on("click", function(){
        $("#effects #effectNone").prop("checked",false);
    });
});

function MediaType(){
	var that = this;
	$("#mediaType").change(function(){
		switch($(this).val()){
			case "image":
				that.Show(show_local);
				that.Hide(hide_local);
				new Image(that.Show, that.Hide);
			break;

			case "youtube":
				that.Show(show_youtube);
				that.Hide(hide_youtube);
				new Youtube(that.Show, that.Hide);
			break;

            case "website":
                that.Show(show_website);
                that.Hide(hide_website);
                new Website(that.Show, that.Hide);
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
                that.ShowFunction(["imageFileDiv"]);
                that.HideFunction(["urlImageDiv"]);
				$("#imageFile").change(function(){ //When an image is selected
					new Settings(that.ShowFunction, that.HideFunction);
				});
			break;

			case "url":
                that.ShowFunction(["urlImageDiv"]);
                that.HideFunction(["imageFileDiv"]);
				$("#urlImage").change(function(){
					new Settings(that.ShowFunction, that.HideFunction);
				});
			break;
		}
	});
}
function Youtube(showFunction, hideFunction){
	this.ShowFunction = showFunction;
	this.HideFunction = hideFunction;

	var that = this;

	$("#youtubeUrl").change(function(){

		new Settings(that.ShowFunction, that.HideFunction);
	});

}
function Website(showFunction, hideFunction){
    this.ShowFunction = showFunction;
	this.HideFunction = hideFunction;

    var that = this;

    $("#websiteUrl").change(function(){
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
	$("#slideForm #media").show();
}
