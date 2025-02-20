const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

let uppass = [];
let inpass = [];

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function upimg(element) {
    element.classList.toggle("selected");
    const imgId = element.id;
    const index = uppass.indexOf(imgId);
    
    if (index > -1) {
        uppass.splice(index, 1);
        element.style.border = "none";
    } else {
        uppass.push(imgId);
        element.style.border = "2px solid #FF4B2B";
    }
}

function inimg(element) {
    element.classList.toggle("selected");
    const imgId = element.id;
    const index = inpass.indexOf(imgId);
    
    if (index > -1) {
        inpass.splice(index, 1);
        element.style.border = "none";
    } else {
        inpass.push(imgId);
        element.style.border = "2px solid #FF4B2B";
    }
}

function clearPasswords() {
    const elements = document.querySelectorAll('.selected');
    elements.forEach(element => {
        element.classList.remove('selected');
        element.style.border = "none";
    });
    uppass = [];
    inpass = [];
}

async function signup() {
    const email = document.getElementById('upmail').value;
    if (!email || !validateEmail(email)) {
        alert('Please enter a valid email address');
        return;
    }
    if (uppass.length < 3) {
        alert('Please select at least 3 images for your password');
        return;
    }

    try {
        const response = await fetch('auth_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'signup',
                email: email,
                pattern: uppass
            })
        });

        const data = await response.json();
        if (data.success) {
            alert('Account created successfully! Please login.');
            clearPasswords();
            container.classList.remove("right-panel-active");
        } else {
            alert('Signup failed: ' + data.message);
            clearPasswords();
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error creating account. Please try again.');
    }
}

async function signin() {
    const email = document.getElementById('inmail').value;
    if (!email || !validateEmail(email)) {
        alert('Please enter a valid email address');
        return;
    }
    if (inpass.length < 1) {
        alert('Please select your password pattern');
        return;
    }

    try {
        const response = await fetch('auth_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'login',
                email: email,
                pattern: inpass
            })
        });

        const data = await response.json();
        console.log('Login response:', data);
        
        if (data.success) {
            localStorage.setItem('userEmail', email);
            window.location.replace('home.php');
        } else {
            alert('Login failed: ' + data.message);
            clearPasswords();
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error logging in. Please try again.');
    }
}