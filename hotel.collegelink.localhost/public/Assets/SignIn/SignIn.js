document.addEventListener("DOMContentLoaded", () => {
  const $form = document.querySelector("form");
  const $emailError = document.querySelector(".email-error");
  const $passwordError = document.querySelector(".password-error");
  const $email = document.querySelector("#email");
  const $password = document.querySelector("#password");
  $emailError.classList.add("hidden");
  $passwordError.classList.add("hidden");
  const btn = document.querySelector(".SignIn-Btn");

  //   const getValidation = ({ email, password }) => {
  //     let emailisValid = false;
  //     let passwordisValid = false;
  //     if (
  //       email !== "" &&
  //       /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)
  //     ) {
  //       emailisValid = true;
  //     }
  //     if (password !== "" && password.length > 6) {
  //       passwordisValid = true;
  //     }
  //     return {
  //       emailisValid,
  //       passwordisValid,
  //     };
  //   };

  //   $form.addEventListener("submit", (e) => {
  //     e.preventDefault();
  //     const { email, password } = e.target.elements;
  //     const values = {
  //       email: email.value,
  //       password: password.value,
  //     };

  //     const validations = getValidation(values);

  //     if (!validations.emailisValid) {
  //       $email.classList.add("is-invalid");
  //       $emailError.classList.remove("hidden");
  //     } else {
  //       $email.classList.remove("is-invalid");
  //       $emailError.classList.add("hidden");
  //     }

  //     if (!validations.passwordisValid) {
  //       $password.classList.add("is-invalid");
  //       $passwordError.classList.remove("hidden");
  //     } else {
  //       $password.classList.remove("is-invalid");
  //       $passwordError.classList.add("hidden");
  //     }
  //     if (validations.emailisValid && validations.passwordisValid) {
  //       $form.submit();
  //     }
  //   });

  let emailisValid = false;
  let passwordisValid = false;
  const getemailValidation = (email) => {
    if (
      email != "" &&
      /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)
    ) {
      emailisValid = true;
    } else {
      emailisValid = false;
    }
  };
  const getpasswordValidation = (password) => {
    if ((password != "") & (password.length > 5)) {
      passwordisValid = true;
    } else {
      passwordisValid = false;
    }
  };
  $email.addEventListener("input", (e) => {
    getemailValidation(e.target.value);
    console.log(e.target.value);
    console.log(emailisValid);
    if (!emailisValid) {
      $email.classList.add("is-invalid");
      $emailError.classList.remove("hidden");
    } else {
      $email.classList.remove("is-invalid");
      $emailError.classList.add("hidden");
    }
    checkbtn();
  });
  $password.addEventListener("input", (e) => {
    getpasswordValidation(e.target.value);
    console.log(e.target.value);
    console.log(passwordisValid);
    if (!passwordisValid) {
      $password.classList.add("is-invalid");
      $passwordError.classList.remove("hidden");
    } else {
      $password.classList.remove("is-invalid");
      $passwordError.classList.add("hidden");
    }
    checkbtn();
  });
  const checkbtn = () => {
    if (emailisValid & passwordisValid) {
      btn.disabled = false;
    } else {
      btn.disabled = true;
    }
  };
});
