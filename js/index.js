const increment = (id) => {
    const cookieExists = document.cookie.includes('incremented_' + id);

    if (cookieExists) {
        console.log('Increment blocked. Cookie exists.');
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../scripts/increment.php?id=' + id, true);

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            const response = JSON.parse(xhr.responseText);
            const updatedValue = response.updatedValue;
            const cardElement = document.getElementById('rec_' + id); 
            if (cardElement) {
                cardElement.textContent = updatedValue;
            } else {
                console.error('Card element not found');
            }

            document.cookie = 'incremented_' + id + '=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/';
        } else {
            console.error('Request failed with status:', xhr.status);
        }
    };
    xhr.send();
};
