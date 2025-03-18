
const canvas = document.getElementById('fireworksCanvas');
const ctx = canvas.getContext('2d');
var pic=['https://www.dropbox.com/scl/fi/xslf6z89pcm1wckex5kfa/avatar_2025_c-ng_b-_t-_t-i_l-c_may_m-n-removebg-preview.png?rlkey=uybqow6tovsss42zcqo7hn99g&st=k5rdtwp1&dl=1',
    'https://www.dropbox.com/scl/fi/u1dppytbslh8qa5321qaq/t-i_xu-ng__1_-removebg-preview.png?rlkey=s8h6u168q37d2qfkgaffpnz50&st=nyslmq8i&dl=1',
    'https://www.dropbox.com/scl/fi/9311v2pg46iwqh7zx07q8/t-i_xu-ng__2_-removebg-preview.png?rlkey=cq4ttnoyb7u90w33j0zns5szh&st=l94phxx0&dl=1'
]
document.querySelector(".avata").src = pic[Math.floor(rand(0,pic.length))];
const chuc = [
    "Năm mới chúc bạn vạn sự như ý, công việc thăng tiến, tình duyên viên mãn, tiền bạc rủng rỉnh nhé!",
    "Chúc bạn một năm mới thành công rực rỡ, mọi khó khăn đều tan biến, niềm vui luôn ngập tràn!",
    "Năm mới chúc bạn sức khỏe dồi dào, gia đình hạnh phúc, mọi việc thuận lợi suôn sẻ!",
    "Chúc bạn năm mới tràn đầy năng lượng tích cực, mọi dự định đều trở thành hiện thực!",
    "Năm mới chúc bạn bình an, may mắn, tài lộc đầy nhà và hạnh phúc viên mãn!",
    "Chúc bạn một năm mới tươi vui, hạnh phúc trọn vẹn, tiền tài gõ cửa!",
    "Năm mới chúc bạn luôn mạnh khỏe, cười nhiều hơn, sống trọn từng khoảnh khắc ý nghĩa!",
    "Chúc bạn một năm mới tràn đầy cảm hứng, công việc thuận lợi, niềm vui lan tỏa!",
    "Năm mới chúc bạn giàu sang phú quý, gia đình hòa thuận, tình yêu ngọt ngào!",
    "Chúc bạn năm mới an khang thịnh vượng, hạnh phúc viên mãn, thành công bất tận!",
    "Năm mới chúc bạn luôn vui vẻ, mọi điều tốt đẹp sẽ đến trong từng ngày tháng!",
    "Chúc bạn một năm mới rực rỡ sắc màu, cuộc sống thăng hoa, tình yêu thăng tiến!",
    "Năm mới chúc bạn sức khỏe như hổ, tài lộc như rồng, vạn sự như ý!",
    "Chúc bạn một năm mới vui vẻ, làm ăn phát tài, luôn luôn mỉm cười!",
    "Năm mới chúc bạn mọi sự đều hanh thông, gặp nhiều may mắn, tiền bạc dư dả!",
    "Chúc bạn năm mới rạng ngời niềm vui, tràn ngập yêu thương, đạt được mọi ước mơ!",
    "Năm mới chúc bạn bước qua mọi khó khăn, đón nhận những điều tuyệt vời nhất!",
    "Chúc bạn một năm mới hạnh phúc, sức khỏe dồi dào, gặt hái nhiều thành công!",
    "Năm mới chúc bạn vạn sự bình an, tài lộc như ý, gia đình luôn ấm êm!",
    "Chúc bạn năm mới phát tài phát lộc, tình duyên viên mãn, sự nghiệp thăng hoa!"
];
document.querySelector(".inContent").textContent = chuc[Math.floor(rand(0,chuc.length))]
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

class Firework {
    constructor(x, y,color) {
        this.x = x;
        this.y = y;
        this.size = Math.random() * 4 + 1;
        this.speedX = (Math.random() - 0.5) * 6;
        this.speedY = (Math.random() - 0.5) * 6;
        this.color = `hsl(${color}, 100%, 50%)`;
        this.alpha = 1;
        this.life = Math.random() * 60 + 30;
    }

    update() {
        this.x += this.speedX;
        this.y += this.speedY;
        this.alpha -= 0.001;
        this.life -= 1;

        if (this.life <= 0) {
            return false;
        }
        return true;
    }

    draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fillStyle = this.color;
        ctx.globalAlpha = this.alpha;
        ctx.fill();
    }
    
}

let fireworks = [];

function createFirework(event) {
    const x = event.x;
    const y = event.y;
    var color = rand(0,360)
    for (let i = 0; i < 100; i++) {
        fireworks.push(new Firework(x, y,color));
    }
}

function createFireworkAuto(x,y,yellow) {

    if(yellow){
    for (let i = 0; i < 200; i++) {
        fireworks.push(new Firework(x, y,60));
    }
}
else{
    color = rand(0,360)
    for (let i = 0; i < 200; i++) {
        fireworks.push(new Firework(x, y,color));
    }
}
}

function rand(min, max) {
    return Math.random() * (max - min) + min;
}


var body = document.querySelector("body")
canvas.addEventListener('click', createFirework);
width = body.offsetWidth;
height = body.offsetHeight;
function start(){
for(var i=0 ; i<100 ;i++)
createFireworkAuto(rand(width*0.1,width*0.9),rand(height*0.1,height*0.9),true)
setInterval(() => {
createFireworkAuto(rand(width*0.1,width*0.9),rand(height*0.1,height*0.9),false)
createFireworkAuto(rand(width*0.1,width*0.9),rand(height*0.1,height*0.9),false)
createFireworkAuto(rand(width*0.1,width*0.9),rand(height*0.1,height*0.9),false)
}, 1000);
}

document.querySelector('.clickme').addEventListener("click",e=>{
    document.querySelector('.clickme').classList.add('hpny')
    document.querySelector('.clickme').classList.remove('clickme')
    document.querySelector('.hpny').textContent = ''
    document.querySelector('.point').style.display = 'block'
    setTimeout(() => {
        document.querySelector('.point').style.display = 'none'
        document.querySelector('.hpny').style.display = 'none'
        document.querySelector('.hpny').textContent = 'Happy new Year'
    }, 3000);
    setTimeout(() => {
        document.querySelector('.hpny').style.display = 'flex'
    }, 3500);
    setTimeout(() => {
        document.querySelector('.hpny').style.display = 'none'
        document.querySelector('.thiep').style.display = 'flex'
    }, 6500);
    setTimeout(() => {
        start()
    }, 2100);
})

function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    fireworks = fireworks.filter(firework => firework.update());

    fireworks.forEach(firework => firework.draw());

    requestAnimationFrame(animate);
}

animate();
