setInterval(function()
{
var left=Math.random()*290;
var size=Math.random()*25+5;
console.log(left);
var cloud=document.querySelector('.cloud');
var e=document.createElement('div');
e.classList.add('rain');
e.style.left=left+"px";
e.style.fontSize=size+"px";
e.innerText=rand_text();
cloud.appendChild(e);
setTimeout(function()
{
cloud.removeChild(e);
},2000)
},10)
function rand_text()
{
    var text='qwertyuiopasdfghjklzxcvbnm1234567890!@#$%^&*()';
    var index=Math.random();
    return text[Math.round(Math.random()*(text.length-1))];
}

console.log(rand_text());
