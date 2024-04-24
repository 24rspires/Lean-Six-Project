const script = document.createElement("script");
script.src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js";

script.onload = async () => {
    $ = jQuery.noConflict();

    const delay = (ms) => new Promise((res) => setTimeout(res, ms)); // promise delay

    // can't map since there isn't a list, so just push as we find more.
    const imageList = [];

    // while there is a next button
    while (
        $(".photo-carousel-icon-wrapper .icon-arrow-right").length ||
        $(".photo-carousel-icon-wrapper .icon-reload").length
        ) {
        // Wait a little to make sure the next image source is loaded. If you get an error, increasing the timeout might help
        await delay(200);
        // Last image, break out of loop
        if ($(".photo-carousel-icon-wrapper .icon-reload").length) {
            break;
        }
        const srcs = $('.hdp-gallery-image-content .image:visible source[type="image/jpeg"]').attr("srcset").split(" ");
        const src = srcs[srcs.length - 2];
        // just in case... let make sure the src is not already in the list.
        if (imageList.indexOf(src) === -1) {
            imageList.push(src);
        }

        // go to the next slide
        $(".photo-carousel-icon-wrapper .icon-arrow-right").parent().click();
    }

    // get all image blobs in parallel first before downloading for proper batching
    Promise.all(imageList.map((i) => fetch(i)))
        .then((responses) => Promise.all(responses.map((res) => res.blob())))
        .then(async (blobs) => {
            for (let i = 0; i < blobs.length; i++) {
                if (i % 10 === 0) {
                    console.log("1 sec delay...");
                    await delay(1000);
                }

                let a = document.createElement("a");
                a.style = "display: none";
                console.log(i);

                let url = window.URL.createObjectURL(blobs[i]);
                a.href = url;
                a.download = i + "";
                document.body.appendChild(a);
                a.click();

                setTimeout(() => {
                    window.URL.revokeObjectURL(url);
                }, 100);
            }
        });
};

document.getElementsByTagName("head")[0].appendChild(script);