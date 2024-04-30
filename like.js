const likebtn = document.querySelectorAll('.like-button');

likebtn.forEach(e=> {
    e.addEventListener('click', () => {
      e.classList.toggle("liked");
    });
  });