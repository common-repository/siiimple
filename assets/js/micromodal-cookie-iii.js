function getCookie(nom) {
    let nomCookie = nom + "=";
    let cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i].trim();
        if (cookie.indexOf(nomCookie) === 0) {
            return cookie.substring(nomCookie.length, cookie.length);
        }
    }
    return null;
}

let modal = getCookie('modal');
if (modal) {
    console.log("Le cookie 'modal' existe avec la valeur : " + modal);
} else {
    setTimeout(function() {
        MicroModal.show('modal');
        document.cookie = 'modal=true; path=/';
    }, 7500);
}