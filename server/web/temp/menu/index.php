<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Menu</title>

    <link rel="stylesheet" href="/assets/font/stylesheet.css">
    <link rel="stylesheet" href="/assets/logo-font/stylesheet.css">
</head>

<style>
body {
    margin: 0;
    text-align: center;
    background: #ebebeb;

    font-family: 'Qartella';
    font-style: normal;
}
    .gradient-blur.header {
        position: fixed;
        top: 0;
        z-index: 9;
        top: 0px;
        right: 0px;
        height: 200px;
        transform: rotate(180deg);
    }
    .gradient-blur {
        inset: auto 0 0 0;
        height: 100px;
        pointer-events: none;
    }

    .gradient-blur > div, .gradient-blur::before, .gradient-blur::after {
        position: absolute;
        inset: 0;
    }

    .gradient-blur::before {
        content: "";
        z-index: 1;
        -webkit-backdrop-filter: blur(0.5px);
                backdrop-filter: blur(0.5px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, black 12.5%, black 25%, rgba(0, 0, 0, 0) 37.5%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, black 12.5%, black 25%, rgba(0, 0, 0, 0) 37.5%);
    }

    .gradient-blur > div:nth-of-type(1) {
        z-index: 2;
        -webkit-backdrop-filter: blur(1px);
                backdrop-filter: blur(1px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 12.5%, black 25%, black 37.5%, rgba(0, 0, 0, 0) 50%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 12.5%, black 25%, black 37.5%, rgba(0, 0, 0, 0) 50%);
    }

    .gradient-blur > div:nth-of-type(2) {
        z-index: 3;
        -webkit-backdrop-filter: blur(2px);
                backdrop-filter: blur(2px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 25%, black 37.5%, black 50%, rgba(0, 0, 0, 0) 62.5%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 25%, black 37.5%, black 50%, rgba(0, 0, 0, 0) 62.5%);
    }

    .gradient-blur > div:nth-of-type(3) {
        z-index: 4;
        -webkit-backdrop-filter: blur(4px);
                backdrop-filter: blur(4px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 37.5%, black 50%, black 62.5%, rgba(0, 0, 0, 0) 75%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 37.5%, black 50%, black 62.5%, rgba(0, 0, 0, 0) 75%);
    }

    .gradient-blur > div:nth-of-type(4) {
        z-index: 5;
        -webkit-backdrop-filter: blur(8px);
                backdrop-filter: blur(8px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 50%, black 62.5%, black 75%, rgba(0, 0, 0, 0) 87.5%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 50%, black 62.5%, black 75%, rgba(0, 0, 0, 0) 87.5%);
    }

    .gradient-blur > div:nth-of-type(5) {
        z-index: 6;
        -webkit-backdrop-filter: blur(16px);
                backdrop-filter: blur(16px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 62.5%, black 75%, black 87.5%, rgba(0, 0, 0, 0) 100%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 62.5%, black 75%, black 87.5%, rgba(0, 0, 0, 0) 100%);
    }

    .gradient-blur > div:nth-of-type(6) {
        z-index: 7;
        -webkit-backdrop-filter: blur(32px);
                backdrop-filter: blur(32px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 75%, black 87.5%, black 100%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 75%, black 87.5%, black 100%);
    }

    .gradient-blur::after {
        content: "";
        z-index: 8;
        -webkit-backdrop-filter: blur(64px);
                backdrop-filter: blur(64px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 87.5%, black 100%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 87.5%, black 100%);
    }
