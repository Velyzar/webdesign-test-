let a = 10;
let b = 5;
console.log(a + b);
console.log(a - b);
console.log(a * b);
console.log(a / b);

const firstName = "Галина";
const lastName = "Дуденко";
const fullName = `${firstName} ${lastName}`;
console.log(`Привіт, ${fullName}!`);

let age = 19;
if (age >= 18) {
    console.log("Доступ дозволено");
} else {
    console.log("Доступ заборонено");
}

for (let i = 1; i <= 10; i++) {
    console.log(i);
}

function square(number) {
    return number * number;
}
console.log(square(5));

let fruits = ["Яблуко", "Банан", "Апельсин"];
fruits.push("Груша");
console.log(fruits);