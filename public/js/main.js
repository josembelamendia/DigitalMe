function redirectTo(path) {
    window.location.replace(window.location.protocol+'//'+window.location.host+'/'+path);
}

function redirectToLogout() {
    window.location.href = 'logout';
}

let lupa = document.querySelector('a.lupa');
let searchForm = document.querySelector('form.search-form');

lupa.addEventListener('click', event => {        
    event.preventDefault()
    searchForm.submit();
})

if(document.querySelector('div.modal-content') != null) {
    let content = document.querySelector('div.modal-content')
    content.innerHTML = content.dataset.content
}

if(document.querySelectorAll('a.question') != null) {
    let questions = document.querySelectorAll('a.question')
    let form = new FormData

    Array.from(questions).forEach(question => {
        question.addEventListener('click', event => {
            event.preventDefault()            
            form.append('question', question.innerHTML);
            fetch(window.location.protocol+'//'+window.location.host+'/api/questions', {
                method: 'POST',
                body: form
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
                question.innerHTML = data.question.answer
            })
            .catch(exception => {
                console.log(exception);
            })
        })
    })
}

let profileButtons = document.querySelectorAll('button.profile-button');
Array.from(profileButtons).forEach(element => {
    element.addEventListener('click', event => {
        let button = event.target;
        event.preventDefault();
        if(button.hasAttribute('id')) {
            switch(button.id) {
                case 'edit-profile-button': {
                    redirectTo('users/'+button.dataset.userid+'/edit');
                    break;
                }
                case 'follow-button': {
                    document.getElementById('follow-form').submit();
                    break;
                }
                case 'login-button': {
                    redirectTo('login');
                    break;
                }
            }
        }
    })
})

let password = document.getElementById('password');
let passwordConfirm = document.getElementById('password-confirm');

if(password != null && passwordConfirm != null) {
    password.addEventListener('keyup', function(event) {
        event.preventDefault()
        if(password.value.length < 8) {
            password.style.border = '1px solid red';
        } else if(password.value.length < 12){
            password.style.border = '1px solid #FFE333';
        } else {
            password.style.border = '1px solid green';
        }
        if(passwordConfirm.value != password.value) {
            passwordConfirm.style.border = '1px solid red';
        }
    })
    
    passwordConfirm.addEventListener('keyup', function(event) {
        event.preventDefault()
        if(passwordConfirm.value.length >= 8 && passwordConfirm.value == password.value && passwordConfirm.value != '') {
            passwordConfirm.style.border = '1px solid green';
        } else {
            passwordConfirm.style.border = '1px solid red';
        }
    })

    let footer = document.querySelector('footer.page-footer');
    footer.style.height = '4rem'
}

if(document.querySelector('a#like-click')) {
    let like = document.querySelector('a#like-click')
    let likeForm = document.querySelector('form#like-form')
    like.addEventListener('click', event => {
        event.preventDefault()
        likeForm.submit()
    })
}

try {
    let emailEdit = document.getElementById('email-edit');

    emailEdit.addEventListener('click', event => {
        event.preventDefault();
        emailEdit.blur();
    })

    emailEdit.addEventListener('mouseover', event => {
        event.preventDefault();
        emailEdit.style.cursor = 'not-allowed';
    })
} catch(ex) {

}
