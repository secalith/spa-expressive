var objEditor = new ObjEditor('objEditor');

var spaForm = new SpaForm("formCreate","#formCreate",null);

$( document ).ready(function(){

    $('.scroll-trigger').on('click', function (event) {
        // prevent default 'jump'
        event.preventDefault();
        scrollToByName($(this));
        return false;
    });

});

function scrollToByName(element) {
    // read target name, remove hash-tag
    var aTargetName = element.attr('href').split("#");
    var sTargetName = aTargetName[aTargetName.length-1];
    var jqTarget = $("a[name=" + sTargetName + "]");
    var sSpeed = "slow";

    // check if element exists
    if (jqTarget.length > 0) {
        // animate view to the target
        $('html,body').animate({scrollTop: jqTarget.offset().top}, sSpeed);
    }
}