var count = 3;
var currentCategory = 0;

function showFilters(clsName) {
    var el = document.getElementById(clsName);
    if (el.style.display == "none" || el.style.display == ""){
    el.style.display = "block";
    }else {
        el.style.display = "none";
    }
}

function changeCategory(n){
    currentCategory = n;
    var elem = document.getElementById("category");
    $.ajax({
        url: 'data.php',
        type: 'post',
        data: {
          categoryId: n,
          count: count
        },
        success: function(response) {
            $(elem).html(response);
        } 
      });
}

function showMore() {
    count += count;
    changeCategory(currentCategory);
}

$(document).ready(function() { 
    changeCategory(1);
});