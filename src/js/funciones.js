const validarContras = () => {
    let pass = document.getElementById('contras');
    let passRep = document.getElementById('contras_rep');

    if(pass.value !== passRep.value){
        let formReg = document.getElementById('form_reg');
        event.preventDefault();
        alert('las contraseñas no coinciden');
    }
}

function irAdm(){
    const adm = document.getElementById('adm');
    adm.addEventListener('click', ()=>{
        window.location.href = '../admin/admin.php';
    });
}

function fuera(){
    const salir = document.getElementById('salir');
    salir.addEventListener('click', ()=>{
        window.location.href = './plataforma.php';
    });
}