<script>
    // replace social link text with SVGs
    var socialLinks = document.querySelectorAll('footer .social-menu-item a');
    for (var i = 0; i < socialLinks.length; i++){
        var el = socialLinks[i];
        var href = el.getAttribute('href');
        if (!href) continue;

        if (href.includes('facebook')){
            el.innerHTML = '<img src="/wp-content/themes/synack/next/static/images/social-fb-dark.svg" aria-label="Facebook logo.">'
        } else if(href.includes('twitter')){
            el.innerHTML = '<img class="twitter" src="/wp-content/themes/synack/next/static/images/social-tw-dark.svg" aria-label="Twitter logo.">'
        } else if(href.includes('linked')){
            el.innerHTML = '<img src="/wp-content/themes/synack/next/static/images/social-li-dark.svg" aria-label="LinkedIn logo.">'
        } else if(href.includes('insta')){
            el.innerHTML = '<img src="/wp-content/themes/synack/next/static/images/social-ig.svg" aria-label="Instagram logo.">'
        } else if(href.includes('slideshare')){
            el.innerHTML = '<img src="/wp-content/themes/synack/next/static/images/social-slideshare.svg" aria-label="Slideshare logo.">'
        }

        // make sure link opens in new window
        el.setAttribute('target', '_blank');
    }

    // office location slideshow
    var offices = document.querySelectorAll('footer .location-wrap .office')
    var index = 0
    function officeSlideshow(){
        for(var i = 0; i < offices.length; i++) {
            var office = offices[i]
            office.classList.remove('current')
        }
        offices[index].classList.add('current')
        index = (index + 1) % offices.length
        setTimeout(officeSlideshow, 4000)
    }
    officeSlideshow()
</script>