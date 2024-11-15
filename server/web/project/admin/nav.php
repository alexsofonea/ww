<?php $link = "/$_GET[user]/$_GET[id]/admin"; ?>
<div class="bar" data-collapse="false">
    <svg id="collapse" onclick="collapse()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
    <img src="/assets/logos/ww.png" id="logo">
    <p>Overview</p>
    <div class="button active" onclick="showSub(this)">
        <img src="/project/admin/assets/icons/statistic.svg">
        <p>Analytics</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
    </div>
    <div class="sub">
        <div class="button" href="<?php echo $link; ?>/analytics/web/">
            <p>Web</p>
        </div>
        <div class="button" href="<?php echo $link; ?>/analytics/apple/">
            <p>iOS</p>
        </div>
        <div class="button" href="<?php echo $link; ?>/analytics/android/">
            <p>Andorid</p>
        </div>
        <div class="button" href="<?php echo $link; ?>/analytics/platforms/">
            <p>All Platforms</p>
        </div>
    </div>
    <div class="button" href="<?php echo $link; ?>/analytics/sales/">
        <img src="/project/admin/assets/icons/increase.svg">
        <p>Sales</p>
    </div>
    <div class="button link" href="<?php echo $link; ?>/setup/">
        <img src="/project/admin/assets/icons/search.svg">
        <p>SEO Setup</p>
    </div>
    <p>Builder</p>
    <div class="button" onclick="showSub(this)">
        <img src="/project/admin/assets/icons/image.svg">
        <p>Website</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
    </div>
    <div class="sub">
        <div class="button" href="<?php echo $link; ?>/builder/website/">
            <p>Editor</p>
        </div>
        <div class="button" href="<?php echo $link; ?>/builder/website/pages/">
            <p>Pages</p>
        </div>
    </div>
    <div class="button" onclick="showSub(this)">
        <img src="/project/admin/assets/icons/pn.svg">
        <p>Platforms</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
    </div>
    <div class="sub">
        <div class="button" href="<?php echo $link; ?>/builder/native/iOS/">
            <p>iOS</p>
        </div>
        <div class="button" href="<?php echo $link; ?>/builder/native/android/">
            <p>Andorid</p>
        </div>
    </div>
    <div class="button" onclick="showSub(this)">
        <img src="/project/admin/assets/icons/data.svg">
        <p>Data</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
    </div>
    <div class="sub">
        <div class="button" onclick="showSub(this)">
            <p>Blog & Updates</p>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
        </div>
        <div class="sub ss">
            <div class="button" href="<?php echo $link; ?>/data/updates/manage/">
                <p>Manager</p>
            </div>
            <div class="button" href="<?php echo $link; ?>/data/updates/post/">
                <p>Post</p>
            </div>
        </div>
        <div class="button" onclick="showSub(this)">
            <p>Mailing List</p>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
        </div>
        <div class="sub ss">
            <div class="button" href="<?php echo $link; ?>/data/mail/builder/">
                <p>Mail Builder</p>
            </div>
            <div class="button" href="<?php echo $link; ?>/data/mail/send/">
                <p>Send</p>
            </div>
        </div>
        <div class="button" href="<?php echo $link; ?>/data/products/">
            <p>Products</p>
        </div>
    </div>
    <div class="button" href="<?php echo $link; ?>/builder/assets/">
        <img src="/project/admin/assets/icons/folder.svg">
        <p>Assets</p>
    </div>
    <div class="button" href="<?php echo $link; ?>/builder/connect/">
        <img src="/project/admin/assets/icons/live.svg">
        <p>Connect</p>
    </div>
    <p>AI Generator</p>
    <div class="button" onclick="showSub(this)">
        <img src="/project/admin/assets/icons/increase.svg">
        <p>Branding Suite</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
    </div>
    <div class="sub">
        <div class="button" href="<?php echo $link; ?>/branding/logo/">
            <p>Logo Generator</p>
        </div>
        <div class="button" href="<?php echo $link; ?>/branding/materials/">
            <p>Promotional Materials</p>
        </div>
        <div class="button" href="<?php echo $link; ?>/branding/post/">
            <p>Posts</p>
        </div>
    </div>
    <!--<div class="button" href="<?php echo $link; ?>/branding/text/">
        <img src="/project/admin/assets/icons/message.svg">
        <p>Text Generator</p>
    </div>-->
    <p>Browse</p>
    <div class="button" href="<?php echo $link; ?>/templates/">
        <img src="/project/admin/assets/icons/template.svg">
        <p>Templates</p>
    </div>

    <br /><br /><br />

    <div class="button link" href="<?php echo "/$_GET[user]/$_GET[id]"; ?>/">
        <img src="/project/admin/assets/icons/html.svg">
        <p>Developer Dashboard</p>
    </div>
</div>