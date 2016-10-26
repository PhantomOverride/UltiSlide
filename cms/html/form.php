<form id="slideForm" action="php/upload.php" method="post" enctype="multipart/form-data">
	<fieldset id="media">
	    <legend>Load upp new slide </legend>
	    <label for="mediaType">Media type</label>
	    <select name="mediaType" id="mediaType">
            <option value="image" selected="selected">Image (jpeg, jpg, png)</option>
            <option value="youtube">Youtube</option>
            <option value="website">Website</option>
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

	    <div id="youtube"> <!--ONly if youtube is slected -->
            <label for="youtubeUrl">Url to video </label>
            <input type="url" name="youtubeUrl" id="youtubeUrl" checked />
	    </div>

        <div id="website">
            <label for="websiteUrl">Url to website </label>
            <input type="url" name="websiteUrl" id="websiteUrl" />
        </div>
	</fieldset>

	<fieldset id="settingsField">
	    <div id="settings">
			<div id="effects">
				<h2>Effects</h2>
				<label for="effectNone">None</label>
				<input type="radio"		name="effect[]" id="effectNone" 	value="none" checked />
				<label for="effectBlink">Blink</label>
				<input type="checkbox" 	name="effect[]" id="effectBlink" 	value="blink"/>
				<label for="effectHorn">Horn</label>
				<input type="checkbox" 	name="effect[]" id="effectHorn" 	value="horn"/>
			</div>
			<br />

			<div id="videoSettings">
				<!--<label for="playToEnd"> Play to end off video </label>
				<input type="checkbox" name="playToEnd" id="playToEnd" value="playToEnd"> -->
				<span> Video will allways run to the end </span>
			</div>

			<div id="duration">
				<label for="duration" >Image duration: </label>
				<span id="durationLabel">10</span>
				<input type="range" name="duration" id="durationRange" min="1" value="10" max="1000" step="1" />
                <!-- XXX: This limit is only for easier slide and not the maximum the server can take. -->
			</div>

			<br />

			<div id="priority">
				<label for="priority">Priority</label>
				<input type="number" name="priority" id="priority" min="0" value="0"/>
			</div>

			<br />

			<div id="startSettings">
				<label for="startNow"> Start now </label>
				<input type="checkbox" name="startNow" id="startNow" value="true" checked/>

				<div id="timeAndDate">

					<label for="startDate">Start date</label>
					<input type="date" name="startDate" id="startDate" />
					<label for="startTime">Start time</label>
					<input type="time" name="startTime" id="startTime" value="00:00:00" />

					<br />

					<label for="endDate">End date</label>
					<input type="date" name="endDate" id="endDate" />
					<label for="endTime">End time</label>
					<input type="time" name="endText" id="endTime" value="00:00:00" />
				</div>

			</div><!-- END startSettings -->
		</div><!-- END settings -->

	    <input type="submit" name="submit" id="submit" value="ADD"/>
		<br>
	</fieldset>
</form>
