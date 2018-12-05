function getActiveFilter()
{
    var nbFilter = countFilters(0);
    var filter = [];
    for (i = 1; i <= nbFilter; i++)
        filter.push( document.getElementById(`filter_${i}`).getAttribute('alt'));
    console.log(filter);
    return (filter);
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
                video.srcObject = stream;
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
            //video.setAttribute('width', width);
            //video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false);

    function takepicture() {
        var filter = getActiveFilter();
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        var data = canvas.toDataURL('image/png');
        xhttp.open("POST", "utils/merge_img.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`img_url=${data}&filter=${filter}`);
        setTimeout(function (){
            if (document.getElementById('photo'))
                document.getElementById('photo').remove();
            var img = document.createElement("img");
            img.setAttribute('src', xhttp.responseText);
            img.setAttribute('id', 'photo');
            img.setAttribute('alt', 'your picture');
            var where = document.getElementById("img_url").parentElement;
            where.appendChild(img);
            document.getElementById('img_url').value = data;
            document.getElementById('tmp_img').value = document.getElementById('photo').getAttribute('src');
            document.getElementById('filter').value = filter;
        }, 500);//500 seems to be a good fit

    }

    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);

})();