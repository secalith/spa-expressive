$( document ).ready(function(){

    var sTriggerSelector = '.scroll-top-trigger-wrapper';

    window.onscroll = function (event) {
        var sTriggerSelector = '.scroll-top-trigger-wrapper';
        var iTriggerSelectorTop = 200;
        setScrollTriggerVisibility(iTriggerSelectorTop,sTriggerSelector);
    }

    window.onload = function (event) {
        var sTriggerSelector = '.scroll-top-trigger-wrapper';
        var iTriggerSelectorTop = 200;
        setScrollTriggerVisibility(iTriggerSelectorTop,sTriggerSelector);
    }

    $('.scroll-trigger').on('click', function (event) {
        // prevent default 'jump'
        event.preventDefault();

        var attr = $(this).attr('href');

        if(typeof attr !== typeof undefined && attr !== false) {
            scrollToByName($(this));
        } else {
            scrollToBySelector($(this));
        }

        return false;
    });

    document.getElementById('site-logo').addEventListener('click', function (evt) {
        evt.preventDefault();
        window.location.href = "/auth";
    });
});

function scrollToByName(element) {
    // read target name, remove hash-tag
    var aTargetName = element.attr('href').split("#");
    var sTargetName = aTargetName[aTargetName.length-1];
    var jqTarget = $("[name=" + sTargetName + "]");
    var sSpeed = "slow";

    // check if element exists
    if (jqTarget.length > 0) {
        // animate view to the target
        $('html,body').animate({scrollTop: jqTarget.offset().top}, sSpeed);
    }
}

function scrollToBySelector(element) {
    // read target name, remove hash-tag
    var sTargetName = element.attr('data-scroll-target');
    var jqTarget = $(sTargetName);
    var sSpeed = "slow";

    // check if element exists
    if (jqTarget.length > 0) {
        // animate view to the target
        $('html,body').animate({scrollTop: jqTarget.offset().top}, sSpeed);
    }
}

function setScrollTriggerVisibility(iTriggerSelectorTop,sTriggerSelector){

    var positionTop = $(document).scrollTop();

    if(positionTop <= iTriggerSelectorTop) {
        // top line, the <trigger> should be hidden
        $(sTriggerSelector).fadeOut();
    } else {
        // the <trigger> should be visible
        $(sTriggerSelector).fadeIn();
    }
}