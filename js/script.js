
const bars = document.querySelector("#bar");
const sideList = document.querySelector(".sidelist");
bars.addEventListener("click", ()=>{
    bars.classList.toggle("fa-times");
   sideList.classList.toggle("active");
})

console.log(bars);