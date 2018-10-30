
function SecalithZfForm(name,formSelector){
    this.name = name;
    this.formSelector = formSelector;
    this.form;
    this.collectionClass;
    this.itemClass;
    this.dataTemplateIndexPlaceholderAttribute = "template-index-placeholder";
    this.dataAjaxAware = "ajax-aware";
    this.typeDataSet = "ajax-type";
};

SecalithZfForm.prototype.getForm = function() {
    return this.form;
};

SecalithZfForm.prototype.setForm = function() {
    this.form = jQuery(this.formSelector).eq(0);
    return this.form;
};

SecalithZfForm.prototype.toggleElement = function(
    jqButtonElement,
    fieldsetType,
    templatePlaceholder
) {
    var target = jQuery(jqButtonElement.attr("data-target"));
    window[this.name].log("addElement '" + fieldsetType + "'",3);
}

SecalithZfForm.prototype.addFieldset = function(
    jqButtonElement,
    fieldsetType,
    templatePlaceholder
) {
    window[this.name].log("addFieldset '" + fieldsetType + "'",3);
    // define selectors for the collections and items
    var collectionSelectorClass = fieldsetType + '-collection',
        itemSelectorClass = fieldsetType + '-item'
    ;
    // determine the collection wrapper for all elements
    var collectionFieldset = jqButtonElement.parents().eq(0)
        .children('.' + collectionSelectorClass).eq(0);
    // extract the template string
    var currentLegendText = $(collectionFieldset
            .children('span[data-template]').eq(0)
            .data('template')
        ).children('legend').text()
    ;

    if(collectionFieldset.length==0) {
        window[this.name].log("." + collectionSelectorClass + " not found.",0);
        return false;
    }

    // get the current count
    var currentCountElement = parseInt(
        collectionFieldset.children('.' + itemSelectorClass)
            .length
        ),
        currentCountElementIncreased = currentCountElement + 1,
        currentCountElementDecreased = currentCountElement - 1,
        countParentElement = window[this.name].countParentElements(jqButtonElement,fieldsetType)
    ;
    // compose <legend> so it contains the counter
    var wrapperLegendSuffix = '<span class="' + fieldsetType +
        '-count">#' + currentCountElementIncreased + '</span>'
    ;
    // copy text() of the existing <legend> and replace with <span>(s)
    var wrapperLegend = $('<legend>').html('<span>' +
        currentLegendText +
        '</span> ' + wrapperLegendSuffix
        )
    ;
    // if templatePlaceholder is undefined or false, then try to pickup the placeholder from the fieldsets data attribute
    if( typeof templatePlaceholder == "undefined" || templatePlaceholder == false ){
        var attr = collectionFieldset.data(this.dataTemplateIndexPlaceholderAttribute);
        if(typeof attr !== typeof undefined && attr !== false){
            templatePlaceholder = attr;
        }
    }
    // extract the template string and replace the counter
    var template = $(collectionFieldset
            .children('span[data-template]').eq(0)
            .data('template')
            .replace(new RegExp(templatePlaceholder, "g"), currentCountElement)
        )
    ;
    // check if any ajax calls needs to be done
    var isAjaxAware = collectionFieldset.data(this.dataAjaxAware);
    if(typeof isAjaxAware !== typeof undefined && isAjaxAware == "1"){
        var typeDataSet = collectionFieldset.data(this.typeDataSet);
        if(typeof typeDataSet !== typeof undefined){
            // Make AJAX Call here
            var r = window[this.name].get(typeDataSet);
            for(prop in r) {
                for(item in r[prop]){
                    if(template.find('select').length>0){
                        template.find('select').eq(0).append($('<option>', {
                            value: item,
                            text : item
                        }));
                    }
                }
            }
        }
    }

    // remove the existing <legend> from the template
    template.children('legend').eq(0).remove();
    // prepend the <legend> with <span>s and the counter
    template.prepend(wrapperLegend);
    collectionFieldset.append(template);

    return false;
};

