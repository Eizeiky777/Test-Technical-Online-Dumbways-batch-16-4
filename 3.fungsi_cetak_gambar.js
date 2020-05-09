var b = prompt("input angka : ");
var a = b - 1; // dkurangin satu supaya jika user input angka lebih besar lagi pattern tetap sama


for(var i=0; i<b; i++){
    for(var j=a; j>i; j-- ){
        document.write("&nbsp;");
   
    }
    for(var k=0; k<b; k++){
        document.write("*");
    }
    
  
    document.write("<br>");
}
