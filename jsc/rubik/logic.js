var rubik=document.querySelector(".rubik");
var ob={}
ob[-1]='duoi';
ob[0]='giua';
ob[1]='tren';
for(var i=-1;i<2;i++)
    for(var j=-1;j<2;j++)
        for(var k=-1;k<2;k++)
            add_cube(i,j,k);
function add_cube(x,y,z)
{
    rubik.innerHTML+=`
    <div class="cube x${ob[x]} y${ob[y]} z${ob[z]}" >
        <div class="face red font"></div>
        <div class="face orange back"></div>
        <div class="face blue right"></div>
        <div class="face green left"></div>
        <div class="face yellow top"></div>
        <div class="face white bottom"></div>
    </div>
    `;
}
 var rotate_rubik_x=-27;
 var rotate_rubik_y=42;
document.addEventListener("keydown",e=>{

    switch(e.key)
    {
        case 'w':
            rotate_rubik_x-=3;
            break;
        case 'd':
            rotate_rubik_y+=3
            break;
        case 's':
            rotate_rubik_x+=3
            break;
        case 'a':
            rotate_rubik_y-=3
            break;
        case 'x':
            x_rotate();
            break
        case 'y':
                y_rotate();
                break
        case 'z':
            z_rotate()
            break
    }
    rubik.style.transform=`rotateX(${rotate_rubik_x}deg) rotateY(${rotate_rubik_y}deg)`;
    if(document.querySelector(".control"))
    {
        if(e.key!=isNaN&&e.key>0&&e.key<4)
        {
            var index=document.querySelector(".control").classList[e.key];
            document.querySelectorAll("."+index).forEach(element=>{
                switch(e.key)
                {
                    case 1:
                        brea
                    case 2:
                    case 3:
                }    
            })
        }
    }
})

