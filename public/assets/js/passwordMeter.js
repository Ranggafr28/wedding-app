// function password Meter
const btnSubmit = document.getElementById("btn-submit");
const passwordField = document.getElementById("passwordField");
const message = document.getElementById("message");
const strenghtMeter = document.getElementById("strenghtMeter");
function setColorAndText(colorText, text) {
    message.classList.add(colorText);
    strenghtMeter.innerHTML = text;
    strenghtMeter.style.color = colorText;
    passwordField.style.borderColor = colorText;
}

passwordField.addEventListener("keyup", () => {
    if (passwordField.value.length > 0) {
        message.classList.remove("hidden");
        if (passwordField.value.match(/\s/)) {
            setColorAndText(
                "#ef4444",
                "Password tidak boleh menggunakan spasi"
            );
            btnSubmit.disabled = true;
            btnSubmit.classList.add("opacity-50", "cursor-not-allowed");
            return false;
        }
        if (passwordField.value.length < 8) {
            setColorAndText("#ef4444", "Password minimal 8 karakter");
            btnSubmit.disabled = true;
            btnSubmit.classList.add("opacity-50", "cursor-not-allowed");
        } else {
            let lowerCase = passwordField.value.match(/[a-z]/);
            let upperCase = passwordField.value.match(/[A-Z]/);
            let numbers = passwordField.value.match(/[0-9]/);
            let specialChar = passwordField.value.match(
                /[\!\~\@\&\#\\$\*\(\)\{\}\?\-\_\+\=]/
            );

            if (lowerCase || upperCase || numbers || specialChar) {
                setColorAndText("#ef4444", "Kekuatan Password: Sangat Lemah");
                btnSubmit.disabled = true;
                btnSubmit.classList.add("opacity-50", "cursor-not-allowed");
            }

            if (
                (lowerCase && upperCase) ||
                (lowerCase && numbers) ||
                (lowerCase && specialChar) ||
                (upperCase && numbers) ||
                (upperCase && specialChar) ||
                (numbers && specialChar)
            ) {
                setColorAndText("#eab308", "Kekuatan Password: Lumayan Kuat");
                btnSubmit.disabled = false;
                btnSubmit.classList.remove("opacity-50", "cursor-not-allowed");
            }

            if (
                (lowerCase && upperCase && numbers) ||
                (lowerCase && upperCase && specialChar) ||
                (lowerCase && numbers && specialChar) ||
                (upperCase && numbers && specialChar)
            ) {
                setColorAndText("#22c55e", "Kekuatan Password: Kuat");
                btnSubmit.disabled = false;
                btnSubmit.classList.remove("opacity-50", "cursor-not-allowed");
            }
            if (lowerCase && upperCase && numbers && specialChar) {
                setColorAndText("#22c55e", "Kekuatan Password: Sangat Kuat");
                btnSubmit.disabled = false;
                btnSubmit.classList.remove("opacity-50", "cursor-not-allowed");
            }
        }
    } else {
        message.classList.add("hidden");
    }
});
