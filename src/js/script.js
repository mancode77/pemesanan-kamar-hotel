const keyword = document.getElementById('keyword');
const parent_box = document.getElementById('parent_box');
const hidden_input = document.getElementById('hidden_input');


keyword.addEventListener('keyup', function() {
    const xhr = new XMLHttpRequest();

    const url = `../app/search.php?keyword=${keyword.value}&param=${hidden_input.value ?? 'transaksi'}`;

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            parent_box.innerHTML = xhr.responseText;
        }
    };

    xhr.open('GET', url, true);
    xhr.send();

    console.info('sad')
});