document.addEventListener("DOMContentLoaded", () => {
    const galleryItems = document.querySelectorAll(".gallery-item");
    const modal = document.querySelector(".modal");
    const modalImage = document.getElementById("modal-image");
    const modalVideo = document.getElementById("modal-video");
    const modalVideoSource = modalVideo.querySelector("source");
    const closeModal = document.querySelector(".close");
    const downloadBtn = document.getElementById("download-btn");
    const searchInput = document.querySelector(".search input");

    // Search functionality
    searchInput.addEventListener("input", () => {
        const searchTerm = searchInput.value.trim().toLowerCase();

        galleryItems.forEach(item => {
            let itemText = "";

            if (item.tagName === "IMG") {
                itemText = item.getAttribute("alt") ? item.getAttribute("alt").toLowerCase() : "";
            } else if (item.tagName === "VIDEO") {
                const source = item.querySelector("source");
                itemText = source ? source.src.toLowerCase().split("/").pop() : ""; // Extract filename
            }

            if (itemText.includes(searchTerm)) {
                item.style.display = "block"; // Show matching items
            } else {
                item.style.display = "none"; // Hide non-matching items
            }
        });
    });

    // Open modal when gallery item is clicked
    galleryItems.forEach(item => {
        item.addEventListener("click", () => {
            const type = item.dataset.type;
            const src = item.tagName === "VIDEO" ? item.querySelector("source").src : item.src;

            if (type === "image") {
                modalImage.src = src;
                modalImage.style.display = "block";
                modalVideo.style.display = "none";
            } else if (type === "video") {
                modalVideoSource.src = src;
                modalVideo.load(); // Reload video source
                modalVideo.style.display = "block";
                modalImage.style.display = "none";
            }

            // Update download button
            downloadBtn.href = src;
            downloadBtn.download = src.split("/").pop(); // Set download filename

            modal.style.display = "flex";
        });

        // Autoplay video on hover
        item.addEventListener("mouseenter", () => {
            if (item.dataset.type === "video") {
                item.play();
            }
        });

        // Pause video when not hovering
        item.addEventListener("mouseleave", () => {
            if (item.dataset.type === "video") {
                item.pause();
                item.currentTime = 0;
            }
        });
    });

    // Close modal
    closeModal.addEventListener("click", () => {
        modal.style.display = "none";
        modalImage.src = "";
        modalVideo.pause();
        modalVideoSource.src = ""; // Reset the video source
    });

    // Close modal on outside click
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
            modalImage.src = "";
            modalVideo.pause();
            modalVideoSource.src = ""; // Reset the video source
        }
    });
});
