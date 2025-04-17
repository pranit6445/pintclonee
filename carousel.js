/*document.addEventListener("DOMContentLoaded", () => {
    const carousel = document.querySelector(".carousel");
    const images = document.querySelectorAll(".carousel-image");
    const leftArrow = document.getElementById("left-arrow");
    const rightArrow = document.getElementById("right-arrow");

    let currentIndex = 0;

    const updateCarousel = () => {
        images.forEach((image, index) => {
            image.style.display = index === currentIndex ? "block" : "none";
        });
    };

    leftArrow.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateCarousel();
    });

    rightArrow.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateCarousel();
    });

    // Initialize carousel
    updateCarousel();
});*/
document.addEventListener("DOMContentLoaded", () => {
    const videos = document.querySelectorAll(".carousel-video");
    const leftArrow = document.getElementById("left-arrow");
    const rightArrow = document.getElementById("right-arrow");

    let currentIndex = 0;

    const updateCarousel = () => {
        videos.forEach((video, index) => {
            if (index === currentIndex) {
                video.style.display = "block";
                video.play(); // Play the current video
                video.loop = true; // Ensure it loops continuously
            } else {
                video.style.display = "none";
                video.pause(); // Pause other videos
                video.currentTime = 0; // Reset other videos
            }
        });
    };

    leftArrow.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + videos.length) % videos.length;
        updateCarousel();
    });

    rightArrow.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % videos.length;
        updateCarousel();
    });

    // Initialize carousel
    updateCarousel();
});