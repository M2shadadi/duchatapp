const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
allUsers = document.querySelector(".all_user");

searchBar.onkeyup = ()=>{
    let searchOn = searchBar.value;
    if( searchBar != ""){
        searchBar.classList.add("active");
    }else{
        searchBar.classList.remove("active");
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/search.php", true);

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                allUsers.innerHTML = data;
            }
        }
    };
    xhr.send();
}

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/main_user.php", true);

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                allUsers.innerHTML = data;
            }
        }
    };
    xhr.send("content-type","application/X-www-form-urlencoded");
}, 500);