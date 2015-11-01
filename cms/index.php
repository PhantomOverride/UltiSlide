<html>
<head>
	<meta charset="UTF-8">
	<title>mkSlider CMS</title>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="javascript/strings.js"></script>
	<script src="javascript/form.js"></script>
	<link rel="stylesheet" type="text/css" href="basicStyle.css"/>
</head>
<body>
    <form id="slideForm" action="php/upload.php" method="post" enctype="multipart/form-data">
	<fieldset>
	    <legend>Load upp new slide </legend>
	    <label for="mediaType">Media type</label>
	    <select name="mediaType" id="mediaType">
            <option value="empty" selected="selected"></option>
            <option value="image">Image (jpeg, jpg, png)</option>
            <option value="youtube">Youtube</option>
	    </select>
	    
	    <div id="local"> <!-- Only if image is selected -->
            <label for="localImageLocal">Local file</label>
            <input type="radio" name="localImage" id="localImageLocal" value="local" />
            <label for="lovalImageUrl">Internet image</label>
            <input type="radio" name="localImage" id="localImageUrl" value="url" />
	    </div>
	    
	    <div id="image">
            <div id="imageFileDiv">
                <label for="imageFile">Upload image (jpeg, jpg, png)</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="4000000" />
                <input type="file" name="imageFile" id="imageFile" accept=".jpeg,.jpg,.png" />
            </div>
            <div id="urlImageDiv">
                <label for="urlImage">Url to image</label>
                <input type="url" name="urlImage" id="urlImage">
                <br />
				<div id="imageName">
					<label for="urlImageName">Name the image</label>
					<input type="text" name="urlImageName" id="urlImageName" />
				</div>
            </div>
	    </div>
	    
	    <div id="youtube">
            <label for="youtubeUrl">Url to video </label>
            <input type=url name="youtubeUrl" id="youtubeUrl" checked />
	    </div>
	    
	    <div id="settings">
			<h2>Effects</h2>
			<label for="effectNone">None</label>
			<input type="radio"		name="effect[]" id="effectNone" 	value="none" checked />
			<label for="effectBlink">Blink</label>
			<input type="checkbox" 	name="effect[]" id="effectBlink" 	value="blink"/>
			<label for="effectHorn">Horn</label>
			<input type="checkbox" 	name="effect[]" id="effectHorn" 	value="horn"/>
			
			<br />
			
			<div id="videoSettings">
				<!--<label for="playToEnd"> Play to end off video </label>
				<input type="checkbox" name="playToEnd" id="playToEnd" value="playToEnd"> -->
				<span> Videon kommer att alltid att köra till slutet </span>
			</div>
			
			<label for="duration" >Image duration: </label>
			<span id="durationLabel">10</span>
			<input type="range" name="duration" id="duration" min="1" value="10" max="120" step="1" />
			
			<br />
			
			<label for="priority">Priority</label>
			<input type="number" name="priority" id="priority" min="0" value="0"/>
			
			<br />
			
			<label for="startNow"> Start now </label>
			<input type="checkbox" name="startNow" id="startNow" value="true" checked/>
		
			<div id="timeAndDate">
				
				<label for="startDate">Start date</label>
				<input type="text" name="startDate" id="startDate" value="2015-01-01" />
				<label for="startTime">Start time</label>
				<input type="text" name="startTime" id="startTime" value="00:00:00" />
				
				<br />
				
				<label for="endDate">End date</label>
				<input type="text" name="endDate" id="endDate" value="2015-01-02" />
				<label for="endTime">End time</label>
				<input type="text" name="endText" id="endTime" value="24:00:00" />
			</div>
		</div>
	        
	    <input type="submit" name="submit" id="submit" value="Add" />
	</fieldset>
    </form>
</body>

</html>
