var container=document.querySelector(".container");
var bonhotam;
var degree={};
    degree['♟']=[1,1];
    degree['♜']=[2,1]
    degree['♞']=[3,1]
    degree['♝']=[4,1]
    degree['♛']=[5,1]
    degree['♚']=[6,1]
    degree['♙']=[1,2]
    degree['♖']=[2,2]
    degree['♘']=[3,2]
    degree['♗']=[4,2]
    degree['♕']=[5,2]
    degree['♔']=[6,2]
// var el=[
//     ['♖','♘','♗','♕','♔','♗','♘','♖'],
//     ['♙','♙','♙','♙','♙','♙','♙','♙'],
//     [0,0,0,0,0,0,0,0],
//     [0,0,0,0,0,0,0,0],
//     [0,0,0,0,0,0,0,0],
//     [0,0,0,0,0,0,0,0],
//     ['♟','♟','♟','♟','♟','♟','♟','♟'],
//     ['♜','♞','♝','♛','♚','♝','♞','♜']
// ]
// var lv=[
//     [2,3,4,5,6,4,3,2],
//     [1,1,1,1,1,1,1,1],
//     [0,0,0,0,0,0,0,0],
//     [0,0,0,0,0,0,0,0],
//     [0,0,0,0,0,0,0,0],
//     [0,0,0,0,0,0,0,0],
//     [1,1,1,1,1,1,1,1],
//     [2,3,4,5,6,4,3,2]
// ]
// var bw=[
//     [2,2,2,2,2,2,2,2],
//     [2,2,2,2,2,2,2,2],
//     [0,0,0,0,0,0,0,0],
//     [0,0,0,0,0,0,0,0],
//     [0,0,0,0,0,0,0,0],
//     [0,0,0,0,0,0,0,0],
//     [1,1,1,1,1,1,1,1],
//     [1,1,1,1,1,1,1,1]
// ]
for(var i=0;i<8;i++)
for(var j=0;j<8;j++)
    if((i+j)%2==0)
        container.innerHTML+='<div class="black"></div>';
    else
        container.innerHTML+='<div class="white"></div>';
var child=document.querySelectorAll(".container > div");
container.children[0].textContent='♖';
container.children[7].textContent='♖';

container.children[1].textContent='♘';
container.children[6].textContent='♘';

container.children[2].textContent='♗';
container.children[5].textContent='♗';

container.children[3].textContent='♕';
container.children[4].textContent='♔';

for(var i=8;i<16;i++) container.children[i].textContent='♙';

container.children[56].textContent='♜';
container.children[63].textContent='♜';

container.children[57].textContent='♞';
container.children[62].textContent='♞';

container.children[58].textContent='♝';
container.children[61].textContent='♝';

container.children[59].textContent='♛';
container.children[60].textContent='♚';

for(var i=48;i<56;i++) container.children[i].textContent='♟';

