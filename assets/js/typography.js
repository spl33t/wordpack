if(document.querySelectorAll('.page-content a').length !== 0) {
    document.querySelectorAll('.page-content a').forEach(link => {
        if(isExternalLink(link.href)) {
            link.innerHTML = link.innerHTML + '<span> &#8599;</span>'
            link.classList.add('is-external-link')
        }
    })
}


function isExternalLink (url) {
    const tmp = document.createElement('a');
    tmp.href = url;
    return tmp.host !== window.location.host;
};