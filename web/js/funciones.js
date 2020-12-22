/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(nombre,id){
  if (confirm("¿Quieres eliminar el usuario:  "+nombre+"?"))
  {
   document.location.href="?orden=Borrar&id="+id;
  }
}

/* ESTILOS TABLAS AMIGABLES 


    table {
        text-align: center;
        width: 100%;
        border: 1px solid #555;
    }
     
    table th {
        padding: 12px;
        background: #2979CD;
        color: white;
        font-size: 18px;
    }
     
    table td {
        padding: 10px;
        border-top: 1px solid #ccc;
    }
     
    table td:first-child {
        border-right: 1px solid #ccc;
    }



*/