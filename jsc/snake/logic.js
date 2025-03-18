function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}
var x=[3,4];
var y=[3,3];
var x_t;
var y_t;
var control='ArrowRight';
var col=getRandomInt(1,50);
var row=getRandomInt(1,25);
var tomato=document.querySelector('.tomato');
var score=document.querySelector('.va_sc');
var level=document.querySelector('.va_le');
var max=document.querySelector('.va_ma');
var sc=0;
var le;
var ma;
Object.assign(tomato.style,{
    gridColumn: `${col}/${col + 1}`,
    gridRow: `${row}/${row + 1}`
});
document.addEventListener('keydown',e=>{
    if((e.key=='ArrowRight'||e.key=='d')&&(control!='ArrowLeft'&&control!='a'))
        {
            control=e.key;
        }
        else if((e.key=='ArrowLeft'||e.key=='a')&&(control!='ArrowRight'&&control!='d'))
            {
                control=e.key;
            }
        else if((e.key=='ArrowUp'||e.key=='w')&&(control!='ArrowDown'&&control!='s'))
            {
                control=e.key;
            }
        else if((e.key=='ArrowDown'||e.key=='s')&&(control!='ArrowUp'&&control!='w'))
            {
                control=e.key;
            }
        else{}
})
var border=document.querySelector('.border');
var act=setInterval(function (){
    if(gameover(x,y)) clearInterval(act);
    else{
        x_t=x[x.length-1];
        y_t=y[y.length-1];
    if(control=='ArrowRight'||control=='d')
        {
            activ(x,y);
          x[0]++;
        }
        else if(control=='ArrowLeft'||control=='a')
            {
                activ(x,y);
                x[0]--;
            }
        else if(control=='ArrowDown'||control=='s')
            {
                activ(x,y);
                y[0]++;
            }
        else if(control=='ArrowUp'||control=='w')
            {
                activ(x,y);
                y[0]--;
            }
        else{}
        
        if(x[0]==col&&y[0]==row)
        {
                col=getRandomInt(1,50);
                row=getRandomInt(1,25);
                tomato=document.querySelector('.tomato');
                Object.assign(tomato.style,{
                gridColumn: `${col}/${col + 1}`,
                gridRow: `${row}/${row + 1}`
            });
            border.innerHTML+='<div class="head"></div>';
            x.push(x_t);
            y.push(y_t);
        }
    }
    prin(x,y,border);
},200);
function prin(arr_x,arr_y,border)
{
    for(var i=0;i<arr_x.length;i++)
    {
        
        Object.assign(border.children[i+1].style,{
            gridColumn: `${arr_x[i]}/${arr_x[i] + 1}`,
            gridRow: `${arr_y[i]}/${arr_y[i] + 1}`
        });
    }
}
function activ(arr_x,arr_y)
{
    for(var i=arr_x.length-1;i>0;i--)
    {
        arr_x[i]=x[i-1];
        arr_y[i]=y[i-1];
    }
}
function gameover(arr_x,arr_y)
{
    if (arr_x[0]<1||arr_x[0]>49||arr_y[0]<1||arr_y[0]>24) {
        return true;
    }
    for(var i=0;i<arr_x.length;i++)
        for(var j=0;j<i;j++)
    {
        if(arr_x[i]==arr_x[j]&&arr_y[i]==arr_y[j])
            return true;
    }
    return false;
}