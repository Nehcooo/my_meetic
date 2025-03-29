let currentEmail = null;

function newInputError(id, error) {
    const input = document.querySelector("#" + id + " .container");
    const parent = document.getElementById(id);
    const errorElement = (parent.querySelector(".error") || document.createElement("p"));

    input.classList.add("input_error");
    
    errorElement.textContent = error;
    errorElement.className = "error";

    parent.appendChild(errorElement);
}

function removeAllError(id) {
    const input = document.querySelector("#" + id + " .container");
    const parent = document.getElementById(id);
    const errorElement = parent.querySelector(".error");

    input.classList.remove("input_error");
    
    if (errorElement) {
        parent.removeChild(errorElement);
    }
}

function calculateAge(dateOfBirth) {
    const date = new Date(dateOfBirth);
    const today = new Date(); 
    const diffInMilliSeconds = (today.getTime() - date.getTime()); 
    const diffInYears = (diffInMilliSeconds / 1000 / 60 / 60 / 24 / 365.25);
  
    return Math.abs(Math.round(diffInYears));
}

async function validateForm(event) {
    event.preventDefault();

    let error = false;

    const form = document.forms["account"];

    if (currentEmail != form["email"].value) {
        const response = await fetch("/api/isEmailExist.php", {
            method: "POST",
            body: JSON.stringify({
                email: form["email"].value,
            }),
        });
        const isEmailExist = await response.json();
    
        if (isEmailExist.existed) {
            newInputError("email", "Cette adresse email existe déjà.")
    
            error = true;
        } else {
            removeAllError("email");
        }
    }

    const age = calculateAge(form["dob"].value);

    if (age < 18) {
        newInputError("dob", "Vous devez être majeur.")

        error = true;
    } else {
        removeAllError("dob");
    }

    if (!error) {
        form.submit();
    }
}

async function selectImage(e) {
    e.preventDefault();

    const form = document.forms["profile"];
    const input = document.createElement("input");

    input.type = "file";
    input.name = "profile_pic";
    input.accept = "image/*";
    input.click();
    
    input.addEventListener("change", (e) => {
        const file = e.target.files[0];

        if (file) {
            form.appendChild(input);
            form.submit();
        }
    });
}

window.addEventListener("load", async () => {
    const response = await fetch("/api/getUserInfos.php", {
        method: "POST",
    });
    let data = await response.json();
    
    currentEmail = data["email"];

    data = Object.entries(data);
    data.push(["password", ""]);

    data.forEach(value => {
        if (value[0] == "profile_pic") {
            if (value[1]) {
                document.getElementById("profile_pic").src = value[1];
                document.getElementById("profile_pic").style.display = "block";
            } else {
                document.getElementById("profile_pic").src = "";
                document.getElementById("profile_pic").style.display = "none";
            }
        }

        const element = document.querySelector("#" + value[0] + " .value");

        if (element) {
            if (value[1] == "male") {
                value[1] = "Homme";
            } else if (value[1] == "female") {
                value[1] = "Femme";
            } else if (value[1] == "other") {
                value[1] = "Autre";
            } else if (value[0] == "dob") {
                const date = new Date(value[1]); 

                value[1] = date.toLocaleDateString("fr-FR");
            } else if (value[0] == "hobbies") {
                if (!value[1]) {
                    value[1] = "Aucun";
                }
            }

            element.textContent = value[1];

            const input = document.querySelector("#" + value[0] + " input");

            if (input) {
                input.value = value[1];
            }

            const parent = document.querySelector("#" + value[0] + " .container");

            parent.onclick = function() {
                if (value[0] == "hobbies") {
                    showHobbiesComponent((hobbies) => {
                        if (hobbies != false) {
                            let newHobbies = "";
                            
                            document.querySelectorAll(".hobbiesInput").forEach(element => {
                                element.remove();
                            });

                            hobbies.forEach((element, index) => {
                                const input = document.createElement("input");
            
                                input.type = "hidden";
                                input.name = "hobbies[]";
                                input.value = element;
                                input.classList.add("hobbiesInput");

                                document.getElementById("accountForm").appendChild(input);

                                newHobbies = (newHobbies + element + ((index + 1) < hobbies.length ? ", " : ""))
                            });

                            element.textContent = newHobbies;
                        }
                    });
                } else {
                    parent.classList.add("active");

                    const right = document.querySelector("#" + value[0] + " .right");
                    
                    right.style.display = "none";
    
                    const input = document.querySelector("#" + value[0] + " input");
    
                    input.value = element.textContent;
                    input.style.display = "block";
                    input.focus();
    
                    input.onblur = function() {
                        parent.classList.remove("active");
    
                        right.style.display = "flex";
                        input.style.display = "none";
    
                        if (input.value.length > 0) {
                            element.textContent = input.value;
                        }
                    }
                }
            }
        }
    });
});