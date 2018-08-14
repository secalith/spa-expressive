

var formCreate = new FormCreate("formCreate","#formCreate",new Ajax("formCreate"));

$( document ).ready(function(){
    // start the whole circus
    ENV_URL = 'http://127.0.0.1:887';
    formCreate.initialize();
});


if('caches' in window) {
 // alert(9);
    // Has support!
}