<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" contents="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>New wwProject</title>
    <link rel="stylesheet" href="/assets/font/stylesheet.css">
    <link rel="stylesheet" href="/project/admin/style.css">
    <link rel="stylesheet" href="https://ww.alexsofonea.com/style.css">
    <script src="/assets/lib/jquery.js"></script>
    <script src="/project/admin/setup/script.js?cache=<?php echo time(); ?>"></script>
    <script src="/script.js?cache=<?php echo time(); ?>"></script>
</head>

<body>

    <div class="contents active" id="name">
        <h1>Let's start the name of your business</h1>
        <div class="form">
            <input class="input" placeholder="Enter the name of your business" required="" type="text">
            <span class="input-border"></span>
        </div>
        <br />
        <br />
        <button class="action" onclick="changeContents('niche')">Next</button>
    </div>

    <div class="contents" id="niche">
        <h1>What's your niche?</h1>
        <div class="form">
            <input class="input" placeholder="Enter the niche of your business" required="" type="text">
            <span class="input-border"></span>
        </div>
        <br />
        <br />
        <button class="action" onclick="changeContents('model')">Next</button>
    </div>

    <div class="contents" id="model">
        <h1>What's your business model?</h1>
        <div class="form">
            <div class="version">
                <p onclick="version(this)" data-open="false">Business Model <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg></p>
            
                <p class='v' value='b2b' onclick='select(this);'><img src='/project/admin/assets/icons/increase.svg'> Business to Business</p>
                <p class='v' value='b2c' onclick='select(this);'><img src='/project/admin/assets/icons/user.svg'> Business to Client</p>
                <p class='v' value='np' onclick='select(this);'><img src='/project/admin/assets/icons/star.svg'> Non Profit</p>
            </div>
        </div>
        <br />
        <br />
        <button class="action" onclick="changeContents('tag')">Next</button>
    </div>

    <div class="contents" id="tag">
        <h1>What's your tagline?</h1>
        <div class="form">
            <input class="input" placeholder="Enter the tagline of your business" required="" type="text">
            <span class="input-border"></span>
        </div>
        <br />
        <br />
        <button class="action" onclick="changeContents('audience')">Next</button>
    </div>

    <div class="contents" id="audience">
        <h1>Describe your target audience.</h1>
        <div class="form">
            <input class="input" placeholder="Say a few words about your target audience" required="" type="text">
            <span class="input-border"></span>
        </div>
        <br />
        <br />
        <button class="action" onclick="changeContents('unique')">Next</button>
    </div>

    <div class="contents" id="unique">
        <h1>What makes your business unique?.</h1>
        <div class="form">
            <input class="input" placeholder="Enter some key aspect that makes your business unique" required="" type="text">
            <span class="input-border"></span>
        </div>
        <br />
        <br />
        <button class="action" onclick="location.assign('../analytics/platforms');">Save</button>
    </div>


    <script src="/setup/script.js"></script>

</body>
</html>