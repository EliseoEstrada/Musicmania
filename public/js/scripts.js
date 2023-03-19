
function previewImage(event){
    var reader = new FileReader();
    var imageField = document.getElementById("user_image_field")

    reader.onload = function(){
        if(reader.readyState == 2){
            imageField.src = reader.result;
        }
    }

    reader.readAsDataURL(event.target.files[0]);
}

function delete_item_cart(button){

    var product_id = $(button).attr('product_id');

    var formData = new FormData();
    formData.append('product_id',product_id);

    //console.log(product_id);

    $.ajax({
        type: "POST",
        url: "../src/ajax/delete_item_cart.php",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data){

            var jsonData = JSON.parse(data);
            
            console.log('id:' + jsonData.id);

            if(jsonData.result == true){
               //$(button).parent().parent().remove();
               //7 actualizarTotal()
               //console.log('success x2');
            }
            
            
        },
        error: function(data){
            console.log('error');
        }
    });
}