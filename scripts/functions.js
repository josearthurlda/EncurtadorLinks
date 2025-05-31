function copiar(copia){
    link = document.getElementById(copia).href;
    navigator.clipboard.writeText(link);
    alert("Link Copiado");
}