SecalithZfForm.prototype.removeFieldset = function(jqButtonElement,fieldsetType) {
    // determine the classes for the <itemType>-item
    var itemSelectorClass = fieldsetType + '-item';
    // assign the parent wrapper to a local variable
    var parentFieldset = $(jqButtonElement).parents('.' + itemSelectorClass).eq(0);
    // remove the parent wrapper
    parentFieldset.remove();

    return false;
};

SecalithZfForm.prototype.reindexLegend = function(jqButtonElement,fieldsetType) {
    // determine the classes for the <itemType>-collection
    // and <itemType>-item
    var collectionSelectorClass = fieldsetType + '-collection',
        itemSelectorClass = fieldsetType + '-item',
        parentFieldset = $('.' + collectionSelectorClass).eq(0),
        elementsItems = parentFieldset.find('.' + itemSelectorClass);
    ;
    // extract the template string and replace the counter
    var currentLegendText = $(parentFieldset
            .children('span[data-template]').eq(0)
            .data('template')
        ).children('legend').text()
    ;
    // count the amount of Elements in the current parent fieldset
    var currentCountElement = parseInt(
        parentFieldset.find(
            '> fieldset.' + itemSelectorClass
        )
            .length
        )
    ;
    // for each [.element-item]s'
    // console.log(currentCountElement);
    //
    if(currentCountElement>0) {
        for (var i = 0; i < currentCountElement; i++) {
            // compose the <legend> so it contains the counter
            // copy text() of the existing <legend> and replace with <span>(s)
            var wrapperLegendIndex = '<span class="' + fieldsetType +
                '-count">#' + parseInt(i+1) + '</span>',
                wrapperLegend = $('<legend>').html( '<span>' +
                    currentLegendText +
                    '</span> ' + wrapperLegendIndex
                )
            ;
            // remove the existing <legend> from the fieldset
            elementsItems.eq(i).children('legend').eq(0)
                .html($(wrapperLegend).html())
            ;
        }
    }

    return false;
};

SecalithZfForm.prototype.checkHideLegendForEmptyFieldset = function(jqButtonElement,fieldsetType) {

};

SecalithZfForm.prototype.hideLegendForEmptyFieldset = function(jqButtonElement,fieldsetType) {

};

SecalithZfForm.prototype.reindex = function(jqButtonElement,fieldsetType) {

};

SecalithZfForm.prototype.getTemplatePlaceholder = function(jqButtonElement,fieldsetType) {

};

SecalithZfForm.prototype.countParentElements = function(jqButtonElement,fieldsetType) {
    var result,
        parentCollectionSelectorClass = fieldsetType + '-collection',
        parentItemSelectorClass = fieldsetType + '-item'
    ;
    if (undefined !== typeof jqButtonElement) {
        // get the current count of parent -items
        var countParentElement = jqButtonElement
            .parents('.' + parentCollectionSelectorClass).eq(0)
            .children('.'+parentItemSelectorClass).length
        ;

        return countParentElement;
    }

    return result;
};

/**
 * Implements an interaction between select field and other fieldsets visibility, huh
 * If the select element had attribute 'data-toggle' defined, and if it is json
 * then the function determines which fieldset to show/hide
 *
 * Example of the 'data' argument:
 *  { select:
 *      {show:["element_select_options"]},
 *    checkbox:
 *      {show:["element_checkbox_options"]},
 *    radio:
 *      {show:["element_radio_options"]}
 *  }
 *
 * @param jqElement
 * @param data
 */
