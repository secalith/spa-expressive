
function myAsyncFunction(url) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
    xhr.open("GET", url);
    xhr.onload = () => resolve(xhr.responseText);
    xhr.onerror = () => reject(xhr.statusText);
    xhr.send();
});
}

// Update content
class Update {
    constructor() {

    }
    readAjaxCall(url){
        //function myAsyncFunction(url) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
        xhr.open("GET", url);
        xhr.onload = () => resolve(xhr.responseText);
        xhr.onerror = () => reject(xhr.statusText);
        xhr.send();
    });
        //}



    }
    read(type,uid){

        const url = '/read/'+type+'/' + uid + '/json';
        const data = this.readAjaxCall(url);



        data.then(function (content) {
            var respJson = JSON.parse(content);
            jQuery('#updateModal .modal-body textarea').eq(0).text(respJson.content);
            jQuery('#updateModal .modal-body textarea').summernote({
                height:'230px',
                focus:true
                // airMode: true
            });

        }).then(function(content){

        });


            jQuery('#updateModal').modal('show');




        //jQuery('#updateModal').find('.modal-body').eq(0).html(data).modal('show');

    }
}



myAjax = new Update();

if (document.addEventListener) { // IE >= 9; other browsers
    document.addEventListener('click', function(e) {
        e = e || window.event;
        var target = e.target || e.srcElement;
        if(document.getElementsByClassName('context-menu').length>0) {
            document.getElementsByClassName('context-menu').remove();
        }
    });
    document.addEventListener('contextmenu', function(e) {

        e = e || window.event;
        var target = e.target || e.srcElement,
            text = target.textContent || text.innerText;

        // console.log(target.getAttribute('data-uid'));

        var a = target.getAttribute('data-visual-state');
        // make target hover
        target.setAttribute('data-visual-state','hover');

        e.preventDefault();

        var clickedElement = e.args;
        // console.log(text);
        // var id = clickedElement.id;

        if(document.getElementsByClassName('context-menu').length>0) {
            document.getElementsByClassName('context-menu').remove();
        }

        var listWrapper = document.createElement("div");//.setAttribute('style','position:absolute;top:'+getMouseY()+';left:'+getMouseX()+';');
        var t = document.createTextNode("Edit Content");

        var list = document.createElement('ul');
        // Edit Content
        var listItemEditContent = document.createElement('li');
        var linkItemEditContent = document.createElement('a');
        linkItemEditContent.setAttribute('href','#');
        linkItemEditContent.setAttribute('onclick','javascript:myAjax.read("content","'+target.getAttribute('data-uid')+'");return false;');
        linkItemEditContent.appendChild(document.createTextNode("Edit Content"));
        listItemEditContent.appendChild(linkItemEditContent);
        list.appendChild(listItemEditContent);
        // Edit Block
        var listItemEditBlock = document.createElement('li');
        var linkItemEditBlock = document.createElement('a');
        linkItemEditBlock.setAttribute('href','#');
        linkItemEditBlock.setAttribute('onclick','javascript:return false;');
        linkItemEditBlock.appendChild(document.createTextNode("Edit Block"));
        listItemEditBlock.appendChild(linkItemEditBlock);
        list.appendChild(listItemEditBlock);
        // Edit Area
        var listItemEditArea = document.createElement('li');
        var linkItemEditArea = document.createElement('a');
        linkItemEditArea.setAttribute('href','#');
        linkItemEditArea.setAttribute('onclick','javascript:return false;');
        linkItemEditArea.appendChild(document.createTextNode("Edit Area"));
        listItemEditArea.appendChild(linkItemEditArea);
        list.appendChild(listItemEditArea);

        listWrapper.appendChild(list);
        listWrapper.setAttribute('style','position:absolute;top:'+getMouseY()+'px;left:'+getMouseX()+'px;');
        listWrapper.setAttribute('class','context-menu');

        document.body.appendChild(listWrapper);

    }, false);

    // console.log(getMouseX());

} else { // IE < 9
    document.attachEvent('oncontextmenu', function() {
        alert("You've tried to open context menu");
        window.event.returnValue = false;
    });
}
var x = null;
var y = null;

document.addEventListener('mousemove', onMouseUpdate, false);
document.addEventListener('mouseenter', onMouseUpdate, false);
// document.addEventListener('oncontextmenu', onMouseUpdate, false);

function position(){

}
function onMouseUpdate(e) {
    x = e.pageX;
    y = e.pageY;
}

function getMouseX() {
    return x;
}

function getMouseY() {
    return y;
}


Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}
