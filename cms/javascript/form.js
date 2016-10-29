/**
 * TODO: Long description
 *
 * @summary  TODO: Short description 
 *
 * @requires javascriptlibrary.js
 * @class
 * @classdesc This is a description of the MyClass class.
 */

$(document).ready(function(){
	Reset();

    SetDefaultDate();
});

function Reset(){
	document.getElementById("slideForm").reset();

}

/**
* @summary This is a description
* @method SetDefaultDate
*/
function SetDefaultDate(){
    var today = new Date();
    var today = today.getFullYear() + '-' + ('0' + today.getMonth()).slice(-2) + '-' + ('0' + today.getDay()).slice(-2);
    document.getElementById("startDate").value = today;

    document.getElementById("endDate").value = today;
}
