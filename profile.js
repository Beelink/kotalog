function deleteSeen(id){
    $.ajax({
        url: 'delete.php',
        type: 'post',
        data: {
            id: id,
        },
        success: function(response) {
           console.log(response);
           location.reload();
        //    $("#seen").load("#seen");
        }
    });
}