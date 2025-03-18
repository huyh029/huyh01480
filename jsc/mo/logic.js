var thanhchuong = document.querySelector(".thanhchuong");
var thanhmo = document.querySelector(".thanhmo");
var mo = document.querySelector(".mo");
var audioMo = document.createElement('audio');
audioMo.src = "1118.mp3";  
audioMo.preload = "auto";  
document.body.appendChild(audioMo);  
var audioChuong = document.createElement('audio');
audioChuong.src = "1119.mp3"; 
audioChuong.preload = "auto";  
document.body.appendChild(audioChuong);  

document.addEventListener("keydown", e => {
    switch (e.key) {
        case 'Enter':
            gochuong();  
            break;
        default:
            gomo(); 
            break;
    }
});

function gomo() {
    thanhmo.classList.add('go');

    setTimeout(() => {
        playAudio(audioMo);  
        mo.style.backgroundImage = "url('next-removebg-preview.png')";
        setTimeout(() => {
            mo.style.backgroundImage = "url('pre-removebg-preview.png')";
        }, 50);
    }, 150);

    setTimeout(() => {
        thanhmo.classList.remove('go');
    }, 300);
}

function gochuong() {
    thanhchuong.classList.add("go");
    setTimeout(() => {
        playAudio(audioChuong); 
    }, 150);
    setTimeout(() => {
        thanhchuong.classList.remove('go');
    }, 300);
}

function playAudio(audioElement) {
    audioElement.currentTime = 0;  
    audioElement.play();  
}

document.querySelector(".mo").addEventListener("click",()=>{
    gomo();
})

document.querySelector(".chuong").addEventListener("click",()=>{
    gochuong();
})