//Enum like object
var MEDIA_TYPES = {
    EMPTY   : {type : 0, name : "empty",    id: [] },
    IMAGE   : {type : 1, name : "image",    id: ["local", "image"]},
    YOUTUBE : {type : 2, name : "youtube",  id: ["youtube"]}
}

$(document).ready(function(){
    var mediaType; //Media type to upload
    var local;
    var imageIds = { // Id's for the image type
        container   : "image",
        local       : "imageFileDiv",
        url         : "urlImageDiv"
    } 
	
    $("#mediaType").change(function(){ //Change the current media type
        switch($(this).val()){
            case "image":
                mediaType = MEDIA_TYPES.IMAGE;
                Show(mediaType);
            break;
            case "youtube":
                mediaType = MEDIA_TYPES.YOUTUBE;
                Show(mediaType);
            break;
            
            default:
                mediaType = MEDIA_TYPES.EMPTY;
                HideAll();
            break;
        }
    });
	
	$("#imageFile").change(function(){ //When an image is selected
		$("#settings").show();
		ShowButton();
	});
	
    $("input[name=localImage]").change(function(){
        switch($(this).val()){
            case "local":
                local = true;
                ImageSub(imageIds.local, imageIds.container, imageIds.url);
            break;
            case "url":
                local = false;
                ImageSub(imageIds.url, imageIds.container, imageIds.local);
            break;
        }
    });
    $("#urlImage").change(function(){
        var url = new StringCheck($ ("#urlImage").val());
        
        if(url.IsUrl() && url.IsImage()){
            $("#imageName").show();
        }
    });
	$("#imageName").change(function(){
		$("#settings").show();
		ShowButton();
	});
    
	$("#youtubeUrl").change(function(){
		$("#settings").show();
		$("#videoSettings").show();
		ShowButton();
	});
	
	$("#duration").change(function(){
		$("#durationLabel").html($(this).val());
	});
	
	//fields filled for show button
	$("#startNow").change(function(){
		if($(this).prop('checked')){
			ShowButton();
			HideTime();
		}
		else{
			HideButton();
			ShowTime();
		}
	});
	$("#endTime").change(function(){
		ShowButton();
	});
	
	//Change the chckbox radio combo 
	$("input[name='effect[]']").change(function(){
		if($(this).attr('type') == 'radio'){
			if($(this).prop('checked')){
				$("input[name='effect[]'][type='checkbox']").prop('checked', false);
			}
			else{
				$("input[name='effect[]'][type='checkbox']").prop('checked', true);
			}
		}
		else{
			if($(this).prop('checked')){
				$("input[name='effect[]'][type='radio']").prop('checked', false);
			}
		}
	});
	
	/**
	* Shows the submit button
	*/
    function ShowButton(){
        $("#submit").show();
    }
	/**
	* Hides the submit button
	*/
    function HideButton(){
        $("#submit").hide();
    }
    
    /**
    * Shows the selected media form section.
    * @param {MEDIA_TYPES.object} media: A MEDIA_TYPES object containing the selected media type
    */
    function Show(media){
        HideAll();
        for(i = 0; i < media.id.length; ++i){
            $("#" + media.id[i]).show();
        }
    }
	
	function ShowTime(){
		$("#timeAndDate").show();
	}
	function HideTime(){
		$("#timeAndDate").hide();
	}
	
    /**
    * Hides all section.
    */
    function HideAll(){
        for(var key in MEDIA_TYPES){
            for(i = 0; i < MEDIA_TYPES[key].id.length; ++i){
                $("#" + MEDIA_TYPES[key].id[i]).hide();
            }
        }
		$("#settings").hide();
        HideButton();
    }
    /**
    * Showes the section for selecting image.
    * @param {string} id: Id for the selected image fetch style (load up or fetch by url)
    * @param {string} div: Id for the containing div
    * @param {string} idNotSelected: Arra
    */
    function ImageSub(id, div, idNotSelected){
        //First hide both of them if one of them is allready up
        $("#"+idNotSelected).hide();
        
        $("#"+div).show();
        $("#"+id).show();
    }
});

