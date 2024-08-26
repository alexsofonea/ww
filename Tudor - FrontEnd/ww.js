function wwDesignButtons () {
    for (const button of document.getElementsByTagName("wwDesign-button")) {
        switch (button.classList[0]) {
            case "style-1":
                wwDesignButton1(button);
                break;
            case "style-2":
                wwDesignButton2(button);
                break;
            case "style-3":
                wwDesignButton3(button);
                break;
            case "style-4":
                wwDesignButton4(button);
                break;
            case "style-5":
                wwDesignButton5(button);
                break
            case "style-6":
                wwDesignButton6(button);
                break;
            case "style-7":
                wwDesignButton7(button);
                break;
            case "style-8":
                wwDesignButton8(button);
                break;
            case "style-9":
                wwDesignButton9(button);
                break;
            case "style-10":
                wwDesignButton10(button);
                break;
            case "style-11":
                wwDesignButton11(button);
                break;
            case "style-12":
                wwDesignButton12(button);
                break;
            case "style-13":
                wwDesignButton13(button);
                break;
            case "style-14":
                wwDesignButton14(button);
                break;
        }
    }
}




function wwDesignButton1(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(249, 228, 0)"};`)
    button.innerHTML = `${button.innerHTML}`;
}

function wwDesignButton2(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(249, 228, 0)"};`)
    button.innerHTML = `${button.innerHTML}`;
}

function wwDesignButton3(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(249, 228, 0)"}; --second-primary-color: ${button.getAttribute("second-primary-color") ?? "rgb(255, 175, 0)"};`);
    button.innerHTML = `${button.innerHTML}`;
}

function wwDesignButton4(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(249, 228, 0)"};`);
    button.innerHTML = `${button.innerHTML}`;
}

function wwDesignButton5(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(249, 228, 0)"};`);
    button.innerHTML = `${button.innerHTML}`;
}

function wwDesignButton6(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(249, 228, 0)"};`);
    button.innerHTML = `${button.innerHTML}`;
}

function wwDesignButton7(button) {
    button.innerHTML = `${button.innerHTML}`;
}

function wwDesignButton8(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(249, 228, 0)"};`)
    button.innerHTML = `${button.innerHTML}`;
}

function wwDesignButton9(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(249, 228, 0)"};`);
    button.innerHTML = `${button.innerHTML}`;
}

function wwDesignButton10(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(200, 200, 200);"}; --second-primary-color: ${button.getAttribute("second-primary-color") ?? "rgb(145, 144, 144)"};`);
    button.innerHTML = `${button.innerHTML}`;
}

function wwDesignButton11(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(249, 228, 0)"}; --second-primary-color: ${button.getAttribute("second-primary-color") ?? "rgb(255, 175, 0)"};`);
    button.innerHTML = `${button.innerHTML}`;
}

function wwDesignButton12(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(249, 228, 0)"}; --second-primary-color: ${button.getAttribute("second-primary-color") ?? "rgb(255, 175, 0)"};`);
    button.innerHTML = `<span>${button.innerHTML}</span>`;
}

function wwDesignButton13(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(249, 228, 0)"}; --second-primary-color: ${button.getAttribute("second-primary-color") ?? "rgb(255, 175, 0)"};`);
    button.innerHTML = `<span>${button.innerHTML}</span>`;
}

function wwDesignButton14(button) {
    button.setAttribute("style", `--first-primary-color: ${button.getAttribute("first-primary-color") ?? "rgb(255, 0, 0)"}; --second-primary-color: ${button.getAttribute("second-primary-color") ?? "rgb(255, 115, 0)"}; --third-primary-color: ${button.getAttribute("third-primary-color") ?? "rgb(255, 251, 0)"}; --fourth-primary-color: ${button.getAttribute("fourth-primary-color") ?? "rgb(72, 255, 0)"}; --fifth-primary-color: ${button.getAttribute("fifth-primary-color") ?? "rgb(0, 255, 213)"}; --sixth-primary-color: ${button.getAttribute("sixth-primary-color") ?? "rgb(0, 43, 255)"}; --seventh-primary-color: ${button.getAttribute("seventh-primary-color") ?? "rgb(122, 0, 255)"}; --eighth-primary-color: ${button.getAttribute("eighth-primary-color") ?? "rgb(255, 0, 200)"};`);
    button.innerHTML = `${button.innerHTML}`;
}




