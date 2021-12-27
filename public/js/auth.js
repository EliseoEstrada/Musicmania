

$("#s").bind("submit",function(){

    const serial = $("#signup").serialize();
    const array = $("#signup").serializeArray();
    var formData = new FormData(this);
    console.log(serial);
    console.log(array);

});