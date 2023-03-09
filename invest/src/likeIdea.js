async function add_idea(user_id, idea_id) {
    //ajax technology
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../src/like_idea.php")
    xhr.send(JSON.stringify({user_id, idea_id}))
}

// adding like event handlers to all elements
let likes = document.querySelectorAll('a.like')
likes = Array.from(likes)
likes.forEach(like => {
    like.addEventListener("click", e => {
        e.preventDefault()
        like.firstElementChild.classList.toggle("active")
        console.log(like.dataset.user_id, like.dataset.idea_id)
        add_idea(like.dataset.user_id, like.dataset.idea_id)
    })
})
