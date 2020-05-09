// kode G untuk cek segala posibilitas kemunculan A_Z diikuti a-z 
function checkCamelCase(x) {

    let result = x.match(/[A-Z]+[^A-Z]*|[^A-Z]+/g);
    return result;
}


var a = prompt("masukkan nama camelcase : ");
var list_word = checkCamelCase(a);
var length = checkCamelCase(a).length;
document.write(length + ' -> terdiri dari (' + list_word + ')');


// var strings = 'this iS a TeSt 523 Now!';
// var i=0;
// var character='';
// while (i <= strings.length){
//     character = strings.charAt(i);
//     if (!isNaN(character * 1)){
//         alert('character is numeric');
//     }else{
//         if (character == character.toUpperCase()) {
//             alert ('upper case true');
//         }
//         if (character == character.toLowerCase()){
//             alert ('lower case true');
//         }
//     }
//     i++;
// }