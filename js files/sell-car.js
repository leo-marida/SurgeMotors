document.addEventListener("DOMContentLoaded", function () {

    const userId = localStorage.getItem('user_id');
    if (userId) {
        document.getElementById('userIdInput').value = userId;
    }


    document.getElementById('signOutBtn')?.addEventListener('click', function () {
        localStorage.removeItem('user_id');
        localStorage.clear();
    
        window.location.href = 'index.html';
    });

    
    document.getElementById('signOutBtn2')?.addEventListener('click', function () {
        localStorage.removeItem('user_id');
        localStorage.clear();
    
        window.location.href = 'index.html';
    });
    

    const form = document.getElementById("sell-car-form");
    const imageInput = document.getElementById("images");
    const imagePreview = document.getElementById("image-preview");

    // Preview uploaded images
    imageInput.addEventListener("change", function () {
        imagePreview.innerHTML = ""; // Clear previous images

        for (let file of this.files) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let img = document.createElement("img");
                img.src = e.target.result;
                imagePreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

});
