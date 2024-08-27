var cube=document.querySelector('.cube');
var view_x=45;
var view_y=45;
document.addEventListener('keydown',e => {
    if(e.key=='ArrowRight')
    {
        view_y++; 
    }
    else if(e.key=='ArrowUp')
        {
            view_x++; 
        }
    else if(e.key=='ArrowDown')
        {
            view_x--; 
        }
    else if(e.key=='ArrowLeft')
        {
            view_y--; 
        }
    else{}
    console.log(view_x);
    console.log(view_y);
    Object.assign(cube.style,{
        transform: `rotateX(${view_x}deg) rotateY(${view_y}deg)`
    });
}
)