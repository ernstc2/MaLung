document.addEventListener('DOMContentLoaded', function() {
    let colls = document.querySelectorAll(".collapsible-btn");
    colls.forEach(function(coll) {
        coll.addEventListener("click", function() {
            this.classList.toggle("active");
            let content = this.nextElementSibling;
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    });
});
