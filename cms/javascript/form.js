/**
 * Functions to controll all the form objects.
 *
 * @summary Functions to controll all the form objects
 * @author Olof Haglund <olof@olofhaglund.name>
 * @requires jquery-3.1.1.min.js
 * @requires form_objects.js
 */

$(document).ready(function(){
	Reset();

    var elements = []; //Declare an array

    //////////////////////////////////////
    // Get all form elements in level 1 //
    //////////////////////////////////////
    [].forEach.call(document.getElementsByClassName("form_level_1"), function(element){
        elements.push(new Form_object(element));
    });

    //////////////////////////////////////
    ///// Get all other form object //////
    //////////////////////////////////////
    [].forEach.call(document.getElementsByClassName("Form_object"), function(element){
        var object = new Form_object(element);
        object.show(false);
        elements.push(object);
    });

    SetDefaultDate();
});

/**
* @summary Resets the default value in formular
* @method Reset
*/
function Reset(){
	document.getElementById("slideForm").reset();
}

/**
* @summary Sets the default date to todays date for the date fields
* @method SetDefaultDate
*/
function SetDefaultDate(){
    var today = new Date();
    var today = today.getFullYear() + '-' + ('0' + today.getMonth()).slice(-2) + '-' + ('0' + today.getDay()).slice(-2);
    document.getElementById("startDate").value = today;

    document.getElementById("endDate").value = today;
}
