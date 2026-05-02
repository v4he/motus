const lettersDiv = document.querySelector('.letters');



let word = 'pryttttereoizoeiztzetzet';


// lettersDiv.appendChild(h1)


// console.log(h1)

word.split('').forEach(element => {
    const h1 = document.createElement('h1')
    h1.className = 'letter'
    h1.innerText = `${element}`
    lettersDiv.appendChild(h1)
})



