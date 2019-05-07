var count = 3;
var currentCategory = 0;
var currentSort = 0;

function showFilters(clsName) {
    var el = document.getElementById(clsName);
    if (el.style.display == "none" || el.style.display == ""){
        el.style.display = "block";
    }else {
        el.style.display = "none";
    }
}

function changeCategory(){
    n = document.getElementById('topbar-select').selectedIndex + 1;
    sort = document.getElementById('topbar-sort').selectedIndex + 1;

    if(sort != currentSort) {
        count = 3;
    }
    if(n != currentCategory) {
        count = 3;
    }

    currentCategory = n;
    currentSort = sort;
    var elem = document.getElementById("category");
    $.ajax({
        url: 'data.php',
        type: 'post',
        data: {
          categoryId: n,
          sortId: sort,
          count: count
        },
        success: function(response) {
            $(elem).html(response);
        } 
      });
}

function showMore() {
    count += count;
    changeCategory();
}

$(document).ready(function() { 
    changeCategory();
});