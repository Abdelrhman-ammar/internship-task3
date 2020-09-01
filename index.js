function formHandel(){
    var connectionForm = document.getElementById("connectionForm");
    var table = document.getElementById("mytable");
    if(connectionForm.style.display == 'block'){
        connectionForm.style.display = 'none';
    }else{
        connectionForm.style.display = 'block';
        table.style.display = 'none';
    }
}

function tableHandel(){
    var connectionForm = document.getElementById("connectionForm");
    var table = document.getElementById("mytable");
    if(connectionForm.style.display == 'block'){
        connectionForm.style.display = 'none';
    }else{
        table.style.display = 'none';
        connectionForm.style.display = 'block';
    }
}