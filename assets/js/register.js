function newInputError(id, error) {
    const input = document.getElementById(id);
    const parent = input.parentElement;
    const errorElement = (input.parentElement.querySelector("p") || document.createElement("p"));

    input.classList.add("error");
    
    errorElement.textContent = error;

    parent.appendChild(errorElement);
}

function removeAllError(id) {
    const input = document.getElementById(id);
    const parent = input.parentElement;
    const errorElement = input.parentElement.querySelector("p");

    input.classList.remove("error");
    
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

    const form = document.forms["register"];
    const response = await fetch("/api/isEmailExist.php", {
        method: "POST",
        body: JSON.stringify({
            email: form["email"].value,
        }),
    });
    const isEmailExist = await response.json();
    let error = false;

    if (isEmailExist.existed) {
        newInputError("email", "Cette adresse email existe déjà.")

        error = true;
    } else {
        removeAllError("email");
    }

    const age = calculateAge(form["dob"].value);

    if (age < 18) {
        newInputError("dob", "Vous devez être majeur.")

        error = true;
    } else {
        removeAllError("dob");
    }

    if (!error) {
        showHobbiesComponent(function(hobbies) {
            if (hobbies != false) {
                hobbies.forEach(element => {
                    const input = document.createElement("input");

                    input.type = "hidden";
                    input.name = "hobbies[]";
                    input.value = element;

                    form.appendChild(input);
                });

                form.submit();
            }
        });
    }
}