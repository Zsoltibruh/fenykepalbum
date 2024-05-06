const likebtn = document.querySelectorAll('.like-button').forEach(e => {
    e.addEventListener('click', () => {

    e.classList.toggle("liked");
  });
});