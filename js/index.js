function validateForm() {
    var senha = document.getElementById("senha").value;
    var confirmarSenha = document.getElementById("confirmarSenha").value;

        if (senha !== confirmarSenha) {
            alert("As senhas não coincidem. Por favor, digite novamente.");
            return false;
        }
        
    return true;
}

function sucessoAluno(){
    alert("Aluno cadastrado com sucesso");
}

function sucessoProf(){
    alert("Professor/ADM cadastrado com sucesso");
}

function sucessoPaciente(){
    alert("Paciente cadastrado com sucesso");
}