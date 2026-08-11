const icon = document.querySelector('i');

document.getElementById('show_sidebar').addEventListener('click', function(){
    if(document.getElementById('sidebar').style.display === 'none' || document.getElementById('sidebar').style.display === ''){
        document.getElementById('sidebar').style.display = 'flex';
        icon.classList.remove("fa-bars");
        icon.classList.add("fa-xmark");
    }
    else{
        document.getElementById('sidebar').style.display = 'none';
        icon.classList.remove("fa-xmark");
        icon.classList.add("fa-bars");

    }
})