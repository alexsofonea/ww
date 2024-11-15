var id, verify;
var curentContents = 0;
function changeContents(c = -1) {
    var contents = document.getElementsByClassName("contents");

    if (typeof c === "string")
        c = [...contents].findIndex(tab => tab.id === c);

    if (curentContents < c && c != -1) {
        console.log(1);
        contents[curentContents].style.transition = `transform 0.4s ease-in-out`;
        contents[c].style.transition = `transform 0.4s ease-in-out`;
        contents[curentContents].style.transform = `translateY(-100%)`;
        contents[c].classList.add("active");
        contents[c].style.transform = `translateY(0%)`;
        for (var i = 0; i < c; i++)
            contents[i].style.transform = `translateY(-100%)`;
        for (var i = c + 1; i < contents.length; i++)
            contents[i].style.transform = `translateY(100%)`;
        setTimeout(function () {
            contents[curentContents].classList.remove("active");
            contents[curentContents].style.transition = `none`;
            contents[c].style.transition = `none`;
            curentContents = c;
        }, 400);
    } else if (curentContents > c && c != -1) {
        console.log(2);
        contents[curentContents].style.transition = `transform 0.4s ease-in-out`;
        contents[c].style.transition = `transform 0.4s ease-in-out`;
        contents[curentContents].style.transform = `translateY(100%)`;
        contents[c].classList.add("active");
        contents[c].style.transform = `translateY(0%)`;
        for (var i = 0; i < c; i++)
            contents[i].style.transform = `translateY(-100%)`;
        for (var i = c + 1; i < contents.length; i++)
            contents[i].style.transform = `translateY(100%)`;
        setTimeout(function () {
            contents[curentContents].classList.remove("active");
            contents[curentContents].style.transition = `none`;
            contents[c].style.transition = `none`;
            curentContents = c;
        }, 400);
    } else if (c == curentContents || c == -1) {
        var curentSlide = contents[curentContents];
        var h = Number(curentSlide.getAttribute("data-h") ?? 0);
        var time = 100;

        curentSlide.style.transition = "transform 0.2s";
        curentSlide.style.transform = `translateY(${-h + 0}px)`;
        curentSlide.style.transform = `translateY(${-h - 30}px)`;
        setTimeout(function () {
            curentSlide.style.transform = `translateY(${-h + 0}px)`;
            setTimeout(function () {
                curentSlide.style.transform = `translateY(${-h + 15}px)`;
                setTimeout(function () {
                    curentSlide.style.transform = `translateY(${-h + 0}px)`;
                    setTimeout(function () {
                        curentSlide.style.transform = `translateY(${-h - 15}px)`;
                        setTimeout(function () {
                            curentSlide.style.transform = `translateY(${-h + 0}px)`;
                            curentSlide.style.transition = "transform 0.4s ease-in-out";
                        }, time);
                    }, time);
                }, time);
            }, time);
        }, time);
    }
}