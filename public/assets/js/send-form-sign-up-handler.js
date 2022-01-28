const form = document.getElementById("form");
const inputLogin = document.querySelector(".input_login");
const inputPassword = document.querySelector(".input_password");
const inputName = document.querySelector(".input_name");
const inputEmail = document.querySelector(".input_email");
const inputConfirmPassword = document.querySelector(".input_confirm_password")

if(form) {
    form.addEventListener("submit", (event) => {
        event.preventDefault();
        let errors = document.querySelectorAll("div p");
        
        for(let i = 0; i < errors.length; i++) {
            errors[i].remove();
        }

        sendForm(form);
        
    });
}



function sendForm(form) {
    fetch("public/sign-up.php", {
        method: "POST",
        body: new FormData(form)
    })
    .then(response => response.json())
    .then(result => {
        console.log(result);
        handlerErrorsForm(result);
    })
}


function handlerErrorsForm(arrayErrors) {

    if(arrayErrors["STATUS"] === "OK") {

        let inputLogin = document.querySelector(".input_login input");
        let inputPassword = document.querySelector(".input_password input");
        let inputName = document.querySelector(".input_name input");
        let inputEmail = document.querySelector(".input_email input");
        let inputConfirmPassword = document.querySelector(".input_confirm_password input")
        
        inputLogin.value = "";
        inputPassword.value = "";
        inputName.value = "";
        inputEmail.value = "";
        inputConfirmPassword.value = "";

        return;
    }

        arrayErrors.forEach((el) => {
            if(el["inputName"] === "login") {

                if(el["description"] === "required") {
                    createErrorElement(inputLogin, "Field is requdired");
                }
                if(el["description"] === "minlength") {
                    createErrorElement(inputLogin, "The field must be at least 6 characters logn")
                }
    
                if(el["description"] === "unique") {
                    createErrorElement(inputLogin, "This login is already taken")
                }
                
            }
    
    
            if(el["inputName"] === "password") {
                if(el["description"] === "equality") {
                    createErrorElement(inputPassword, "Password mismatch");
                }
    
                if(el["description"] === "preg") {
                    createErrorElement(inputPassword, "Letters and numbers");
                }
                
                if(el["description"] === "required") {
                    createErrorElement(inputPassword, "Field is required");
                }
    
                if(el["description"] === "minlength") {
                    createErrorElement(inputPassword, "The field must be at least 6 characters long");
                }
                
            }
    
    
            if(el["inputName"] === "confirm_password") {
            
                if(el["description"] === "required") {
                    createErrorElement(inputConfirmPassword, "Field is required");
                }
                
            }
    
    
            if(el["inputName"] === "email") {
                if(el["description"] === "valide") {
                    createErrorElement(inputEmail, "valide email");

                }
    
                if(el["description"] === "required") {
                    createErrorElement(inputEmail, "Field is required");
                }
    
                if(el["description"] === "unique") {
                    createErrorElement(inputEmail, "This email is already taken");
                }
    
    
    
            }
    
            if(el["inputName"] === "name") {
                if(el["description"] === "preg") {
                    createErrorElement(inputName, "Must be two characters");
                }
    
                if(el["description"] === "required") {
                    createErrorElement(inputName, "Field is required");
                }
            }
        })
    }

