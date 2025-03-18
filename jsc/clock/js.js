var circle_hour=document.querySelector('.none_circle_hour');
var circle_minutes=document.querySelector('.none_circle_minutes');
var circle_second=document.querySelector('.none_circle_second');
var hour_hand=document.querySelector('.controller_hour');
var minutes_hand=document.querySelector('.controller_minutes');
var second_hand=document.querySelector('.controller_second');
var box=document.querySelector('.Box');
var am_pm=document.querySelector('.am_pm');
    setInterval(function()
{
var now=new Date();
var hour=now.getHours();
var minutes=now.getMinutes();
var second=now.getSeconds();
circle_hour.style.rotate=30*hour+"deg";
hour_hand.style.rotate=30*hour+"deg";
circle_minutes.style.rotate=6*minutes+"deg";
minutes_hand.style.rotate=6*minutes+"deg";
second_hand.style.rotate=6*second+"deg";
circle_second.style.rotate=6*second+"deg";
box.innerText=set(hour>12?hour-12:hour)+":"+set(minutes)+":"+set(second);
am_pm.textContent=(hour>12?"pm":"am");
},1000);
function set(value)
{
    return value < 10 ? '0'+value:value;
}
