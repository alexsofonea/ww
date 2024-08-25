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



