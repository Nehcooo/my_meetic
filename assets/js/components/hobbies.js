let hobbies = [];

function loadHobbies() {
    const elements = document.querySelectorAll(".hobbie");

    elements.forEach(element => {
        element.onclick = function() {
            const name = element.querySelector("p").textContent;

            if (!element.classList.contains("active")) {
                if (!hobbies.includes()) {
                    hobbies.push(name);
                }

                element.classList.add("active");
            } else {
                if (hobbies.includes()) {
                    hobbies = hobbies.filter(element => element != name);
                }

                element.classList.remove("active");
            }
        }
    });
}

function addHobbie() {
    const hoobie = prompt("Nom du loisir");

    if (hoobie && hoobie.length > 0) {
        const list = document.querySelector(".list");
        const element = document.createElement("div");

        element.className = "hobbie custom";
        element.innerHTML = "<p>" + hoobie + "</p>"

        list.appendChild(element);
    }

    loadHobbies();
}

function showHobbiesComponent(cb) {
    document.querySelector(".hobbies").style.display = "flex";

    loadHobbies();
    
    document.getElementById("btn_back").onclick = function() {
        cb(false);
        hideHobbiesComponent();
    }

    document.getElementById("btn_confirm").onclick = function() {
        cb(hobbies);
        hideHobbiesComponent();
    }
}

function hideHobbiesComponent() {
    document.querySelector(".hobbies").style.display = "none";

    const elements = document.querySelectorAll(".hobbie");
    const list = document.querySelector(".list");

    elements.forEach(element => {
        element.classList.remove("active");

        if (element.classList.contains("custom")) {
            list.removeChild(element);
        }
    });

    hobbies = [];
}
