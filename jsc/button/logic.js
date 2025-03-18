var count=0;
var root = document.documentElement;
console.log(document.querySelector(".button_left").style.animation);
document.querySelector(".button_container").addEventListener("click",function()
{
    if(document.querySelector(".button_left").style.animation=='')
        document.querySelector(".button_left").style.animation='leftAnimation 1s ease forwards';
document.querySelector(".button").children[count].style.display='none';
count=count==0?1:0;
document.querySelector(".button").children[count].style.display='block';
if(count==0)
{
    var newStyles = {
        '--body-color': 'white',
    '--container':'black',
    '--buton':'white',
    '--click':'black',
    '--circle':'white'
      };

      Object.entries(newStyles).forEach(([key, value]) => {
        root.style.setProperty(key, value);
      });
}
else
{
    var newStyles = {
        '--body-color': 'black',
    '--container':'white',
    '--buton':'black',
    '--click':'white',
    '--circle':'black'
      };

      Object.entries(newStyles).forEach(([key, value]) => {
        root.style.setProperty(key, value);
      });
}
})