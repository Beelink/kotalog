var count = 4;
var currentCategory = 0;
var currentSort = 0;

function showFilters(clsName) {
    var el = document.getElementById(clsName);
    if (el.style.display == "none" || el.style.display == ""){
        el.style.display = "block";
    } else {
        el.style.display = "none";
    }
}

function changeCategory(){
    n = document.getElementById('topbar-select').selectedIndex + 1;
    sort = document.getElementById('topbar-sort').selectedIndex + 1;

    if(sort != currentSort) {
        count = 4;
    }
    if(n != currentCategory) {
        count = 4;
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

    $.ajax({
        url: 'filters.php',
        type: 'post',
        dateType: 'text',
        data: {
            categoryId: n
        },
        success: function(response) {
            var json = JSON.parse(response);
            var obj = JSON.parse(Object.entries(json)[0][1]);
            var arr = Object.keys(obj).map(function(key) {
                return [Number(key), obj[key]];
            });
            // console.log(arr);

            var filters = document.getElementById('filters');
            var first = filters.firstElementChild; 
            while (first) { 
                first.remove(); 
                first = filters.firstElementChild; 
            } 

            for (var i = 0; i < arr.length; i++) {
                var item = document.createElement('li');
                item.classList.add('filter');
                item.innerHTML = `<button onclick="showFilters('` + "filter-" + i + `')">` + arr[i][1].name + `</button>`;

                var ul = document.createElement('ul');
                ul.id = "filter-" + i;
                ul.style.display = "none";
                for(var j = 0; j < arr[i][1].subfilters.length; j++) {
                    var li = document.createElement('li');
                    li.innerHTML = `<li><label><input type="checkbox" id="filter-"` + i + `-subfilter-` + j + `> ` + arr[i][1].subfilters[j] + `</label></li>`;
                    ul.appendChild(li);
                }
                item.appendChild(ul);

                filters.appendChild(item);
            }
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