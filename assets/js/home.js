function getFilters() {
    let filters = {
        "gender": [],
        "hobbies": [],
        "city": [],
        "age": [],
    };

    document.querySelectorAll("#gender .list .option input").forEach(element => {
        if (element.checked) {
            filters.gender.push(element.name);
        }
    });

    document.querySelectorAll("#hobbies .list .option input").forEach(element => {
        if (element.checked) {
            filters.hobbies.push(element.name);
        }
    });

    document.querySelectorAll("#city .list .option input").forEach(element => {
        if (element.checked) {
            filters.city.push(element.name);
        }
    });

    document.querySelectorAll("#age .list .option input").forEach(element => {
        if (element.checked) {
            if (element.name == "age1") {
                for ($i = 18; $i <= 25; $i++) {
                    filters.age.push($i);
                }
            } else if (element.name == "age2") {
                for ($i = 25; $i <= 35; $i++) {
                    filters.age.push($i);
                } 
            } else if (element.name == "age3") {
                for ($i = 35; $i <= 45; $i++) {
                    filters.age.push($i);
                } 
            } else if (element.name == "age4") {
                for ($i = 45; $i <= 100; $i++) {
                    filters.age.push($i);
                } 
            }
        }
    });

    console.log(filters.age);

    return filters;
}

function calculateAge(dateOfBirth) {
    const date = new Date(dateOfBirth);
    const today = new Date(); 
    const diffInMilliSeconds = (today.getTime() - date.getTime()); 
    const diffInYears = (diffInMilliSeconds / 1000 / 60 / 60 / 24 / 365.25);
  
    return Math.abs(Math.round(diffInYears));
}

let index = 0;

function createUser(element) {
    index = (index + 1);

    const user = document.createElement("div");
    
    user.id = "user-" + index;
    user.className = "user";

    const image = document.createElement("div");
    
    image.className = "image";

    const img = document.createElement("img");
    
    img.src = element.profile_pic;

    image.appendChild(img);
    user.appendChild(image);

    const infos = document.createElement("div");
    
    infos.className = "infos";

    const actions = document.createElement("div");
    
    actions.className = "actions";

    const like = document.createElement("div");
    
    like.className = "like";
    like.innerHTML = "<span class='material-symbols-outlined'>favorite</span>";

    actions.appendChild(like);

    const message = document.createElement("div");
    
    message.className = "message";
    message.innerHTML = "<span class='material-symbols-outlined'>forum</span>";

    actions.appendChild(message);
    infos.appendChild(actions);

    const name = document.createElement("p");

    name.className = "name";
    name.textContent = element.firstname + " " + element.lastname;

    infos.appendChild(name);

    const age = document.createElement("p");

    age.className = "age";
    age.textContent = calculateAge(element.dob) + " ans";

    infos.appendChild(age);

    const city = document.createElement("p");

    city.className = "city";
    city.textContent = element.city;

    infos.appendChild(city);

    const hobbies = document.createElement("p");

    hobbies.className = "hobbies";
    hobbies.textContent = element.hobbies;

    infos.appendChild(hobbies);

    user.appendChild(infos);

    return user;
}

async function setUsers() {
    index = 0;

    document.querySelectorAll(".menu button").forEach(element =>  {
        const list = element.parentElement.querySelector(".list");

        if (element.classList.contains("active")) {
            element.classList.remove("active");
            list.classList.remove("active");
        }
    });

    const response = await fetch("/api/getUsers.php", {
        method: "POST",
        body: JSON.stringify({
            filters: getFilters(),
        }),
    });
    const data = await response.json();
    const users = document.querySelector(".users");
    
    users.innerHTML = "";

    data.forEach(element => {
        const user = createUser(element);

        users.appendChild(user);
    });

    let currentIndex = 1;

    function setArrow() {
        if (currentIndex <= 1) {
            document.querySelector(".arrow_left").style.display = "none";
        } else {
            document.querySelector(".arrow_left").style.display = "flex";
        }

        if (currentIndex >= data.length) {
            document.querySelector(".arrow_right").style.display = "none";
        } else {
            document.querySelector(".arrow_right").style.display = "flex";
        }
    }

    let user = document.getElementById("user-" + currentIndex);

    if (user) {
        user.classList.add("active");
        user.scrollIntoView({behavior: "smooth", block: "center", inline: "center"});
    }

    const arrow_right = document.querySelector(".arrow_right");

    setArrow();

    arrow_right.onclick = () => {
        if (user) {
            user.classList.remove("active");
        }

        currentIndex = (currentIndex + 1);

        user = document.getElementById("user-" + currentIndex);

        user.classList.add("active");
        user.scrollIntoView({behavior: "smooth", block: "center", inline: "center"});

        setArrow();
    }

    const arrow_left = document.querySelector(".arrow_left");

    arrow_left.onclick = () => {
        if (user) {
            user.classList.remove("active");
        }

        currentIndex = (currentIndex - 1);

        user = document.getElementById("user-" + currentIndex);

        user.classList.add("active");
        user.scrollIntoView({behavior: "smooth", block: "center", inline: "center"});

        setArrow();
    }
}

window.addEventListener("load", async () => {
    setUsers();

    document.querySelectorAll(".menu button").forEach(element =>  {
        element.onclick = function() {
            const list = element.parentElement.querySelector(".list");

            if (element.classList.contains("active")) {
                element.classList.remove("active");
                list.classList.remove("active");
            } else {
                element.classList.add("active");
                list.classList.add("active");
            }
        }
    });
});