
function _(el) {
    return document.getElementById(el);
}

function uploadFile() {
    _("status").innerHTML = '<div class="alert alert-dismissible alert-warning" id = "status"><button type="button" class="close" data-dismiss="alert">&times;</button><i class = "material-icons left">info</i> Please wait..</div>';  // use a preloader (materialize own)
}

// Materialize: To initiate materialboxed
$(document).ready(function(){
    $('.materialboxed').materialbox();
});


// Materialize: To initialize collapsible
$(document).ready(function(){
    $('.collapsible').collapsible();
});


// Bootstrap: Modal 
$("modal").modal()

// Materiailize Modal
$(document).ready(function(){
    $('.modal').modal();
});


$(document).ready(function(){
    $('.tooltipped').tooltip();
  });