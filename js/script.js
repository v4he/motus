const lettersDiv = document.querySelector(".letters");
const p = document.querySelector("p");
const input = document.querySelector(".input");
const ok = document.querySelector(".ok");

const scoreNumber = document.querySelector('.scoreNumber')

let startData;

function start () {
  

  fetch("php/Game.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `action=start`,
  })
    .then((res) => res.json())
    .then((data) => actionReponse(data));
};

start()

let count = 0;
let waiting = true;

let wordsArray = [];

ok.addEventListener("click", () => {
  if (!waiting) return;
  waiting = false;

   

  if (
    input.value.length === startData[0]
  ) {
    p.innerText = "";
    fetch("php/Game.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `action=${encodeURIComponent(input.value).toLowerCase()}`,
    })
      .then((res) => res.json())
      .then((data) => actionReponse(data));
  } else {
    p.innerText = "Longueur incorrecte";
    p.style.color = 'red'
    waiting = true;
  }
});



function actionReponse(data) {
  console.log(data);

  if (data[2] === "start") {
    lettersDiv.innerHTML = "";
    startData = data;
    console.log(startData);
    console.log(startData)
    scoreNumber.innerText = startData[4]
    for (let i = 0; i < 5; i++) {
      const row = document.createElement("div");
      row.className = "row";

      for (let y = 0; y < startData[0]; y++) {
        const h1 = document.createElement("h1");

        if (y === 0 && i === 0) {
          h1.innerText = startData[1];
          row.appendChild(h1);
        } else {
          h1.innerText = "-";
          row.appendChild(h1);
        }
      }

      lettersDiv.appendChild(row);
    }
  } else if (data[2] === "word") {
    const letterH1 = document.querySelectorAll("h1");
    let bool = true;

    if(data[5] === "Mot invalide" ){
      p.style.color = 'yellow'
      p.innerText = "Mot invalide";
      waiting = true
      
    }  
    else{

      for (
      let i = count, z = 0;
      i < letterH1.length, z < data[1].length;
      i++, z++
    ) {
      if (data[1][z] !== undefined) {
        count++;
        console.log(data[1][z]);
      }

      setTimeout(() => {


        letterH1[i].innerText = data[1][z];
        letterH1[i].style.color = data[0][z];

        console.log(letterH1[i].innerText);
        wordsArray.push(letterH1[i].innerText);

        if (letterH1[i].style.color === "blue") {
          letterH1[i].style.opacity = "0.5";
        }

        if (z === 4) {
          

          if (data[5] === "true") {


            setTimeout(() => {
              scoreNumber.innerText = data[6]

              fetch("php/Game.php", {
                method: "POST",
                headers: {
                  "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `action=start`,
              })
                .then((res) => res.json())
                .then((data) => actionReponse(data));
            }, 1000);

            count = 0;
          } else if (letterH1[letterH1.length - 1].innerText !== "-") {
            setTimeout(() => {
              fetch("php/Game.php", {
                method: "POST",
                headers: {
                  "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `action=start`,
              })
                .then((res) => res.json())
                .then((data) => actionReponse(data));
            }, 1000);

            count = 0;
          }
          waiting = true;
        }
      }, z * 200);
    }

    }
   

    
  }
}

// data[0].split("").forEach((element, index) => {
//       const h1 = document.createElement("h1");
//       h1.className = "letter";

//       if (index === 0) {
//         h1.innerText = data[0][0];
//       } else {
//         h1.innerText = "-";
//       }

//       row.appendChild(h1);
//     });

// function gameReponse(reponse) {
//   console.log(reponse);
//   for (let i = 0; i < 5; i++) {
//     const row = document.createElement("div");
//     row.className = "row";

//     data[0].split("").forEach((element, index) => {
//       const h1 = document.createElement("h1");
//       h1.className = "letter";

//       if (index === 0) {
//         h1.innerText = data[0][0];
//       } else {
//         h1.innerText = "-";
//       }

//       row.appendChild(h1);
//     });

//     lettersDiv.appendChild(row);
//   }
// }

//  setTimeout(()=>{

//           if(data[5] === 'true' && bool){
//           fetch("php/Game.php", {
//             method: "POST",
//             headers: {
//               "Content-Type": "application/x-www-form-urlencoded",
//             },
//             body: `action=start`,
//           })
//             .then((res) => res.json())
//             .then((data) => actionReponse(data));

//             count = 0
//             bool = false

//         }

//         else if (letterH1[letterH1.length - 1].innerText !== "-" && bool) {
//           fetch("php/Game.php", {
//             method: "POST",
//             headers: {
//               "Content-Type": "application/x-www-form-urlencoded",
//             },
//             body: `action=start`,
//           })
//             .then((res) => res.json())
//             .then((data) => actionReponse(data));

//           count = 0;
//           bool = false
//         }

//         }, 1000)
