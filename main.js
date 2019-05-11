var count = 4;
var currentCategory = 0;
var currentSort = 0;
var currentFilters = [];

function showFilters(clsName) {
    var el = document.getElementById(clsName);
    if (el.style.display == "none" || el.style.display == ""){
        el.style.display = "block";
    } else {
        el.style.display = "none";
    }
}

function clearFilters() {
    currentFilters = [];

    var filters = document.getElementsByClassName('filter');

    for(var i = 0; i < filters.length; i++) {
        var inputs = filters[i].getElementsByTagName('input');

        for(var j = 0; j < inputs.length; j++) { 
            inputs[j].checked = false;
        }
    }

    var devices = document.getElementsByClassName('devices__item');

    for(var i = 0; i < devices.length; i++) {
        devices[i].style.display = "";
    }
}

function applyFilters() {
    currentFilters = [];
    var filters = document.getElementsByClassName('filter');

    for(var i = 0; i < filters.length; i++) {
        var filterName = filters[i].getElementsByTagName('button')[0].innerHTML;
        var subfilters = filters[i].getElementsByTagName('label');
        var inputs = filters[i].getElementsByTagName('input');
        var arr = [];
        for(var j = 0; j < subfilters.length; j++) {
            if(inputs[j].checked == true) {
                arr.push(subfilters[j].innerHTML.split('> ')[1]);
            }
        }
        if(arr.length > 0) {
            let Data = {
                name: filterName,
                subfilters: arr
            };
            currentFilters.push(Data);
        }
    }
    console.log(currentFilters);

    var devices = document.getElementsByClassName('devices__item');

    if(currentFilters.length > 0) {
        for(var i = 0; i < devices.length; i++) {
            var fvalues = devices[i].getElementsByClassName('item-fvalues')[0].innerHTML;

            var main = true;
            
            for(var j = 0; j < currentFilters.length; j++) {
                var okay = false;

                for(var k = 0; k < currentFilters[j].subfilters.length; k++) {
                    var str = '"' + currentFilters[j].name + '": "' + currentFilters[j].subfilters[k] + '"';
                    if(fvalues.indexOf(str) != -1) {
                        okay = true;
                    }
                }

                if(okay == false) {
                    main = false;
                }
            }

            if(main) {
                devices[i].style.display = "";
            } else {
                devices[i].style.display = "none";
            }
        }
    } else {
        for(var i = 0; i < devices.length; i++) {
            devices[i].style.display = "";
        }
    }
}

function changeCategory() {
    clearFilters();

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

function addFav(deviceId, link) {
    $.ajax({
        url: 'seen.php',
        type: 'post',
        data: {
            deviceId: deviceId,
            link: link,
        },
        success: function(response) {
           console.log(response);
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