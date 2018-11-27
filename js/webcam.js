function getCheckedFilter()
{
    var emeraude = document.getElementById('emeraude');
    var turquoise = document.getElementById('turquoise');
    var pourpre = document.getElementById('pourpre');
    var ocre = document.getElementById('ocre');
    var ivoire = document.getElementById('ivoire');
    var ebene = document.getElementById('ebene');
    var sixdofus = document.getElementById('6dofus');
    var brak = document.getElementById('brak');
    var bonta = document.getElementById('bonta');
    var solomonk = document.getElementById('solomonk');

    if (emeraude.checked)
        return "emeraude.png";
    else if (turquoise.checked)
        return "turquoise.png";
    else if (pourpre.checked)
        return "pourpre.png";
    else if (ocre.checked)
        return "ocre.png";
    else if (ivoire.checked)
        return "ivoire.png";
    else if (ebene.checked)
        return "ebene.png";
    else if (sixdofus.checked)
        return "6dofus.png";
    else if (brak.checked)
        return "brak.png";
    else if (bonta.checked)
        return "bonta.png";
    else if (solomonk.checked)
        return "solomonk.png";
    else
        return null;
}

(function() {

    var streaming = false,
        video        = document.querySelector('#video'),
        canvas       = document.querySelector('#canvas'),
        startbutton  = document.querySelector('#startbutton'),
        xhttp = new XMLHttpRequest(),
        width = 600,
        height = 0;

    navigator.getMedia = ( navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia);

    navigator.getMedia(
        {
            video: true,
            audio: false
        },
        function(stream) {
            if (navigator.mozGetUserMedia) {
                video.mozSrcObject = stream;
            } else {
                var vendorURL = window.URL || window.webkitURL;
                video.src = vendorURL.createObjectURL(stream);
            }
            video.play();
        },
        function(err) {
            console.log("An error occured! " + err);
        }
    );

    video.addEventListener('canplay', function(ev){
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth/width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false);

    function takepicture() {
        var filter = getCheckedFilter();
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        var data = canvas.toDataURL('image/png');
        xhttp.open("POST", "utils/merge_img.php", false);//false so it is synchronous
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`img_url=${data}&filter=${filter}`);
       // setTimeout(function (){
       // }, );//500 seems to work
        if (document.getElementById('photo'))
            document.removeChild('photo');
        var img = document.createElement("img");
        img.setAttribute('src', xhttp.responseText);
        img.setAttribute('id', 'photo');
        img.setAttribute('alt', 'your picture');
        var where = document.getElementById("img_url").parentElement;
        where.appendChild(img);
        //photo.setAttribute('src', xhttp.responseText);
        //photo.setAttribute('src', data);
        document.getElementById('img_url').value = data;
        document.getElementById('filter').value = filter;
    }

    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);

})();