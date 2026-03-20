// Завдання 1.спочатку завантажиться файл big.js бо коли браузер зустрічає тег <script src =""> nj то він завантажить цей файл перш ніж іти до іншого
// Завдання 2.Дайте відповідь, чому дорівнюватиме х у цьому прикладі: var a = 2; var x = 1 + (a *= 2);
// x = 5
//
// Чи з'явиться alert у наступному коді та поясніть чому?
// if ("0") { alert('Привіт'); }
// так, з'явиться тому що текст в лапках вважається true
//
// Оголосіть змінні admin та name, запишіть у name рядок "Василь", скопіюйте його в admin та виведіть admin у консоль.
let countiesData = [];

async function fetchCounties() {
    const url = "https://api.census.gov/data/2020/acs/acs5/profile?get=NAME&for=county:*";
    let response = await fetch(url);
    let rawData = await response.json();

    // Пропускаємо нульовий індекс (заголовки) і збираємо масив об'єктів
    for (let i = 1; i < rawData.length; i++) {
        countiesData.push({
            name: rawData[i][0],
            state: rawData[i][1],
            county: rawData[i][2]
        });
    }
}
fetchCounties(); // Запускаємо при завантаженні

function getCountyCode(searchName) {
    for (let i = 0; i < countiesData.length; i++) {
        if (countiesData[i].name === searchName) {
            return countiesData[i].state + countiesData[i].county;
        }
    }
    return "Округ не знайдено";
}

let searchBtn = document.getElementById("searchBtn");
let countyInput = document.getElementById("countyInput");
let resultText = document.getElementById("result");

searchBtn.addEventListener("click", function() {
    let code = getCountyCode(countyInput.value);
    resultText.innerText = "Результат: " + code;
});


//
// Завдання 4: Валідація форми
let userForm = document.getElementById("userForm");
let inputFirstName = document.getElementById("first_name");
let inputLastName = document.getElementById("last_name");
let inputEmail = document.getElementById("email");

userForm.addEventListener("submit", function(event) {
    // Зупиняємо стандартне перезавантаження сторінки
    event.preventDefault();

    // Перевіряємо, чи є хоча б одне поле порожнім
    if (inputFirstName.value === "" || inputLastName.value === "" || inputEmail.value === "") {
        alert("Помилка! Будь ласка, заповніть усі поля форми.");
    } else {
        // Якщо всі поля заповнені то виводимо дані
        alert(`Дані користувача:\nІм'я: ${inputFirstName.value}\nПрізвище: ${inputLastName.value}\nEmail: ${inputEmail.value}`);
    }
});



// Завдання 5: Анімація
let elid = document.getElementById("elid");
let btnLeft = document.getElementById("btnLeft");
let btnRight = document.getElementById("btnRight");

// Змінна для збереження поточної позиції квадрата
let currentPosition = 0;

btnRight.addEventListener("click", function() {
    currentPosition += 100; // 100 пікселів вправо
    elid.style.transform = `translateX(${currentPosition}px)`;
});

btnLeft.addEventListener("click", function() {
    currentPosition -= 100; //  100 пікселів вліво
    elid.style.transform = `translateX(${currentPosition}px)`;
});