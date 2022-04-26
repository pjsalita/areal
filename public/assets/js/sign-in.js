const switchers = [...document.querySelectorAll(".switcher")];

switchers.forEach((item) => {
  item.addEventListener("click", function () {
    switchers.forEach((item) =>
      item.parentElement.classList.remove("is-active")
    );
    this.parentElement.classList.add("is-active");
  });
});

const accountTypeHandler = () => {
    const accountType = document.getElementById("signup-type");
    const prcIdEl = document.getElementById("signup-prc-id-block");
    const positionEl = document.getElementById("signup-position-block");

    accountType.addEventListener('change', (e) => {
        const value = e.target.value;
        prcIdEl.style.display = value === "architect" ? "block" : "none";
        positionEl.style.display = value === "architect" ? "block" : "none";
    })
}

accountTypeHandler();

async function login(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const formValues = Object.fromEntries(formData);
    const errorLabel = document.getElementById("login-error");
    const submitButton = document.getElementById("login-submit");

    try {
        errorLabel.innerText = "";
        submitButton.disabled = true;
        const { data } = await axios.post("/login", formValues);

        if (data.success) {
            window.location.href = data.redirect_url;
        }

        submitButton.disabled = false;
    } catch (error) {
        const errorData = error?.response?.data;
        const errorMessage = errorData?.errors ? Object.values(errorData?.errors).flat().join('\n') : error?.response?.data?.message || error.message;
        errorLabel.innerText = errorMessage;
        submitButton.disabled = false;
    }
}

async function register(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const errorLabel = document.getElementById("register-error");
    const submitButton = document.getElementById("register-submit");

    try {
        errorLabel.innerText = "";
        submitButton.disabled = true;
        const { data } = await axios.post("/register", formData, {
            headers: { "Content-Type": "multipart/form-data" },
        });

        if (data.success && data.redirect_url) {
            window.location.href = data.redirect_url;
        }

        submitButton.disabled = false;
    } catch (error) {
        const errorData = error?.response?.data;
        const errorMessage = errorData?.errors ? Object.values(errorData?.errors).flat().join('\n') : error?.response?.data?.message || error.message;
        errorLabel.innerText = errorMessage;
        submitButton.disabled = false;
    }
}
