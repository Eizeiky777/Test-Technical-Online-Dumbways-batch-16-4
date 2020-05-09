// kode G untuk cek segala posibilitas kemunculan A_Z diikuti a-z 
function checkCamelCase(x) {

    let result = x.match(/[A-Z]+[^A-Z]*|[^A-Z]+/g);
    return result;
}


var a = prompt("masukkan nama camelcase : ");
var list_word = checkCamelCase(a);
var length = checkCamelCase(a).length;
document.write(length + ' -> terdiri dari (' + list_word + ')');