.content {
    padding: 100px;
    padding-bottom: 0;
    text-align: center;
}
.element {
    width: calc(50% - 18px);
    height: 200px;
    position: relative;
    overflow: hidden;
    border-radius: 40px;
    display: inline-block;
    margin: 15px;
}
.element:nth-child(2n) {
    margin-left: 0;
}
.element:nth-child(2n + 1) {
    margin-right: 0;
}
.element img.background {
    position: absolute;
    top: calc(-50%);
    left: calc(-50%);
    filter: blur(50px) brightness(0.9);
    width: 1200px;
    z-index: 1;
}
.element img.main {
    position: absolute;
    top: 20px;
    left: 20px;
    width: calc(50% - 20px);
    height: calc(100% - 40px);
    object-fit: cover;
    z-index: 2;
    border-radius: 20px;
}
.element h4, .element p, .element id, .element price {
    position: absolute;
    z-index: 3;
    color: #FFF;
    margin: 0;
}
.element h4 {
    top: 20px;
    font-size: 20px;
    left: calc(50% + 20px);
}
.element p {
    top: 50px;
    font-size: 14px;
    left: calc(50% + 20px);
    text-align: left;
    width: calc(50% - 40px);

    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
.element price {
    bottom: 20px;
    font-size: 30px;
    right: 20px;
}
.element price font {
    font-size: 15px;
    filter: brightness(0.9);
}
.element id {
    bottom: 20px;
    font-size: 16px;
    left: calc(50% + 20px);
    background-color: rgba(0, 0, 0, 0.6);
    width: 40px;
    height: 40px;
    border-radius: 50px;
    text-align: center;
}
.element id font {
    transform: translateY(-25px) !important;
}
.content h1 {
    text-align: left;
    font-size: 40px;
    position: sticky;
    position: -webkit-sticky;
    top: 20px;
    z-index: 99;
}
#logo {
    position: fixed;
    top: 20px;
    right: 100px;
    width: 40px;
    height: 40px;
    object-fit: contain;
    z-index: 99;
}

@media only screen and (max-width: 1400px) {
    .content {
        padding: 10px;
        padding-top: 30px;
    }
    #logo {
        right: 10px;
    }
}
@media only screen and (max-width: 1000px) {
    .gradient-blur.header {
        height: 100px;
    }
    .content h1 {
        top: 10px;
    }
    .content {
        padding: 40px;
        padding-top: 40px;
    }
    #logo {
        top: 10px;
        right: 40px;
    }
    .element {
        width: 100%;
        margin: 0 !important;
        margin-bottom: 20px !important;
    }
}
@media only screen and (max-width: 500px) {
    .content {
        padding: 10px;
        padding-top: 30px;
    }
    #logo {
        right: 10px;
    }
}
</style>

<body>
    <div class="gradient-blur header">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <img id="logo" src="/assets/demo/logo.png">

    <div class="content">
        <h1>Pizzas</h1>
        <?php for ($i = 0; $i < 20; $i++) { ?>
            <div class="element">
                <img class="main" src="/assets/demo/pizza.jpg">
                <h4>Pizza</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At excepturi odit voluptatem doloribus reprehenderit, expedita magni necessitatibus odio aut facere nostrum ad perferendis ex deleniti.</p>
                <id><font>742</font></id>
                <price>23 <font>.99</font></price>
            </div>
        <?php } ?>
    </div>
    <div class="content">
        <h1>Pizzas</h1>
        <?php for ($i = 0; $i < 20; $i++) { ?>
            <div class="element">
                <img class="main" src="/assets/demo/pizza.jpg">
                <h4>Pizza</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At excepturi odit voluptatem doloribus reprehenderit, expedita magni necessitatibus odio aut facere nostrum ad perferendis ex deleniti.</p>
                <id><font>742</font></id>
                <price>23 <font>.99</font></price>
            </div>
        <?php } ?>
    </div>
</body>

<script>
    function getRandomColorsFromImage(img, numColors) {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(img, img.width / 4, img.height / 4, img.width * 0.75, img.height * 0.75);
        const colors = [];
        for (let i = 0; i < numColors; i++) {
            const x = Math.floor(Math.random() * img.width);
            const y = Math.floor(Math.random() * img.height);
            const pixel = ctx.getImageData(x, y, 1, 1).data;
            const color = `rgb(${pixel[0]}, ${pixel[1]}, ${pixel[2]})`;
            colors.push(color);
        }
        return colors;
    }

    function applyGradientToDiv(div, colors) {
        const gradient = `linear-gradient(45deg, ${colors[0]}, ${colors[1]}),linear-gradient(142deg, transparent, ${colors[2]}),linear-gradient(108deg, ${colors[3]}, transparent)`;
        div.style.background = gradient;
    }

    document.addEventListener('DOMContentLoaded', () => {
        const divs = document.querySelectorAll('.element');
        divs.forEach(div => {
            const img = div.querySelector('img');
            img.addEventListener('load', () => {
                const colors = getRandomColorsFromImage(img, 4);
                applyGradientToDiv(div, colors);
            });
            // If image is cached and already loaded
            if (img.complete) {
                const colors = getRandomColorsFromImage(img, 4);
                applyGradientToDiv(div, colors);
            }
        });
    });
</script>


</html>