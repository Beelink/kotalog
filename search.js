

function search(text) {
    console.log(text);
    var labels = document.getElementsByClassName('search-result-label');

    var bool = false;

    for(var i = 0; i < labels.length; i++) {
        if(labels[i].innerHTML.toUpperCase().indexOf(text.toUpperCase()) != -1) {
            bool = true;
        } else {
            labels[i].parentNode.style.display = "none";
        }
    }

    if(!bool) {
        alert('По вашему запросу ничего не найдено!');
    }
}