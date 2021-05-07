function setTime(id){

    var d = new Date();

    var h = (d.getHours()<10?'0':'') + d.getHours();
    var m = (d.getMinutes()<10?'0':'') + d.getMinutes();
    var s = (d.getSeconds()<10?'0':'') + d.getSeconds(); 

    document.getElementById(id).value = h + ':' + m ;
    // console.log(document.getElementById(id).value);

}