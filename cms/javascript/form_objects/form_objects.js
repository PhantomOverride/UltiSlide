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
class Form_object{
    constructor(element){
        this.element = element;
        this.signal = this.element.getAttribute("data-require");
    }

    /**
    * @summary Change if object should be shown
    * @method function
    * @param {bool} display If display is true then the object will be shown. If false then the object will be hidden.
    */
    show(display){
        this.element.style.display = display ? "" : "none";
    }
}
