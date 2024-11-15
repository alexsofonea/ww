function supportsHEVCAlpha() {
    var navigator = window.navigator;
    var ua = navigator.userAgent.toLowerCase()
    var hasMediaCapabilities = !!(navigator.mediaCapabilities && navigator.mediaCapabilities.decodingInfo)
    var isSafari = ((ua.indexOf('safari') != -1) && (!(ua.indexOf('chrome')!= -1) && (ua.indexOf('version/')!= -1)))
    return isSafari && hasMediaCapabilities
}

var player = document.getElementById('player');
var support = supportsHEVCAlpha();
var src1 = support ? '/project/admin/branding/ai.mov' : '/project/admin/branding/ai.webm';
var src2 = support ? '/project/admin/branding/ai2.mov' : '/project/admin/branding/ai2.webm';
player.src = src1;

var secondVideo = document.createElement('video');
secondVideo.src = src2;
secondVideo.style.display = 'none';
document.body.appendChild(secondVideo);

function showLoading() {
    document.querySelector('.loader').style.display = 'block';
    //if (player.src === src2)
        player.src = src1;
}

function hideLoading() {
    document.querySelector('.loader').style.display = 'none';
    //if (player.src === src1)
        player.src = src2;
}
