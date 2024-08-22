<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>wwProject</title>
    <link rel="stylesheet" href="/assets/font/stylesheet.css">
    <link rel="stylesheet" href="/style.css">
</head>

<?php
    include "../db.php";
    include "../account/accountId.php";
?>

<style>
    body {
        overflow: auto;
    }
    .container {
        display: grid;
        grid-template-columns: calc(70% - 40px) 30%;
        gap: 40px;
        max-width: calc(100% - 120px);
        height: fit-content !important;
    }
    .left-column {
        
    }
    .right-column {
        position: sticky;
        top: 80px;
        align-self: start;
    }
    @media (max-width: 768px) {
        .container {
            grid-template-columns: 1fr;
        }
        .right-column {
            position: relative;
            top: 0;
        }
    }
    .tags {
        max-width: 100%;
        white-space: normal;
        height: fit-content;
    }
    .tags tag {
        background-color: #FFF;
        color: #000;
        padding: 7px 10px;
        border-radius: 50px;
        margin-right: 5px;
        display: inline-block;
        cursor: pointer;
        box-shadow: 2px 2px 6px #b0b0b0,
            -2px -2px 6px #ffffff,
            inset 2px 2px 6px rgba(0, 0, 0, 0.1),
            inset -2px -2px 6px rgba(255, 255, 255, 0.7);
    }
    h1, h2, p {
        margin: 0;
    }
    h2 img {
        width: 40px;
        height: 40px;
        transform: translateY(15px);
    }
    h2:has(img) {
        transform: translateY(-20px);
    }
    .card {
        width: calc(100% - 40px);
        margin-bottom: 20px;
        border-radius: 30px;
    }

    .switch {
        font-size: 17px;
        position: relative;
        display: inline-block;
        width: 3.5em;
        height: 2em;
        user-select: none;
        -webkit-user-select: none;
    }
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #fff;
        border: 1px solid #125973;
        transition: .4s;
        border-radius: 30px;
        z-index: 0 !important;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 1.4em;
        width: 1.4em;
        border-radius: 20px;
        left: 0.27em;
        bottom: 0.25em;
        background-color: #125973;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #1181A9;
        border: 1px solid #1181A9;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #1181A9;
    }

    input:checked + .slider:before {
        transform: translateX(1.4em);
        background-color: #fff;
    }

    .card table {
        width: 100%;
        margin-top: -6px;
    }
    .card table:first-of-type {
        margin-bottom: 20px;
    }
    .card p {
        margin-bottom: 10px;
    }
    .card table tr td:nth-child(2) {
        text-align: right;
    }
    .embed {
        width: calc(100% - 20px);
        height: fit-content;
        background-color: #FFF;
        border-radius: 10px;
        padding: 10px;
    }
    .embed xmp {
        margin: 0;
    }
    p.project {
        font-size: 20px;
        color: #666;
    }
    p.project b {
        color: #000;
    }
    p.project a:not(b a) {
        display: inline;
        font-size: 20px !important;
        color: #666 !important;
        font-weight: 300;
        margin: 0;
    }
    p.project b a {
        display: inline;
        font-size: 20px !important;
        margin: 0;
    }
    p.project img {
        width: 30px;
        height: 30px;
        object-fit: cover;
        border-radius: 30px;
        margin-right: 5px;
        transform: translateY(7px);
    }
    .tabs {
        margin-top: 20px;
        margin-bottom: 20px;
        padding-top: 20px;
        padding-left: 30px;
        padding-bottom: 17px;
        position: static;
        position: -webkit-sticky;
        top: 0px;
        width: calc(100% + 50px);
        transform: translateX(-40px);
        z-index: 9;
    }
    .tabs a {
        display: inline;
        font-size: 30px;
    }
    @supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
        .tabs {
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
        }
    }
</style>

<body>
    <div class="container">
        <div class="left-column">
            <p class="project"><img src="<?php echo $picture; ?>"> <a href="../"><?php echo $name; ?></a> / <b><a href="#"><?php echo $_GET['id']; ?></a></b></p><br />
            <div class="tags">
                <tag>Alex</tag>
                <tag>Alex</tag>
                <tag>Alex</tag>
                <tag>Alex</tag>
                <tag>Alex</tag>
                <tag>Alex</tag>
                <tag>Alex</tag>
                <tag>Alex</tag>
            </div>

            <div class="tabs">
                <a href="" class="active">Capabilities</a>
                <a href="">Settings</a>
                <a href="">Capabilites</a>
            </div>

            <div class="tabGroup">
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwAnalytics</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                

                    <p>Embed the following code in the header of each page you want to be tracked.</p>
                    <div class="embed"><xmp><script src="https://ww.alexsofonea.com/alex/test/analytics/js"></script></xmp></div>

                    <div style="height: 48px;"><a href="#" style="float: right;">Track Analytics</a></div>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwSecure DataBase</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwLiveSocket Server</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwAI Models</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> Custom Domain</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwKit for AppStore</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="tabGroup">
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwAnalytics</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                

                    <p>Embed the following code in the header of each page you want to be tracked.</p>
                    <div class="embed"><xmp><script src="https://ww.alexsofonea.com/alex/test/analytics/js"></script></xmp></div>

                    <div style="height: 48px;"><a href="#" style="float: right;">Track Analytics</a></div>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwSecure DataBase</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwLiveSocket Server</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwAI Models</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> Custom Domain</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwKit for AppStore</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="tabGroup">
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwAnalytics</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                

                    <p>Embed the following code in the header of each page you want to be tracked.</p>
                    <div class="embed"><xmp><script src="https://ww.alexsofonea.com/alex/test/analytics/js"></script></xmp></div>

                    <div style="height: 48px;"><a href="#" style="float: right;">Track Analytics</a></div>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwSecure DataBase</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwLiveSocket Server</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwAI Models</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> Custom Domain</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/ww.png"> wwKit for AppStore</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="right-column">
            <h1>Project Title</h1><br />
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur accusamus itaque unde fugit reprehenderit iste non quidem numquam. Tempore vel in magnam maiores distinctio doloremque ipsam error molestiae nostrum modi.</p>

            <hr />


        </div>
    </div>
</body>

</html>