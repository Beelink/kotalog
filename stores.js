var count = 3;
var currentCategory = 0;

function moreShops(){
    var elem = document.getElementById("table");
    $.ajax({
        url: 'more.php',
        type: 'post',
        data: {
          count: count
        },
        success: function(response) {
            $(elem).html(response);
        } 
      });
}

function showMore() {
    count += count;
    moreShops();
}

