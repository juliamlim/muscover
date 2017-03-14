// JavaScript Document
$(document).ready(function() {
    "use strict";
    var height = $(window).height();
    
    setInterval(function(){
        $('body').css("min-height", height);
    },0.1);
});