SecalithZfForm.prototype.toggleFieldset = function(jqElement,data) {

    if (typeof data === "undefined") {
        data = JSON.parse(jqElement.attr('data-toggle'));
    }

    if (undefined !== typeof jqButtonElement) {
        var selectedValue = jqElement.val();
        for (var type in data) {
            // display fieldsets declared in 'data'. Fieldset class should be 'element_select-collection', 'element_checkbox-collection' etc
            if(data[type].hasOwnProperty('show')){
                for (var i = 0; i < data[type].show.length; i++) {
                    var collectionSelector = '.' + data[type].show[i] + '-collection';
                    var collection = $(collectionSelector);
                    if(collection.length > 0) {
                        if (selectedValue !== type) {
                            // hide fieldset
                            collection.slideUp( "default", function() {
                                $(this).addClass('hidden');
                                $(this).attr('style','');
                            });

                        } else {
                            // display the selected fieldet
                            collection.slideDown( "default", function() {
                                $(this).removeClass('hidden');
                                $(this).attr('style','');
                            });
                            var collectionChildren = collection.children('.container-collection');
                            // check if there are other fieldset items which should be displayed
                            if(collectionChildren.length>0) {
                                // check if the Collection has any Items, if yes then those should be displayed
                                for(var j = 0; j < collectionChildren.length; j++) {
                                    if(collectionChildren.eq(j).children('.container-item').length>0) {
                                        collectionChildren.eq(j).removeClass('hidden');
                                    }
                                }
                            }
                        }
                    }
                }
            }

            // hide fieldsets declared in the data
            if(data[type].hasOwnProperty('hide')){
                // @todo
            }

            // empty the -item in other (not the current one) child collections, otherwise empty [and hidden] fieldsets gets submitted
            if($('.element_'+type+'-collection').children('.container-collection').length>0){
                if (selectedValue !== type) {
                    var children = $('.element_'+type+'-collection').children('.container-collection');
                    for(var k = 0; k<children.length;k++) {
                        if(children.eq(k).children('.container-item').length>0){
                            children.eq(k).addClass('hidden');
                            children.eq(k).children('.container-item').remove();
                        }
                    }
                }
            }
        }

    }
}

SecalithZfForm.prototype.toggleFormRow = function(jqElement,data) {

    if (typeof data === "undefined") {
        data = JSON.parse(jqElement.attr('data-toggle'));
        var dataTarget = JSON.parse(jqElement.attr('data-target'));
    }

    if (undefined !== typeof jqButtonElement) {
        var selectedValue = jqElement.val();
        for (var type in data) {
            // display fieldsets declared in 'data'. Fieldset class should be 'element_select-collection', 'element_checkbox-collection' etc
            if(data[type].hasOwnProperty('show')){
                for (var i = 0; i < data[type].show.length; i++) {
                    var collectionSelector = '.' + data[type].show[i] + '-collection';
                    var collection = $(collectionSelector);
                    if(collection.length > 0) {
                        if (selectedValue !== type) {
                            // hide fieldset
                            collection.slideUp( "default", function() {
                                $(this).addClass('hidden');
                                $(this).attr('style','');
                            });

                        } else {
                            // display the selected fieldet
                            collection.slideDown( "default", function() {
                                $(this).removeClass('hidden');
                                $(this).attr('style','');
                            });
                            var collectionChildren = collection.children('.container-collection');
                            // check if there are other fieldset items which should be displayed
                            if(collectionChildren.length>0) {
                                // check if the Collection has any Items, if yes then those should be displayed
                                for(var j = 0; j < collectionChildren.length; j++) {
                                    if(collectionChildren.eq(j).children('.container-item').length>0) {
                                        collectionChildren.eq(j).removeClass('hidden');
                                    }
                                }
                            }
                        }
                    }
                }
            }

            // hide fieldsets declared in the data
            if(data[type].hasOwnProperty('hide')){
                // @todo
            }

            // empty the -item in other (not the current one) child collections, otherwise empty [and hidden] fieldsets gets submitted
            if($('.element_'+type+'-collection').children('.container-collection').length>0){
                if (selectedValue !== type) {
                    var children = $('.element_'+type+'-collection').children('.container-collection');
                    for(var k = 0; k<children.length;k++) {
                        if(children.eq(k).children('.container-item').length>0){
                            children.eq(k).addClass('hidden');
                            children.eq(k).children('.container-item').remove();
                        }
                    }
                }
            }
        }

    }
}

