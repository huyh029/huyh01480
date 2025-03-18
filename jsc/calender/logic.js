var view_month=-1;
var view_year=-1;

var view=document.querySelector('.content');

var right=document.querySelector('.next');
var left=document.querySelector('.prev');
var today=new Date();
    t_day=today.getDate();
    t_month=today.getMonth();
    t_year=today.getFullYear();
    if(view_month==-1) {view_month=t_month; view_year=t_year;}
   
    print_month(view_month,view_year);
    right.onclick=function()
    {
        view_month++;
        if(view_month==12)
        {
            view_month=0;
            view_year++;
        }
        print_month(view_month,view_year);
    }
    left.onclick=function()
    {
        view_month--;
        if(view_month==-1)
        {
            view_month=11;
            view_year--;
        }
        print_month(view_month,view_year);
    }
function print_month(month,year)
{
    var name_month=[
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];
    var Month=document.querySelector('.month_content');
    var today=new Date();
    view.textContent="";
    var date=new Date(year,month,1);
    var day=date.getDay();
        var startDay = 1;
        Month.textContent=name_month[month]+" "+year; 
        for(var i=0;i<day;i++) view.innerHTML+='<div></div>';
        do {
           if((date.getDate()!=today.getDate())||(date.getMonth()!=today.getMonth())||(date.getFullYear()!=today.getFullYear()))  view.insertAdjacentHTML('beforeend', '<div class="DATE">' + date.getDate() + '</div>');
           else view.insertAdjacentHTML('beforeend', '<div class="TODAY">' + date.getDate() + '</div>');
            date.setDate(date.getDate() + 1);
        } while (date.getDate() !== startDay);
}