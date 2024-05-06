window.onload = function () {
    // Array of Images
    let backgroundImg = [
        "hatter1.jpg",
        "hatter2.jpg",
        "hatter3.jpg",
        "hatter4.png",
        "hatter5.png",
        "silvia.png"
    ];

    setInterval(changeImage, 5000);
    function changeImage() {    
        let i = Math.floor((Math.random() * backgroundImg.length));
        document.body.style.backgroundImage = "url('img/" + backgroundImg[i] + "')";
    }
}