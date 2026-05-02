const lettersDiv = document.querySelector('.letters');



let letter = 'porc';


// lettersDiv.appendChild(h1)


// console.log(h1)

letter.split('').forEach(element => {
    const h1 = document.createElement('h1')
    h1.className = 'letter'
    h1.innerText = `${element}`
    lettersDiv.appendChild(h1)
})

