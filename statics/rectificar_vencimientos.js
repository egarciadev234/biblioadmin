setInterval(function(){ 
    $.get('../books/buscar_vencimientos.php', function(response){
        console.log("ejecutando verificacion de prestamos...");
    }); 
}, 3600000);