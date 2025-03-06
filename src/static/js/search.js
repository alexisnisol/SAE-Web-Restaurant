function showDropdown() {
    document.getElementById('dropdown').style.display = 'block';
}
function hideDropdown() {
    setTimeout(() => {
        document.getElementById('dropdown').style.display = 'none';
    }, 200);
}

async function fetchResults(query) {
    if(!query) {
        query = document.querySelector('#query').value;
    }
    if (query.length === 0) {
        document.getElementById('results-list').innerHTML = '';
        return;
    }

    let type = document.querySelector('#type').value;

    let url = `/index.php?action=search&query=${query}`;
    if (type) {
        url += `&type=${type}`;
    }
    const response = await fetch(url);
    const results = await response.json();

    const resultsList = document.getElementById('results-list');
    resultsList.innerHTML = '';

    results.forEach(result => {
        const li = document.createElement('li');
        //add a link, with ./index.php?action=visualisation&idRestau=result.id_restaurant
        li.textContent = result.name + ' - ' + result.type;
        li.addEventListener('click', () => {

            window.location.href = `./index.php?action=visualisation&idRestau=${result.id_restaurant}`;
        });
        resultsList.appendChild(li);
    });

    showDropdown();
}