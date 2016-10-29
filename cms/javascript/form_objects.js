/**
 * Functions to controll all the form objects.
 *
 * @summary Functions to controll all the form objects
 * @author Olof Haglund <olof@olofhaglund.name>
 *
 */

/**
 * Creates a new Form_object. Saves the input.
 * @summary Creates a new Form_object
 * @class Form_object
 * @classdesc Controller for all the form objects
 * @param element An HTML element to act as an object.
 */
function Form_object(element){
    console.log(element);
    this.element = element;
}
Form_object.prototype.show = function(display){
    this.element.style.display = display ? "" : "none";
}
