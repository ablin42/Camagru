function like(id_img, id_user)
{
    var xhttp = new XMLHttpRequest();
    var nb_like = document.getElementById("nb_like");
    var fire = document.getElementById("like-fire");
    var vote = 0;

    if(fire.classList.contains("liked"))
    {
        vote = -1;
        fire.classList.remove("liked");
    }
    else {
        vote = 1;
        fire.classList.add("liked");
    }

    xhttp.open("POST", "utils/like.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id=${id_img}&u=${id_user}`);

    nb_like.innerText = parseInt(nb_like.innerText) + vote;
}