function reverseArray(x) {
    var newArr = [];
    for (var i = 0; i < x.length; i++) {
        newArr[i] = x[x.length - i - 1];
    }
    return newArr;
}


var a = prompt('masukkan angka atau huruf lebih dari satu atau lebih : ');

document.write(reverseArray(a));
