var objEditor = new ObjEditor('objEditor');

var spaForm = new SpaForm("formCreate","#formCreate",null);

$( document ).ready(function(){
    // start the whole circus
    ENV_URL = 'http://spa.local.vm';
    spaForm.initialize();



});