document.querySelectorAll(".cube").forEach(e=>{
    e.addEventListener("click",()=>{
        if(e!=document.querySelector(".control"))
        {
        if(document.querySelector(".control")) document.querySelector(".control").classList.remove("control");
        e.classList.add("control");
        }
        else document.querySelector(".control").classList.remove("control");
    })
})
ob['font']=0;
ob['back']=1;
ob['right']=2;
ob['left']=3;
ob['top']=4;
ob['bottom']=5;
function x_rotate()
{
    var x = document.querySelector(".control").classList[1];
    var x1 = document.querySelector("."+x+".ytren.ztren")
    var x2 = document.querySelector("."+x+".yduoi.ztren")
    var x3 = document.querySelector("."+x+".yduoi.zduoi")
    var x4 = document.querySelector("."+x+".ytren.zduoi")
    x1.classList.replace(x1.classList[2],"yduoi")
    x2.classList.replace(x2.classList[3],"zduoi")
    x3.classList.replace(x3.classList[2],"ytren")
    x4.classList.replace(x4.classList[3],"ztren")
    Array.from([x1, x2, x3, x4]).forEach(el => {
        x_rotate_cube(el);
    });
    var x1 = document.querySelector("."+x+".ygiua.ztren");
var x2 = document.querySelector("."+x+".yduoi.zgiua");
var x3 = document.querySelector("."+x+".ygiua.zduoi");
var x4 = document.querySelector("."+x+".ytren.zgiua");

// Sử dụng classList.replace để thay thế các lớp
x1.classList.replace(x1.classList[2], "yduoi");
x1.classList.replace(x1.classList[3], "zgiua");

x2.classList.replace(x2.classList[2], "ygiua");
x2.classList.replace(x2.classList[3], "zduoi");

x3.classList.replace(x3.classList[2], "ytren");
x3.classList.replace(x3.classList[3], "zgiua");

x4.classList.replace(x4.classList[2], "ygiua");
x4.classList.replace(x4.classList[3], "ztren");

    Array.from([x1, x2, x3, x4]).forEach(el => {
        x_rotate_cube(el);
    });
}
function y_rotate(e)
{
    var x = document.querySelector(".control").classList[2];
    var x1 = document.querySelector("."+x+".xtren.ztren")
    var x2 = document.querySelector("."+x+".xduoi.ztren")
    var x3 = document.querySelector("."+x+".xduoi.zduoi")
    var x4 = document.querySelector("."+x+".xtren.zduoi")
    x1.classList.replace(x1.classList[1],"xduoi")
    x2.classList.replace(x2.classList[3],"zduoi")
    x3.classList.replace(x3.classList[1],"xtren")
    x4.classList.replace(x4.classList[3],"ztren")
    Array.from([x1, x2, x3, x4]).forEach(el => {
        y_rotate_cube(el);
    });
    var x1 = document.querySelector("."+x+".xgiua.ztren");
var x2 = document.querySelector("."+x+".xduoi.zgiua");
var x3 = document.querySelector("."+x+".xgiua.zduoi");
var x4 = document.querySelector("."+x+".xtren.zgiua");

// Sử dụng classList.replace để thay thế các lớp
x1.classList.replace(x1.classList[1], "xduoi");
x1.classList.replace(x1.classList[3], "zgiua");

x2.classList.replace(x2.classList[1], "xgiua");
x2.classList.replace(x2.classList[3], "zduoi");

x3.classList.replace(x3.classList[1], "xtren");
x3.classList.replace(x3.classList[3], "zgiua");

x4.classList.replace(x4.classList[1], "xgiua");
x4.classList.replace(x4.classList[3], "ztren");

    Array.from([x1, x2, x3, x4]).forEach(el => {
        y_rotate_cube(el);
    });
}
function z_rotate(e)
{
    var x = document.querySelector(".control").classList[3];
    var x1 = document.querySelector("."+x+".xtren.ytren")
    var x2 = document.querySelector("."+x+".xduoi.ytren")
    var x3 = document.querySelector("."+x+".xduoi.yduoi")
    var x4 = document.querySelector("."+x+".xtren.yduoi")
    x1.classList.replace(x1.classList[1],"xduoi")
    x2.classList.replace(x2.classList[2],"yduoi")
    x3.classList.replace(x3.classList[1],"xtren")
    x4.classList.replace(x4.classList[2],"ytren")
    Array.from([x1, x2, x3, x4]).forEach(el => {
        z_rotate_cube(el);
    });
    var x1 = document.querySelector("."+x+".xgiua.ytren");
var x2 = document.querySelector("."+x+".xduoi.ygiua");
var x3 = document.querySelector("."+x+".xgiua.yduoi");
var x4 = document.querySelector("."+x+".xtren.ygiua");

// Sử dụng classList.replace để thay thế các lớp
x1.classList.replace(x1.classList[1], "xduoi");
x1.classList.replace(x1.classList[2], "ygiua");

x2.classList.replace(x2.classList[1], "xgiua");
x2.classList.replace(x2.classList[2], "yduoi");

x3.classList.replace(x3.classList[1], "xtren");
x3.classList.replace(x3.classList[2], "ygiua");

x4.classList.replace(x4.classList[1], "xgiua");
x4.classList.replace(x4.classList[2], "ytren");

    Array.from([x1, x2, x3, x4]).forEach(el => {
        z_rotate_cube(el);
    });
}
function x_rotate_cube(e) {
    let className = e.children[0].classList[1];  // Lưu class thứ 2
e.children[0].classList.replace(e.children[0].classList[1], e.children[5].classList[1]);
e.children[5].classList.replace(e.children[5].classList[1], e.children[1].classList[1]);
e.children[1].classList.replace(e.children[1].classList[1], e.children[4].classList[1]);
e.children[4].classList.replace(e.children[4].classList[1], className);
}
function y_rotate_cube(e) {
    let className = e.children[0].classList[1];  // Lưu class thứ 2
e.children[0].classList.replace(e.children[0].classList[1], e.children[2].classList[1]);
e.children[2].classList.replace(e.children[2].classList[1], e.children[1].classList[1]);
e.children[1].classList.replace(e.children[1].classList[1], e.children[3].classList[1]);
e.children[3].classList.replace(e.children[3].classList[1], className);
}
function z_rotate_cube(e) {
    //3 4 2 5
    let className = e.children[3].classList[1];  // Lưu class thứ 2
e.children[3].classList.replace(e.children[3].classList[1], e.children[4].classList[1]);
e.children[4].classList.replace(e.children[4].classList[1], e.children[2].classList[1]);
e.children[2].classList.replace(e.children[2].classList[1], e.children[5].classList[1]);
e.children[5].classList.replace(e.children[5].classList[1], className);
}
