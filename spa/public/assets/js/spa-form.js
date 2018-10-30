
var SpaForm = function(name,formSelector,ajaxObject){
    SecalithZfForm.apply(this,arguments);
    SecalithZFCore.apply(this,arguments);
    this.name = name;
    this.formSelector = formSelector;

    this.debug_level = 3;

    this.btnSelector;
    this.optionType;
    this.ajax;

    if( typeof ajaxObject != 'undefined' ){
        this.ajax = ajaxObject;
    }
}

SpaForm.prototype = SecalithZfForm.prototype;

SpaForm.prototype.constructor = SpaForm;

/**
 *
 * @param jqButtonElement
 * @param type
 * @param indexName
 * @param removeHiddenClass
 */
SpaForm.prototype.add = function(jqButtonElement,type,indexName,removeHiddenClass) {
    window[this.name].log("Add new '" + type + "'",3);
    if(true==removeHiddenClass) {
        jqButtonElement.parent().children('.'+type+'-collection').removeClass('hidden');
    }
    window[this.name].addFieldset(jqButtonElement,type,indexName);
    window[this.name].reindexLegend(jqButtonElement,type);
    // window[this.name].reindexInput(jqButtonElement,type,['name']);
};

/**
 *
 * @param jqButtonElement
 * @param type
 */
SpaForm.prototype.remove = function(jqButtonElement,type) {
    window[this.name].removeFieldset(jqButtonElement,type);
    window[this.name].reindexLegend(jqButtonElement,type);
    // window[this.name].reindexInput(jqButtonElement,type,['name']);
};


SpaForm.prototype.setAjaxResult = function(result){
    window[this.name].ajax.result = result;
}
SpaForm.prototype.getAjaxResult = function(){
    return window[this.name].ajax.result;
}

SpaForm.prototype.get = function(type,baseUrl,relUrl){

    if(typeof baseUrl == typeof undefined){
        baseUrl = ENV_URL;
    }
    if(typeof relUrl == typeof undefined){
        baseUrl = baseUrl + "/api/form/data/";
    } else {
        baseUrl = baseUrl + relUrl;
    }

    var url;
    switch(type) {
        default:
            url = baseUrl + type + '-list';
    }

    var ajaxResult = this.ajax.get(url);
    if(typeof ajaxResult != typeof undefined){
        console.log(ajaxResult.responseJSON);
        return ajaxResult.responseJSON;
    }
}

SpaForm.prototype.initialize = function(){
    // if selected Element type is select|checkbox|radio then make sure that the element-specialized-fieldset is visible
    if($('.toggle-aware-trigger').length>0){
        for(var index = 0; index<$('.toggle-aware-trigger').length;index++){
            this.toggleFieldset($( ".toggle-aware-trigger" ).eq(index));
        }
    }

}

/**
 * In case if Zend\Form\Element\Collection option->count is set to '0'
 * the <legend> should be hidden
 *
 */
function checkHideLegendInit(fieldsetItemType) {
    var collectionSelectorClass = fieldsetItemType + '-collection',
        itemSelectorClass = fieldsetItemType + '-item'
    ;
    var parentFieldset = $('.' + collectionSelectorClass).eq(0),
        childFieldset = parentFieldset
            .children('.' + itemSelectorClass).eq(0)
            .children('fieldset').eq(0)
    ;
    if(0 === childFieldset.length) {
        // the fieldset is empty, hide the <fieldset>
        $('.' + itemSelectorClass).hide();
    }

}

//checkHideLegendInit('element');
//checkHideLegendInit('attribute');

function reindexInputName(jqButtonElement,fieldsetItemType) {
    // determine the classes for the <itemType>-collection
    // and <itemType>-item
    var collectionSelectorClass = fieldsetItemType + '-collection',
        itemSelectorClass = fieldsetItemType + '-item'
    ;
    var regexInput = /\[\d+\]/;
}

function reindexAllElementsAttributeName() {
    // determine the classes for the <itemType>-collection
    // and <itemType>-item
    var fieldsetItemType = 'element',
        collectionSelectorClass = fieldsetItemType + '-collection',
        itemSelectorClass = fieldsetItemType + '-item'
    ;
    var regexInput = /\[\d+\]/;
    // determine the wrapper for all elements
    var parentFieldset = $('.' + collectionSelectorClass).eq(0);
    // count the amount of Elements in the current parent fieldset
    var currentCount = parseInt(
        parentFieldset.find(
            '> fieldset.' + itemSelectorClass + ':visible'
        )
            .length
        ),
        currentCountDecreased = currentCount - 1
    ;
    // assign every element from the parent container to the local variable
    var elementsItems = parentFieldset.find('.' + itemSelectorClass);
    // for each [.element-item]s'
    if(currentCount>0) {
        for( var i=0; i<currentCount; i++ ) {
            // deal with direct Elements' inputs
            elementInputs = elementsItems.eq(i).find('input, select, textarea');
            if(elementInputs.length) {
                for(var j=0; j<elementInputs.length; j++) {
                    // change inputs
                    elementInputs.eq(j).attr(
                        'name',
                        elementInputs.eq(j).attr('name').replace(regexInput, '['+i+']')
                    );
                }
            }
        }
    }

    return false;
}
