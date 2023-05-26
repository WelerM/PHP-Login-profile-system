const post_form = document.querySelector('.post-form')
const btn_open_post = document.querySelector('.btn-open-post-form')
const btn_open_post_text = document.querySelector('.btn-open-post-form-text')

let btn_text = true 
btn_open_post.addEventListener('click', ()=>{
    post_form.classList.toggle('js-post-form-open')
    if (btn_text === true) {
        btn_open_post_text.textContent='close'
        btn_open_post.style.backgroundColor='rgba(255, 0, 0, 0.808'
        btn_text = false
    }else{
        btn_open_post_text.textContent='post'
        btn_open_post.style.backgroundColor='rgb(43, 204, 10)'
        btn_text = true
    }
})