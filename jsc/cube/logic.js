const cube = document.querySelector('.rubik');
let rotateX = 0;
let rotateY = 0;

// Thêm các khối cube với các lớp xtren, ytren, ztren
for (let x = -1; x <= 1; x++) {
    for (let y = -1; y <= 1; y++) {
        for (let z = -1; z <= 1; z++) {
            const xClass = x === 1 ? 'xtren' : (x === -1 ? 'xduoi' : 'xgiua');
            const yClass = y === 1 ? 'ytren' : (y === -1 ? 'yduoi' : 'ygiua');
            const zClass = z === 1 ? 'ztren' : (z === -1 ? 'zduoi' : 'zgiua');
            add_div(xClass, yClass, zClass);
        }
    }
}

function add_div(xClass, yClass, zClass) {
    const div = document.createElement('div');
    div.classList.add('cube', xClass, yClass, zClass);
    div.style.transform = `translateX(${xClass === 'xtren' ? 100 : (xClass === 'xduoi' ? -100 : 0)}px) 
                           translateY(${yClass === 'ytren' ? 100 : (yClass === 'yduoi' ? -100 : 0)}px) 
                           translateZ(${zClass === 'ztren' ? 100 : (zClass === 'zduoi' ? -100 : 0)}px)`;

    div.innerHTML = `
        <div class="face front"></div>
        <div class="face back"></div>
        <div class="face right"></div>
        <div class="face left"></div>
        <div class="face top"></div>
        <div class="face bottom"></div>
    `;

    cube.appendChild(div);
}

function updateCubeTransform() {
    cube.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
}

// Xử lý sự kiện nút
document.getElementById('rotateX').addEventListener('click', () => {
    rotateX += 90;
    updateCubeTransform();
});

document.getElementById('rotateY').addEventListener('click', () => {
    rotateY += 90;
    updateCubeTransform();
});

// Xử lý sự kiện phím
document.addEventListener("keydown", e => {
    switch (e.key) {
        case 'w':
            rotateX += 3;
            updateCubeTransform();
            break;
        case 's':
            rotateX -= 3;
            updateCubeTransform();
            break;
        case 'a':
            rotateY -= 3;
            updateCubeTransform();
            break;
        case 'd':
            rotateY += 3;
            updateCubeTransform();
            break;
    }
});

document.querySelectorAll(".cube").forEach(cube => {
    cube.addEventListener("click", (event) => {
        // Ngăn sự kiện click lan truyền lên cha
        event.stopPropagation();

        // Xóa lớp control khỏi các cube khác
        document.querySelectorAll(".cube").forEach(c => {
            c.classList.remove("control");
        });

        // Nếu khối được click đã có lớp control, xóa lớp control
        if (cube.classList.contains("control")) {
            cube.classList.remove("control");
        } else {
            // Thêm lớp control vào khối đã click
            cube.classList.add("control");
        }
    });
});

// Xóa lớp control khi click ra ngoài khối Rubik
document.body.addEventListener("click", () => {
    document.querySelectorAll(".cube").forEach(c => {
        c.classList.remove("control");
    });
});

document.addEventListener("keydown", e => {
    const controlledCube = document.querySelector(".control");
    if (controlledCube) {
        let index;
        
        // Kiểm tra lớp và xác định lớp tương ứng với key
        if (e.key === '1') {
            index = controlledCube.classList.contains("xgiua") ? "xgiua" :
                    controlledCube.classList.contains("xtren") ? "xtren" : "xduoi";
            rotateCubes("x", index);
        } else if (e.key === '2') {
            index = controlledCube.classList.contains("ygiua") ? "ygiua" :
                    controlledCube.classList.contains("ytren") ? "ytren" : "yduoi";
            rotateCubes("y", index);
        } else if (e.key === '3') {
            index = controlledCube.classList.contains("zgiua") ? "zgiua" :
                    controlledCube.classList.contains("ztren") ? "ztren" : "zduoi";
            rotateCubes("z", index);
        }
    }
});

function rotateCubes(axis, className) {
    document.querySelectorAll(`.${className}`).forEach(cube => {
        let rotation = axis === "x" ? "rotateX(90deg)" :
                       axis === "y" ? "rotateY(90deg)" : "rotateZ(90deg)";

        // Xoay cube
        cube.style.transition = 'transform 0.5s';
        cube.style.transform += ` ${rotation}`;
    });
}
