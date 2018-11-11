var modal = document.getElementById('myModal');

var img = document.getElementsByClassName("images");
var modalImg = document.getElementById("img");
var captionText = document.getElementById("caption");
for(var i = 0; i < img.length; i++){
    img[i].onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;

    }
}

var span = document.getElementsByClassName("close")[0];

modal.onclick = function() {
    modal.style.display = "none";
}
