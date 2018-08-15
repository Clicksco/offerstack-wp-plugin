document.addEventListener("DOMContentLoaded", function(){
    if(document.getElementsByClassName("offers-page__wrap")) {
        var pageWrapper = document.getElementsByClassName("offers-page__wrap");
        var pageHeader = document.getElementsByClassName("page-header");

        var headerHeading = document.getElementsByClassName("heading");
        var headerImage = document.getElementsByClassName("header-image");
        var headerLinkTabs = document.getElementsByClassName("tab-link");

        //update color
        if(pageHeader[0].style.backgroundColor) {
            var dealBtns = document.getElementsByClassName("deal-btn");
            for (var i = 0; i < dealBtns.length; i++) {
                dealBtns[i].style.background = pageHeader[0].style.backgroundColor;
                document.getElementsByClassName("detail-title")[i].style.color = pageHeader[0].style.backgroundColor;
                document.getElementsByClassName("ribbon")[i].style.background = pageHeader[0].style.backgroundColor;
            }
        }

        if (headerHeading[0] != undefined) {
            pageWrapper[0].classList.add("header-heading-padding");
        }
        if (headerImage[0] != undefined) {
            pageWrapper[0].classList.add("header-image-padding");
        }
        if (headerLinkTabs[0] != undefined) {
            pageWrapper[0].classList.add("header-tab-link-padding");

            for (var i = 0; i < headerLinkTabs.length; i++) {
                headerLinkTabs[i].style.background = pageHeader[0].style.backgroundColor;
            }

        }
    }
});