child.forEach(element => {
    element.addEventListener('click', () => {
    if(element.classList[1]=='cbi')
    {
        element.textContent=document.querySelector(".control").textContent;
        document.querySelector(".control").textContent='';
        document.querySelector(".control").classList.remove('control');
        huy_cbi();
        phong();
    }
    else
    {
        if(element.textContent!='')
        {
            if(document.querySelector(".control"))
            {
                if(document.querySelector(".control")!==element)
                {
                    if(degree[document.querySelector(".control").textContent][1]==degree[element.textContent][1])
                    {
                        document.querySelector(".control").classList.remove('control');
                        huy_cbi();
                        element.classList.add('control');
                        cbi(element);
                    }
                }
                else
                {
                    document.querySelector(".control").classList.remove('control');
                    huy_cbi();
                }
            }
            else
            {
                element.classList.add('control');
                cbi(element);
            }
        }
        else
        {
            if(document.querySelector(".control"))
                document.querySelector(".control").classList.remove('control');
                huy_cbi();
        }
    }
    });
});
function search(Ele)
{
    for(var i=0;i<64;i++) if(child[i]===Ele) return i;
}
function huy_cbi()
{
    if(document.querySelector(".cbi"))
    {
        document.querySelectorAll(".cbi").forEach(e=>{
            e.classList.remove('cbi');
        })
    }
}
function cbi(ele)
{
    var Index=search(ele);
    var row=Math.floor(Index/8);
    var col=Index%8;
    var key=ele.textContent;
    
    switch(degree[key][0])
    {
        case 2:
        var cop_col_tien=col;
        var cop_row_tien=row;
        var cop_col_lui=col;
        var cop_row_lui=row;
        while(cop_row_tien<7)
        {
            cop_row_tien++;
            if(child[cop_row_tien*8+col].textContent!='') 
            {
            if(degree[child[cop_row_tien*8+col].textContent][1]!=degree[child[Index].textContent][1])
                child[cop_row_tien*8+col].classList.add('cbi');
            break;
            }
            child[cop_row_tien*8+col].classList.add('cbi');
        }
        while(cop_row_lui>0)
        {
            cop_row_lui--;
            if(child[cop_row_lui*8+col].textContent!='') 
            {
                if(degree[child[cop_row_lui*8+col].textContent][1]!=degree[child[Index].textContent][1])
                    child[cop_row_lui*8+col].classList.add('cbi');
                break;
            }
            child[cop_row_lui*8+col].classList.add('cbi');
        }
        while(cop_col_tien<7)
        {
            cop_col_tien++;
            if(child[row*8+cop_col_tien].textContent!='') 
            {
                if(degree[child[row*8+cop_col_tien].textContent][1]!=degree[child[Index].textContent][1])
                    child[row*8+cop_col_tien].classList.add('cbi');
                break;
            }
            child[row*8+cop_col_tien].classList.add('cbi');
        }
        while(cop_col_lui>0)
        {
            cop_col_lui--;
            if(child[row*8+cop_col_lui].textContent!='') 
            {
                if(degree[child[row*8+cop_col_lui].textContent][1]!=degree[child[Index].textContent][1])
                    child[row*8+cop_col_lui].classList.add('cbi');
                break;
            }
            child[row*8+cop_col_lui].classList.add('cbi');
        }
        break;
        case 3:
        var i=1,j=2;    
        if((col+i)>=0&&(col+i)<8&&(row+j)>=0&&(row+j)<8&&(child[(col+i)+(row+j)*8].textContent==''||degree[child[(col+i)+(row+j)*8].textContent][1]!=degree[child[Index].textContent][1])) child[(col+i)+(row+j)*8].classList.add('cbi');
        i=-1,j=-2;        
        if((col+i)>=0&&(col+i)<8&&(row+j)>=0&&(row+j)<8&&(child[(col+i)+(row+j)*8].textContent==''||degree[child[(col+i)+(row+j)*8].textContent][1]!=degree[child[Index].textContent][1])) child[(col+i)+(row+j)*8].classList.add('cbi');
        i=-1,j=2;        
        if((col+i)>=0&&(col+i)<8&&(row+j)>=0&&(row+j)<8&&(child[(col+i)+(row+j)*8].textContent==''||degree[child[(col+i)+(row+j)*8].textContent][1]!=degree[child[Index].textContent][1])) child[(col+i)+(row+j)*8].classList.add('cbi');
        i=1,j=-2;        
        if((col+i)>=0&&(col+i)<8&&(row+j)>=0&&(row+j)<8&&(child[(col+i)+(row+j)*8].textContent==''||degree[child[(col+i)+(row+j)*8].textContent][1]!=degree[child[Index].textContent][1])) child[(col+i)+(row+j)*8].classList.add('cbi');
        j=1,i=2;        
        if((col+i)>=0&&(col+i)<8&&(row+j)>=0&&(row+j)<8&&(child[(col+i)+(row+j)*8].textContent==''||degree[child[(col+i)+(row+j)*8].textContent][1]!=degree[child[Index].textContent][1])) child[(col+i)+(row+j)*8].classList.add('cbi');
        j=-1,i=-2;        
        if((col+i)>=0&&(col+i)<8&&(row+j)>=0&&(row+j)<8&&(child[(col+i)+(row+j)*8].textContent==''||degree[child[(col+i)+(row+j)*8].textContent][1]!=degree[child[Index].textContent][1])) child[(col+i)+(row+j)*8].classList.add('cbi');
        j=-1,i=2;        
        if((col+i)>=0&&(col+i)<8&&(row+j)>=0&&(row+j)<8&&(child[(col+i)+(row+j)*8].textContent==''||degree[child[(col+i)+(row+j)*8].textContent][1]!=degree[child[Index].textContent][1])) child[(col+i)+(row+j)*8].classList.add('cbi');
        j=1,i=-2;        
        if((col+i)>=0&&(col+i)<8&&(row+j)>=0&&(row+j)<8&&(child[(col+i)+(row+j)*8].textContent==''||degree[child[(col+i)+(row+j)*8].textContent][1]!=degree[child[Index].textContent][1])) child[(col+i)+(row+j)*8].classList.add('cbi');
        break;
        case 4:
        var cop_col=col;
        var cop_row=row;
        while(cop_col+1<8&&cop_row+1<8)
        {
            cop_col++;
            cop_row++;
            if(child[cop_col+cop_row*8].textContent!='')
            {
                if(degree[child[cop_col+cop_row*8].textContent][1]!=degree[ele.textContent][1]) child[cop_col+cop_row*8].classList.add('cbi');
                break;
            }
            child[cop_col+cop_row*8].classList.add('cbi');
        }
        cop_col=col;
        cop_row=row;
        while(cop_col+1<8&&cop_row-1>=0)
        {
            cop_col++;
            cop_row--;
            if(child[cop_col+cop_row*8].textContent!='')
                {
                    if(degree[child[cop_col+cop_row*8].textContent][1]!=degree[ele.textContent][1]) child[cop_col+cop_row*8].classList.add('cbi');
                    break;
                }
            child[cop_col+cop_row*8].classList.add('cbi');
        }
        cop_col=col;
        cop_row=row;
        while(cop_col-1>=0&&cop_row-1>=0)
        {
            cop_col--;
            cop_row--;
            if(child[cop_col+cop_row*8].textContent!='')
                {
                    if(degree[child[cop_col+cop_row*8].textContent][1]!=degree[ele.textContent][1]) child[cop_col+cop_row*8].classList.add('cbi');
                    break;
                }
            child[cop_col+cop_row*8].classList.add('cbi');
        }
        cop_col=col;
        cop_row=row;
        while(cop_col-1>=0&&cop_row+1<8)
        {
            cop_col--;
            cop_row++;
            if(child[cop_col+cop_row*8].textContent!='')
                {
                    if(degree[child[cop_col+cop_row*8].textContent][1]!=degree[ele.textContent][1]) child[cop_col+cop_row*8].classList.add('cbi');
                    break;
                }
            child[cop_col+cop_row*8].classList.add('cbi');
        }
        break;
        case 5:
            var cop_col_tien=col;
        var cop_row_tien=row;
        var cop_col_lui=col;
        var cop_row_lui=row;
        while(cop_row_tien<7)
        {
            cop_row_tien++;
            if(child[cop_row_tien*8+col].textContent!='') 
            {
            if(degree[child[cop_row_tien*8+col].textContent][1]!=degree[child[Index].textContent][1])
                child[cop_row_tien*8+col].classList.add('cbi');
            break;
            }
            child[cop_row_tien*8+col].classList.add('cbi');
        }
        while(cop_row_lui>0)
        {
            cop_row_lui--;
            if(child[cop_row_lui*8+col].textContent!='') 
            {
                if(degree[child[cop_row_lui*8+col].textContent][1]!=degree[child[Index].textContent][1])
                    child[cop_row_lui*8+col].classList.add('cbi');
                break;
            }
            child[cop_row_lui*8+col].classList.add('cbi');
        }
        while(cop_col_tien<7)
        {
            cop_col_tien++;
            if(child[row*8+cop_col_tien].textContent!='') 
            {
                if(degree[child[row*8+cop_col_tien].textContent][1]!=degree[child[Index].textContent][1])
                    child[row*8+cop_col_tien].classList.add('cbi');
                break;
            }
            child[row*8+cop_col_tien].classList.add('cbi');
        }
        while(cop_col_lui>0)
        {
            cop_col_lui--;
            if(child[row*8+cop_col_lui].textContent!='') 
            {
                if(degree[child[row*8+cop_col_lui].textContent][1]!=degree[child[Index].textContent][1])
                    child[row*8+cop_col_lui].classList.add('cbi');
                break;
            }
            child[row*8+cop_col_lui].classList.add('cbi');
        }
        var cop_col=col;
        var cop_row=row;
        while(cop_col+1<8&&cop_row+1<8)
        {
            cop_col++;
            cop_row++;
            if(child[cop_col+cop_row*8].textContent!='')
            {
                if(degree[child[cop_col+cop_row*8].textContent][1]!=degree[ele.textContent][1]) child[cop_col+cop_row*8].classList.add('cbi');
                break;
            }
            child[cop_col+cop_row*8].classList.add('cbi');
        }
        cop_col=col;
        cop_row=row;
        while(cop_col+1<8&&cop_row-1>=0)
        {
            cop_col++;
            cop_row--;
            if(child[cop_col+cop_row*8].textContent!='')
                {
                    if(degree[child[cop_col+cop_row*8].textContent][1]!=degree[ele.textContent][1]) child[cop_col+cop_row*8].classList.add('cbi');
                    break;
                }
            child[cop_col+cop_row*8].classList.add('cbi');
        }
        cop_col=col;
        cop_row=row;
        while(cop_col-1>=0&&cop_row-1>=0)
        {
            cop_col--;
            cop_row--;
            if(child[cop_col+cop_row*8].textContent!='')
                {
                    if(degree[child[cop_col+cop_row*8].textContent][1]!=degree[ele.textContent][1]) child[cop_col+cop_row*8].classList.add('cbi');
                    break;
                }
            child[cop_col+cop_row*8].classList.add('cbi');
        }
        cop_col=col;
        cop_row=row;
        while(cop_col-1>=0&&cop_row+1<8)
        {
            cop_col--;
            cop_row++;
            if(child[cop_col+cop_row*8].textContent!='')
                {
                    if(degree[child[cop_col+cop_row*8].textContent][1]!=degree[ele.textContent][1]) child[cop_col+cop_row*8].classList.add('cbi');
                    break;
                }
            child[cop_col+cop_row*8].classList.add('cbi');
        }
        break;
        case 6:
        if(col+1<8&&row+1<8&&(child[Index+9].textContent==''||degree[child[Index+9].textContent][1]!=degree[ele.textContent][1])) child[Index+9].classList.add('cbi');
        if(col-1>=0&&row+1<8&&(child[Index+7].textContent==''||degree[child[Index+7].textContent][1]!=degree[ele.textContent][1])) child[Index+7].classList.add('cbi');
        if(col+1<8&&row-1>=0&&(child[Index-7].textContent==''||degree[child[Index-7].textContent][1]!=degree[ele.textContent][1])) child[Index-7].classList.add('cbi');
        if(col-1>=0&&row-1>=0&&(child[Index-9].textContent==''||degree[child[Index-9].textContent][1]!=degree[ele.textContent][1])) child[Index-9].classList.add('cbi');
        if(col+1<8&&(child[Index+1].textContent==''||degree[child[Index+1].textContent][1]!=degree[ele.textContent][1])) child[Index+1].classList.add('cbi');
        if(col-1>=0&&(child[Index-1].textContent==''||degree[child[Index-1].textContent][1]!=degree[ele.textContent][1])) child[Index-1].classList.add('cbi');
        if(row+1<8&&(child[Index+8].textContent==''||degree[child[Index+8].textContent][1]!=degree[ele.textContent][1])) child[Index+8].classList.add('cbi');
        if(row-1>=0&&(child[Index-8].textContent==''||degree[child[Index-8].textContent][1]!=degree[ele.textContent][1])) child[Index-8].classList.add('cbi');
        break;
        case 1:
        if(row!=7&&row!=0)
        {
            if(degree[key][1]==1)
            {
                if(row==6&&child[32+col].textContent=='')
                    child[32+col].classList.add('cbi');
                if(child[Index-8].textContent=='') child[Index-8].classList.add('cbi');
                if(col>0&&child[Index-9].textContent!=''&&degree[child[Index-9].textContent][1]!=degree[ele.textContent][1]) child[Index-9].classList.add('cbi');
                if(col<7&&child[Index-7].textContent!=''&&degree[child[Index-7].textContent][1]!=degree[ele.textContent][1]) child[Index-7].classList.add('cbi'); 
            }
            else{
                if(row==1&&child[24+col].textContent=='')
                    child[24+col].classList.add('cbi');
                if(child[Index+8].textContent=='') child[Index+8].classList.add('cbi');
                if(col>0&&child[Index+7].textContent!=''&&degree[child[Index+7].textContent][1]!=degree[ele.textContent][1]) child[Index+7].classList.add('cbi');
                if(col<7&&child[Index+9].textContent!=''&&degree[child[Index+9].textContent][1]!=degree[ele.textContent][1]) child[Index+9].classList.add('cbi');
            }
        }
        break;
    }
}
function phong()
{
    for(var i=0;i<8;i++)
    {
        if(child[i].textContent=='♟')
            {
                var index=i;
                document.querySelector(".phong_den").style.display='block'; 
                document.querySelectorAll(".phong_den > div").forEach(e=>{
                    e.addEventListener("click",()=>
                    {
                        child[index].textContent=e.textContent;
                        document.querySelector(".phong_den").style.display='none';
                    }
                    )
                })
            } 
    }
    for(var i=56;i<64;i++)
        {
            if(child[i].textContent=='♙')
                {
                    var index=i;
                    document.querySelector(".phong_trang").style.display='block'; 
                    document.querySelectorAll(".phong_trang > div").forEach(e=>{
                        e.addEventListener("click",()=>
                        {
                            child[index].textContent=e.textContent;
                            document.querySelector(".phong_trang").style.display='none';
                        }
                        )
                    })
                } 
        }

}