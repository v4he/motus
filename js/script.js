const lettersDiv = document.querySelector(".letters");

const input = document.querySelector(".input");
const ok = document.querySelector(".ok");




ok.addEventListener("click", () => {
  fetch("php/Game.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `word=${encodeURIComponent(input.value)}`,
  })
    .then((res) => res.json())
    .then((data) => console.log(data));
});






let word = "pryttttereoizot";

word.split("").forEach((element) => {
  const h1 = document.createElement("h1");
  h1.className = "letter";
  h1.innerText = `${element}`;
  lettersDiv.appendChild(h1);
});
