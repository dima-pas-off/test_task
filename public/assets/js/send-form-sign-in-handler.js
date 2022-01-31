const form = document.getElementById("form");
const inputLogin = document.querySelector(".input_login");
const inputPassword = document.querySelector(".input_password");
const buttonSubmit = document.querySelector(".submit");

if(form) {
    
    buttonSubmit.type = "submit";
    form.addEventListener("submit", (event) => {
        event.preventDefault();

        let errors = document.querySelectorAll("div p");
        
        for(let i = 0; i < errors.length; i++) {
            errors[i].remove();
        }

        fetch("public/sign-in.php", {
            method: "POST",
            body: new FormData(form)
        })
        .then(response => response.json())
        .then(result => {
            console.log(result);
            handlerErrorsForm(result);
        })

    });
}

    function handlerErrorsForm(arrayErrors) {

        if(arrayErrors["STATUS"] === "OK") {

            let inputLogin = document.querySelector(".input_login input");
            let inputPassword = document.querySelector(".input_password input");
            
            inputLogin.value = "";
            inputPassword.value = "";
            return;
        }
    
        arrayErrors.forEach((el) => {

            if(el["inputName"] === "login") {
        
                if(el["description"] === "notfound") {
                    createErrorElement(inputLogin, "Login not found");
                }

                if(el["description"] === "minlength") {
                    createErrorElement(inputLogin, "The field must be at least 6 characters long");
                }

                if(el["description"] === "required") {
                    createErrorElement(inputLogin, "Field is required");
                }
            }
            
            if(el["inputName"] === "password") {
                if(el["description"] === "notfound") {
                    createErrorElement(inputPassword, "Password is not correct");
                }

                if(el["description"] === "minlength") {
                    createErrorElement(inputPassword, "The field must be at least 6 characters long");
                }

                if(el["description"] === "preg") {
                    createErrorElement(inputPassword, "Letters and numbers only");
                }

                if(el["description"] === "required") {
                    createErrorElement(inputPassword, "Field is required");
                }
            }
        })
    }