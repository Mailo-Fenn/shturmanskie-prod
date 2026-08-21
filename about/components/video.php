<video class="story-video__item" controls autoplay playsinline poster="/images/video-holder.jpg">
    <source src="/images/Final_comp.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myVideo = document.querySelector(".story-video__item");
        if (myVideo) {
            myVideo.muted = true;
            myVideo.play();
        }
    });
</script>