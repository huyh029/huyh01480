var months = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
var oj = [
    ['Thuật toán ứng dụng','TN',2,'06:45-09:15',[28,30,33,35,37],'B1-204',750870,'IT3170'],
['Phát triển ứng dụng cho thiết bị di động ','LT+BT',2,'09:20-11:45',[24,25,26,27,28,29,30,31,33,34,35,36,37,38,39,40,41],'TC-412',157544,'IT4785'],
['Technical Writing and Presentation','LT+BT',2,'12:30-15:50',[24,25,26,27,28,29,30,31,33,34,35,36,37,38,39,40,41],'TC-208',157498,'IT2030'],
['Thiết kế và triển khai mạng IP','LT+BT',3,'07:30-09:10',[24,25,26,27,28,29,30,31,33,34,35,36,37,38,39,40,41],'TC-305',157541,'IT4651'],
['Hệ nhúng','LT+BT',3,'09:20-11:45',[24,25,26,27,28,29,30,31,33,34,35,36,37,38,39,40,41],'TC-307',157539,'IT4210'],
['Nhập môn an toàn thông tin','LT+BT',3,'12:30-15:50',[24,25,26,27,28,29,30,31,33,34,35,36,37,38,39,40,41],'TC-412',157522,'IT4015'],
['Lập trình kĩ thuật','LT+BT',4,'08:25-10:05',[24,25,26,27,28,29,30,31,33,34,35,36,37,38,39,40,41],'TC-204',157490,'IT3040'],
['Thuật toán ứng dụng','LT+BT',4,'10:15-11:45',[24,25,26,27,28,29,30,31,33,34,35,36,37,38,39,40,41],'TC-412',157531,'IT3170'],
['Lập trình kĩ thuật','TN',4,'12:30-15:00',[33,35,37,39,41],'B1-402',750825,'IT3040'],
['Lập trình mạng','LT+BT',6,'06:45-09:10',[24,25,26,27,28,29,30,31,33,34,35,36,37,38,39,40,41],'TC-412',157537,'IT4060'],
['Phân tích và thiết kế hệ thống','LT+BT',6,'15:05-17:30',[24,25,26,27,28,29,30,31,33,34,35,36,37,38,39,40,41],'TC-312',157516,'IT3120'],
['Hệ nhúng','TN',7,'07:30-11:45',[31,34,38],'B1-301',750912,'IT4210'],
['Thiết kế và triển khai mạng IP','TN',7,'12:30-17:30',[31,34,36,38,40],'B1-204',750888,'IT4651'],
]




var haveOj = []
oj.forEach(element => {
    var tmp = element[2];
    element[4].forEach(e=>{
        var date = new Date(2025,1,10);
        date.setDate(date.getDate()+(e-24)*7+(tmp-2));
        haveOj[`n_${date.getDate()}_${date.getMonth()}_${date.getFullYear()}`] = 1;    
    })
});

var now = new Date();
var Month = now.getMonth();
var Year = now.getFullYear();
var index = new Date(); 
setMonthYear(now.getMonth(),now.getFullYear());
setDate(now.getMonth(),now.getFullYear());
setIndex(document.querySelector(`.n_${now.getDate()}_${now.getMonth()}_${now.getFullYear()}`));



function setMonthYear(month,year){
    document.querySelector(".monthYear .content").textContent=`${months[month]}-${year}`;
}


function setIndex(e){
    if(e.textContent=="") return;
    if(document.querySelector(".index")) 
        document.querySelector(".index").classList.remove("index");
    e.classList.add("index");
    if(haveOj[e.classList[0]]==1){
        document.querySelector(".oj").innerHTML = "";
        var countDay = (parseDate(e.classList[0])- (new Date(2025,1,10)))/(1000*60*60*24);
        var countWeek = Math.floor(countDay/7)+24;
        var countDate = countDay%7+2;
        oj.forEach(element => {
            if(countDate == element[2] && element[4].includes(countWeek)){
                document.querySelector(".oj").innerHTML+=`
                <div class="content">
    <div>
    <div class="hour">${element[3]}</div>
    <div class="lop">${element[5]}</div>
    </div>
    <div>
    <div class="ten">${element[0]}</div>
    <div class="loaihinh">${element[1]}</div>
    </div>
    <div>
    <div class="malop">${element[6]}</div>
    <div class="mamon">${element[7]}</div>
    </div>
</div>
                `
            }
        });
    }
    else{
        document.querySelector(".oj").innerHTML = "";
    }
}

function setDate(month,year){
    document.querySelector(".date").innerHTML=""
var date = new Date(year, month, 1);

for(var i=0 ; i<date.getDay() ; i++){
    document.querySelector(".date").innerHTML += `<div></div>`;
}
do{
    
if(haveOj[`n_${date.getDate()}_${month}_${year}`]==1)
    document.querySelector(".date").innerHTML += `<div class="n_${date.getDate()}_${month}_${year} haveOj">${date.getDate()}</div>`;
else
    document.querySelector(".date").innerHTML += `<div class="n_${date.getDate()}_${month}_${year}">${date.getDate()}</div>`;

    date.setDate(date.getDate()+1);
}while(date.getDate()!=1);

if(index.getMonth()==month && index.getFullYear()==year){
    setIndex(document.querySelector(`.n_${index.getDate()}_${index.getMonth()}_${index.getFullYear()}`));
}

Array.from(document.querySelector(".date").children).forEach((e) => {
    e.addEventListener("click", () => {
        setIndex(e); 
        index = parseDate(e.classList[0]);
        
    });
});

}
function parseDate(str) {
    if(!document.querySelector("."+str)) return
    let parts = str.split("_");

    // Lấy ngày, tháng, năm từ mảng kết quả
    let day = parseInt(parts[1], 10);
    let month = parseInt(parts[2], 10); // Tháng trong JS bắt đầu từ 0
    let year = parseInt(parts[3], 10);

    // Trả về đối tượng Date
    return new Date(year, month, day);
}

document.querySelector(".right").addEventListener("click",e=>{
Month++
if(Month > 11) {Month = 0
Year ++ 
}
setMonthYear(Month,Year);
setDate(Month,Year);
})
document.querySelector(".left").addEventListener("click",e=>{
    Month--
    if(Month < 0) {Month = 11
    Year --
    }
    setMonthYear(Month,Year);
    setDate(Month,Year);
    })