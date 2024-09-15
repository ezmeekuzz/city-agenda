document.addEventListener("DOMContentLoaded", function() {
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.querySelector('.sidebar');

    toggleBtn.addEventListener('click', function() {
        // Toggle the sidebar visibility
        sidebar.classList.toggle('sidebar-hidden');
        toggleBtn.classList.toggle('toggle-btn-hidden');
    });
});


//pagination
document.addEventListener("DOMContentLoaded", function() {
    const page1Rows = document.querySelectorAll(".page-1");
    const page2Rows = document.querySelectorAll(".page-2");
    const page1Btn = document.getElementById("page-1-btn");
    const page2Btn = document.getElementById("page-2-btn");
    const prevPage = document.getElementById("prev-page");
    const nextPage = document.getElementById("next-page");

    function showPage(page) {
        if (page === 1) {
            page1Rows.forEach(row => row.classList.remove("d-none"));
            page2Rows.forEach(row => row.classList.add("d-none"));
            page1Btn.classList.add("active");
            page2Btn.classList.remove("active");
            prevPage.classList.add("disabled");
            nextPage.classList.remove("disabled");
        } else {
            page1Rows.forEach(row => row.classList.add("d-none"));
            page2Rows.forEach(row => row.classList.remove("d-none"));
            page1Btn.classList.remove("active");
            page2Btn.classList.add("active");
            prevPage.classList.remove("disabled");
            nextPage.classList.add("disabled");
        }
    }

    page1Btn.addEventListener("click", function() {
        showPage(1);
    });

    page2Btn.addEventListener("click", function() {
        showPage(2);
    });

    prevPage.addEventListener("click", function() {
        showPage(1);
    });

    nextPage.addEventListener("click", function() {
        showPage(2);
    });
});


function setCategory(category) {
    document.getElementById('categoryInput').value = category;
    document.querySelector('.filter-category .filter-button').textContent = category;
}

function setCity(city) {
    document.getElementById('cityInput').value = city;
    document.querySelector('.filter-city .filter-button').textContent = city;
}