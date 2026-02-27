const kanaArea = document.getElementById("kana");
const btn = document.querySelector(".c-btn_link");

function kanaCheck(kana) {
    return (/^[ァ-ン ]*$/).test(kana);
}

kanaArea.addEventListener("change", (e) => {
    const kanaValue = kanaArea.value;
    if (kanaCheck(kanaValue) === false) {
        kanaArea.setCustomValidity("全角カタカナで入力してください");
        kanaArea.reportValidity();
        e.preventDefault();
    } else {
        kanaArea.setCustomValidity("");
    }
})

